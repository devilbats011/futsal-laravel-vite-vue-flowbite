<?php

namespace App\Http\Controllers;

use Stripe;
use App\Models\Book;
use App\Models\User;
use App\Models\Court;
use App\Models\Payment;
use App\Models\Anonymous;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use App\Http\Resources\BookCollection;
use App\Jobs\SendEmail;
use Illuminate\Support\Facades\Session;

class BookController extends Controller
{
    // todo: put baseBookcontroller and remove bookValidation function

    public function apiBooks()
    {
        $books = Book::with(['court' => function ($query) {
            $query->select('id', 'number');
        }])
            ->paginate(5);
        $books = new BookCollection($books);
        return response()->json($books, 200);
    }

    public function apiAdminBooks(Request $r)
    {
        //? $r->input and $r->get from fecth/axios params javascript
        //* can use either $r->input('') or $r->get('') ..
        if ($r->input('secret')) {
            if (!User::Where('secret', $r->input('secret'))->first()) {
                return response()->json(['error' => 'denied', 'data' => []], 403);
            }

            $books = Book::with(['court' => function ($query) {
                $query->select('id', 'number');
            }])->with('anonymous')->paginate(10);
            return response()->json(['error' => '', 'data' => $books], 200);
        }
    }


    # Get route('book.home');
    public function book(Court $court, Request $r)
    {

        $book_date = validateDate($r->book_date) ? $r->book_date  : Carbon::now()->format('Y-m-d');
        $books = Book::Where('book_date', $book_date)
            ->where('court_id', $court->id)
            ->with(['court' => function ($query) {
                $query->select('id', 'number');
            }])
            ->get()->makeHidden(['book_number']);

        $tableBook = collect([]);
        for ($i = 9; $i < 24; $i++) {
            $book = $books->where('time_book_start', $i)->first();
            if ($book) {
                $tableBook->push($book);
                $i = $book->time_book_end - 1; //? tolak satu sbb next loop akan i++
            } else {
                $book = new Book;
                $book->court = new Court;
                $book->state = 'empty';
                $book->time_book_start = $i;
                $book->time_book_end = $i + 1;
                $book->book_date = '';
                $tableBook->push($book);
            }
        }

        return view('book')
            ->with('court', $court)
            ->with('books', $tableBook)
            ->with('book_date', $book_date);
    }

    # Post
    public function trackBook(Request $r)
    {
        $book = Book::where('book_number', $r->book_number)->first();
        return view('showbook', compact('book'));
    }


    public function bookValidation(Request $request)
    {
        // dd($request->all());
        $request->validate([
            // 'number' => 'required|exists:courts,id',
            'court_id' => 'required|exists:courts,id',
            'book_date' => 'required|date',
            'time_book_start' => [
                'required',
                function ($attribute, $value, $fail) use ($request) {
                    //     $time_book_start = Carbon::parse($value);
                    //     $time_book_end = Carbon::parse($request->time_book_end);
                    $time_book_start = $value;
                    $time_book_end = $request->time_book_end;

                    if ($time_book_start == $time_book_end) {
                        return $fail('start time and end time booking cannot be the same.');
                    }

                    if ($time_book_start > $time_book_end) {
                        return $fail('time book start cannot be greater than time book end');
                    }
                    //? https://stackoverflow.com/questions/19325312/how-to-create-multiple-where-clause-query-using-laravel-eloquent
                    $bookFirst = Book::Where([
                        ['court_id', '=', $request->court_id],
                        ['book_date', '=', $request->book_date],
                        ['time_book_start', '=', $time_book_start],
                    ])->first();
                    // ? https://laravel.com/docs/9.x/collections#method-first
                    if ($bookFirst) {
                        return $fail('The time book has already been taken.1');
                    }

                    //     //creating unique logic at booking time
                    //     //when thing get large -> be optimize with created date/updated date
                    //     // check start and end should be at least one hour apart..cannot the same
                    //     // check if time_book change to CARBON then compare with b_end (time_book_carbon_end >= b_start && time_book_carbon_end <= b_end)
                    $booksCollection = Book::Where('court_id', $request->court_id)
                        ->where('book_date', $request->book_date)
                        ->get();
                    $booksCollection->each(function ($item, $key) use ($time_book_start, $time_book_end, $fail) {
                        // $time_book_start = $value;
                        $item_time_book_start = $item->time_book_start;
                        $item_time_book_end = $item->time_book_end;

                        if ($time_book_start > $item_time_book_start && $time_book_start < $item_time_book_end) {
                            return $fail('The time book has already been taken.01');
                        } else if ($time_book_start < $item_time_book_start && $time_book_end > $item_time_book_end) {
                            return $fail('The time book has already been taken.011');
                        } else if ($time_book_end > $item_time_book_start && $time_book_end < $item_time_book_end) {
                            return $fail('The time book has already been taken.02');
                        }
                    });
                }
            ],
            'time_book_end' => [
                'required',
                function ($attribute, $value, $fail) use ($request) {

                    $time_book_start = $request->time_book_start;
                    $time_book_end = $value;

                    //? https://stackoverflow.com/questions/19325312/how-to-create-multiple-where-clause-query-using-laravel-eloquent
                    $bookFirst = Book::Where([
                        ['court_id', '=', $request->court_id],
                        ['book_date', '=', $request->book_date],
                        ['time_book_end', '=', $time_book_end],
                    ])->first();

                    // ? https://laravel.com/docs/9.x/collections#method-first
                    if ($bookFirst) {
                        return $fail('The time book has already been taken.2');
                    }

                    //     $booksCollection = Book::Where('court_id', $request->number)->get();
                    //     $booksCollection->each(function ($item, $key) use ($value, $fail) {
                    //         $time_book_end = Carbon::parse($value);
                    //         $item_time_book_start = Carbon::parse($item->time_book_start);
                    //         $item_time_book_end = Carbon::parse($item->time_book_end);
                    //         if ($time_book_end->eq($item_time_book_end)) {
                    //             return $fail('The time book has already been taken.');
                    //         }
                    //     });
                },
            ],
            'name' => ['required', 'required|regex:/^[a-zA-Z\s\']+$/'],
            //? https://ihateregex.io/expr/phone/
            'phone_no' => 'required|regex:/^[\+]?[(]?[0-9]{3}[)]?[-\s\.]?[0-9]{3}[-\s\.]?[0-9]{4,6}$/',
            'email' => ['required', 'email'],
        ]);

        // dd($request->all());
    }

    # Post route('book.add);
    public function bookCourt(Request $request)
    {
        // dd($request->all()); // test

        $this->bookValidation($request);
        $isSave = false;
        // $message = '';
        // $error = '';
        $book = new Book;
        try {
            $anonymous = Anonymous::create([
                'name' => $request->name,
                'phone_no' => $request->phone_no,
                'device' => $request->device,
                'email' => $request->email,
            ]);
            $book->anonymous_id = $anonymous->id;
            if (Auth::check()) {
                $book->user_id = Auth()->id();
                /** @var \App\Models\User $user */
                $user = Auth()->user();
                $user->anonymous()->save($anonymous);
            }

            $book->court_id = $request->court_id;
            $book->state = 'pending';
            $book->book_date = $request->book_date;
            $book->time_book_start = $request->time_book_start;
            $book->time_book_end = $request->time_book_end;
            // $book->court_id = $request->number;
            $isSave = $book->save();
            // $message = 'Booking Pending..';
        } catch (\Throwable $e) {
            $error = $e->getMessage();
        }
        abort_if( !$isSave,500,"something went wrong book not save");
        // if (!$isSave) {
        //     dd('something went wrong book not save');
        // }

        Session::flash("message", "Book Created");
        return redirect()->route('book.payment', [$book]);

    }

    # get route('book.payment', [$book]); / route('book.payment');
    public function paymentBookOption(Book $book)
    {
        if ($book->state != 'pending') {
            // return redirect()->route('courts.index');
            return back();
        }
        return view('payment', [
            'book' => $book
        ]);
    }

    /**
     * # GET route('payment.success');
     * vim {block visual = ctrl + v}
     * ? https://laravel.com/docs/9.x/routing#parameters-regular-expression-constraints
     * ? https://5balloons.info/how-to-get-url-parameters-into-controller-laravel/
     * ? https://stripe.com/docs/payments/accept-a-payment?platform=web&ui=checkout
     * ? https://stripe.com/docs/payments/checkout/custom-success-page
     **/
    public function paymentSuccess(Book $book, $data = null, Request $r)
    {
        // dd($book,$data); //test
        try {
            $emailJob = (new SendEmail($book))->delay(Carbon::now()->addSeconds(10));
            dispatch($emailJob);
            $payload = ['book' => $book, 'data' => $data];

            if (!$r->session) {
                return view('success', $payload);
            }

            $stripe = new Stripe\StripeClient('sk_test_wVr5bhfz0lPTQb6uG2RxsojZ');
            $session = $stripe->checkout->sessions->retrieve($r->session_id);
            $customer = $stripe->customers->retrieve($session->customer);
            // dd($session, $customer);
            $payload = [
                'book' => $book,
                'data' => $data,
                'customer' => $customer,
            ];
            return view('success', $payload);
        } catch (\Throwable $e) {
            http_response_code(500);
            echo json_encode(['error' => $e->getMessage()]);
        }
    }

    # GET route('payment.cancel);
    public function paymentCancel( Request $r,Book $book, $data = null)
    {
        // TODO: Cancel flow ( if cancel, delete booking , if booking arent pay for the next 30 minutes, the system will automaticlu cancel it) AND cantikkan css cancel and letak details yg sesuai..
        try {
            $payload = ['data' => $data];
            if (!$r->session) {
                return view('cancel', $payload);
            }

        } catch (\Throwable $e) {
            http_response_code(500);
            echo json_encode(['error' => $e->getMessage()]);
        }
    }

    # POST route('payment.decision');
    public function paymentDecision(Request $request, Book $book)
    {
        $validate_data = $request->validate(['payment_method' => 'required']);

        //? ini utk yg go back to this page and for people who not have yet fulfill their payment successfully or still have other option to go counter or online..
        if ($book->payment) {
            $payment = $book->payment;
            //? success abort sbb paymnet dh success | counter abort sbb dh janji bayar kt counter can't go back to other option except delete it
            abort_if(in_array($payment->payment_status,['success','counter']),403,'Forbidden');

                if( $validate_data['payment_method'] == 'online') {
                    $book->update(['state'=>'pending']);
                    $payment->update(['online_gateway_name'=> 'stripe','payment_status'=>'pending','payment_method' => 'online']);
                    return redirect()->route('payment.stripe',$book);
                }
                else if ($validate_data['payment_method'] == 'counter' )
                {
                    $payment->update(['online_gateway_name'=> null,'payment_status'=>'counter','payment_method' => 'counter']);
                    Session::flash('message', "payment status : Success Pay At Counter");
                    return redirect()->route('payment.success', [$book, $book->book_number]);
                }

            $payment_status = $book->payment->payment_status;
            if (in_array($payment_status, ['counter', 'success']) ) {

                Session::flash('message', "payment status : Already Flash {$payment_status}");
                return redirect()->route('payment.success', [$book, $book->book_number]);
            }
        }

        $payment = new Payment;
        $payment_method = strtolower($validate_data['payment_method']);
        if ($payment_method == 'counter') {

            $payment->payment_method = 'counter';
            $payment->payment_status = 'counter';
            // $book->update(['state'=>'booked']);
            $book->payment()->save($payment);
            Session::flash('message', "payment status : Success flash {$payment_method}");
            return redirect()->route('payment.success', [$book, $book->book_number]);
        } else if ($payment_method == 'online') {
            $payment->payment_method = 'online';
            $payment->payment_status = 'pending';
            $payment->online_gateway_name = 'stripe';
            $book->payment()->save($payment);
            return redirect()->route('payment.stripe');
        }
        Session::flash('message', 'Whoops Something Went Wrong..');
        return back();
    }

    # Put route('book.edit);
    public function updateBook(Book $book, Request $request)
    {
        // todo:  requirement: add total hours limition validation : user can edit times but cant change total duration of hours(time)
        // $v = $request->validate([
        //     'court_number' => ['required'],
        //     'time_book_start' => ['required'],
        //     'time_book_end' => ['required'],
        //     'book_date' => ['required'],
        // ]);
        $v = $this->bookValidation($request);
        $c = Court::where('number', $v['court_number'])->first();
        $o = collect($v)->except(['court_number']);
        $o->put('court_id', $c->id);
        $isUpdate = $book->update($o->toArray());
        // $this->bookValidation($request);
        Session::flash('message', $isUpdate ? 'Your book has been updated.' : 'Something Went Wrong..');
        return view('showbook', compact('book'));
    }

    # Delete
    public function destroyBook(Book $book)
    {
        if ($book->delete()) {
            // Session::flash('success', 'Your Booking successfully Delete..');
            // return back();
            Session::flash('message', 'Your book has been deleted.');
            return redirect('/');
        }
    }

    # Get
    // route('payment.stripe');
    // ? https://medium.com/@laraveltuts/laravel-9-stripe-payment-gateway-integration-example-79b17969b6eb
    public function stripe(Book $book)
    {
        abort_if($book->state != 'pending', 403, 'Forbidden');
        return view('stripe', compact('book'));
    }

    /**
     * success response method.
     *
     * @return \Illuminate\Http\Response
     */
    public function stripePost(Request $request, Book $book)
    {

        Stripe\Stripe::setApiKey(env('STRIPE_SECRET'));
        $customer = Stripe\Customer::create(array(
            "address" => [
                "line1" => "Virani Chowk",
                "postal_code" => "390008",
                "city" => "Vadodara",
                "state" => "GJ",
                "country" => "IN",
            ],
            "email" => "demo@gmail.com",
            "name" => "Nitin Pujari",
            "source" => $request->stripeToken
        ));
        Stripe\Charge::create([
            "amount" => 100 * 100,
            "currency" => "myr", // "usd",
            "customer" => $customer->id,
            "description" => "Lorums Plrums",
            "shipping" => [
                "name" => "Jenny Rosen",
                "address" => [
                    "line1" => "510 Townsend St",
                    "postal_code" => "98140",
                    "city" => "San Francisco",
                    "state" => "CA",
                    "country" => "US",
                ],
            ]
        ]);
        Session::flash('delete', 'Payment successful!');
        return back();
    }


    # Post route('payment.stripe.v3');
    //? https://stripe.com/docs/checkout/quickstart
    //? https://stripe.com/docs/api/checkout/sessions
    //? https://stripe.com/docs/payments/accept-a-payment?platform=web&ui=checkout
    //? https://stripe.com/docs/payments/checkout/custom-success-page
    public function stripe_v3(Request $r, Book $book)
    {
        // = Stripe\Stripe::setApiKey(env('STRIPE_SECRET'));
        $stripe = new Stripe\StripeClient('sk_test_wVr5bhfz0lPTQb6uG2RxsojZ');
        $totalHour = totalHours($book->time_book_start, $book->time_book_end);
        $checkout_session = $stripe->checkout->sessions->create([
            'customer_email' => $book->anonymous->email,
            'submit_type' => 'book', //? https://stripe.com/docs/api/checkout/sessions/create#create_checkout_session-submit_type
            'line_items' => [[
                'price_data' => [
                    'currency' => 'myr',
                    'product_data' => [
                        'name' => "Book Court {$book->court->number}",
                        "description" => "Total Hour: {$totalHour} | Type Floor : {$book->court->type_floor} | RM/Hour: {$book->court->hour_rate}",
                    ],
                    'unit_amount' => "{$book->court->hour_rate}00",
                ],
                'quantity' => 1,
            ]],
            'mode' => 'payment',
            // 'success_url' => 'http://localhost:8000/payment-success?session_id={CHECKOUT_SESSION_ID}"',
            'success_url' => route("payment.success", [$book->book_number]) . '?session_id={CHECKOUT_SESSION_ID}', // "http://localhost:8000/payment/success?session_id={CHECKOUT_SESSION_ID}"
            // 'cancel_url' => 'http://localhost:8000/payment-cancel',
            'cancel_url' => route("payment.cancel",$book),
        ]);

        //? https://laravel.com/docs/9.x/responses#redirecting-external-domains
        return redirect()->away($checkout_session->url);
    }
}
