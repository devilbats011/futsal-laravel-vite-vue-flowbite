<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateBookRequest;
use App\Http\Requests\UpdateBookRequest;
use Stripe;
use App\Models\Book;
use App\Models\User;
use App\Models\Court;
use App\Models\Payment;
use App\Models\Anonymous;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use App\Http\Resources\BookCollection;
use App\Jobs\SendEmail;
use Illuminate\Support\Facades\Session;

class BookController extends Controller
{

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

    private function getTableBooks(Court $court, $book_date)
    {
        $books = Book::Where('book_date', $book_date)
            ->where('court_id', $court->id)
            ->where('state','<>','empty')
            ->with(['court' => function ($query) {
                $query->select('id', 'number');
            }])
            ->get()->makeHidden(['book_number']);

        $tableBook = collect([]);
        for ($i = 9; $i < 24; $i++) {
            $book = $books->where('time_book_start', $i)->first();
            if ($book) {
                $tableBook->push($book);
                $i = $book->time_book_end - 1;
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

        $obj = new \stdClass();
        $obj->books = $books;
        $obj->tableBook = $tableBook;
        return $obj;
    }

    # Get route('book.home');
    public function book(Court $court, Request $r)
    {

        $book_date = validateDate($r->book_date) ? $r->book_date  : Carbon::now()->format('Y-m-d');
        $obj =  $this->getTableBooks($court, $book_date);
        $tableBook = $obj->tableBook;

        return view('book')
            ->with('court', $court)
            ->with('books', $tableBook)
            ->with('book_date', $book_date);
    }

    # Post
    // route('book.track')
    public function trackBook(Request $r)
    {
        return redirect()->route('track.gettrack', ['book_number' => $r->book_number]);
    }

    # GET
    // route('track.gettrack,...)
    public function getTrackBook(Request $r)
    {
        $book = Book::where('book_number', $r->book_number)->first();
        abort_if(!$book, 404);
        $obj = $this->getTableBooks($book->court, $book->book_date);
        $books = $obj->tableBook;
        $times = [];
        for ($i = 9; $i < 25; $i++) {
            $times[$i] = convertTo12hoursFormat($i);
        }

        $courts = Court::orderBy('number', 'asc')->get();
        return view('showbook', compact('book', 'courts', 'books', 'times'));
    }

    # Post route('book.add);
    public function bookCourt(CreateBookRequest $request)
    {
        $validatedRequest = $request->validated();
        // dd($request->all(),'after-validate'); // test
        $isSave = false;
        $book = new Book;
        try {
            $anonymous = Anonymous::create([
                'name' => $validatedRequest['name'],
                'phone_no' => $validatedRequest['phone_no'],
                'device' => $request['device'],
                'email' => $validatedRequest['email'],
            ]);
            $book->anonymous_id = $anonymous->id;
            if (Auth::check()) {
                $book->user_id = Auth()->id();
                /** @var \App\Models\User $user */
                $user = Auth()->user();
                $user->anonymous()->save($anonymous);
            }

            $book->court_id = $validatedRequest['court_id'];
            $book->state = 'pending';
            $book->book_date = $validatedRequest['book_date'];
            $book->time_book_start = $validatedRequest['time_book_start'];
            $book->time_book_end = $validatedRequest['time_book_end'];
            // $book->court_id = $validatedRequest['number'];
            $isSave = $book->save();
            // $message = 'Booking Pending..';
        } catch (\Throwable $e) {
            $error = $e->getMessage();
        }
        abort_if(!$isSave, 500, "something went wrong book not save");
        // if (!$isSave) {
        //     dd('something went wrong book not save');
        // }

        Session::flash("message", "Booking Created!");
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
    public function paymentSuccess(Book $book, Request $r)
    {
        // dd($book,$data); //test
        try {
            // todo: this emailjob should move to POST not inside GET !
            //! $emailJob = (new SendEmail($book))->delay(Carbon::now()->addSeconds(10));
            //! dispatch($emailJob);

            if (!$r->session_id) {
                return view('success', compact('book'));
            }

            $stripe = new Stripe\StripeClient('sk_test_wVr5bhfz0lPTQb6uG2RxsojZ');
            $session = $stripe->checkout->sessions->retrieve($r->session_id);
            // $customer = $stripe->customers->retrieve($session->customer);

            abort_if(!$session,500);

            $book->payment->update(['payment_status' => 'success']);
            return view('success', compact('book'));
        } catch (\Throwable $e) {
            abort(500,$e->getMessage());
            // http_response_code(500);
            // echo json_encode(['error' => $e->getMessage()]);
        }
    }

    # GET route('payment.cancel);
    public function paymentCancel(Request $r, Book $book)
    {
        try {
            if (!$r->session_id) {

                if($book->payment->payment_status == 'pending') {
                    $book->payment->update(['payment_status'=>'fail']);
                    $u = $book->update(['state'=>'empty']);
                    // $u = $book->delete();
                //    dd($u);
                }


                return view('cancel', compact('book'));
            }
        } catch (\Throwable $e) {
            abort(500,$e->getMessage());
            // http_response_code(500);
            // echo json_encode(['error' => $e->getMessage()]);
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
            abort_if(in_array($payment->payment_status, ['success', 'counter']), 403, 'Forbidden');

            if ($validate_data['payment_method'] == 'online') {
                $book->update(['state' => 'pending']);
                $payment->update(['online_gateway_name' => 'stripe', 'payment_status' => 'pending', 'payment_method' => 'online']);
                return redirect()->route('payment.stripe', $book);
            } else if ($validate_data['payment_method'] == 'counter') {
                $book->update(['state' => 'booked']);
                $payment->update(['online_gateway_name' => null, 'payment_status' => 'counter', 'payment_method' => 'counter']);
                Session::flash('message', "payment status : Pay at the counter");
                return redirect()->route('payment.success', $book);
            }

            $payment_status = $book->payment->payment_status;
            if (in_array($payment_status, ['counter', 'success'])) {
                $emailJob = (new SendEmail($book))->delay(Carbon::now()->addSeconds(10));
                dispatch($emailJob);
                // Session::flash('message', "payment status : {$payment_status}");
                return redirect()->route('payment.success', $book);
            }
        }

        $payment = new Payment;
        $payment_method = strtolower($validate_data['payment_method']);
        if ($payment_method == 'counter') {
            $payment->payment_method = 'counter';
            $payment->payment_status = 'counter';
            // $payment->payment_status = 'pending';
            $book->update(['state'=>'booked']);
            $book->payment()->save($payment);
            Session::flash('message', "Booking Success!");
            return redirect()->route('payment.success', $book);
        } else if ($payment_method == 'online') {
            $payment->payment_method = 'online';
            $payment->payment_status = 'pending';
            $payment->online_gateway_name = 'stripe';
            $book->payment()->save($payment);
            return redirect()->route('payment.stripe', $book);
        }
        Session::flash('message', 'Whoops Something Went Wrong..');
        return back();
    }

    # Put route('book.edit);
    public function updateBook(Book $book, UpdateBookRequest $request)
    {
        $v = $request->validated();
        $c = Court::where('number', $v['court_number'])->first();
        $o = collect($v)->except(['court_number', 'book_id', 'name', 'phone_no', 'email']);
        $o->put('court_id', $c->id);
        $isUpdate = $book->update($o->toArray());
        $book->anonymous->update($request->safe()->only(['name', 'phone_no', 'email']));
        Session::flash('message', $isUpdate ? 'Your book has been updated.' : 'Something Went Wrong..');
        return redirect()->route('track.gettrack', ['book_number' => $book->book_number]);
        // return view('showbook', compact('book'));
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
            'success_url' => route("payment.success", $book) . '?session_id={CHECKOUT_SESSION_ID}', // "http://localhost:8000/payment/success?session_id={CHECKOUT_SESSION_ID}"
            // 'cancel_url' => 'http://localhost:8000/payment-cancel',
            'cancel_url' => route("payment.cancel", $book),
        ]);

        //? https://laravel.com/docs/9.x/responses#redirecting-external-domains
        return redirect()->away($checkout_session->url);
    }
}
