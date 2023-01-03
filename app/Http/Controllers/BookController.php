<?php

namespace App\Http\Controllers;

use Stripe;
use App\Models\Book;
use App\Models\User;
use App\Models\Court;
use App\Models\Anonymous;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use App\Http\Resources\BookCollection;
use Illuminate\Support\Facades\Session;

class BookController extends Controller
{
    public function apiBooks()
    {
        $books = Book::with(['court' => function ($query) {
            $query->select('id','number');
        }])
        ->paginate(5);
        $books = new BookCollection($books);
        return response()->json($books,200);
    }

    public function apiAdminBooks(Request $r)
    {
        //*can use either ->input('') or ->get('')
        if($r->input('secret'))
        {
            // $books =  Book::query()->getBooksAdmin($r->input('secret'));
            $books = Book::with(['court' => function ($query) {
                $query->select('id','number');
            }])->paginate(5);
            return response()->json($books,200);
        }
    }

    # Get
    public function book(Court $court,Request $r)
    {
        // dd($r->all());
        $books = Book::Where('book_date',Carbon::now()->format('Y-m-d'))
        ->where('court_id',$court->id)
        ->with(['court' => function ($query) {
            $query->select('id','number');
        }])
        ->get()->makeHidden(['book_number']);

        return view('book')
            ->with('court',$court)
            ->with('books',$books);
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
                // function ($attribute, $value, $fail) use ($request) {
                //     $time_book_start = Carbon::parse($value);
                //     $time_book_end = Carbon::parse($request->time_book_end);
                //     if ($time_book_start->gte($time_book_end)) {
                //         return $fail('time book start cannot be greater than time book end');
                //     }

                //     //creating unique logic at booking time
                //     //when thing get large -> be optimize with created date/updated date
                //     $booksCollection = Book::Where('court_id', $request->number)->get();
                //     // check start and end should be at least one hour apart..cannot the same
                //     // check if time_book change to CARBON then compare with b_end (time_book_carbon_end >= b_start && time_book_carbon_end <= b_end)
                //     $booksCollection->each(function ($item, $key) use ($value, $fail) {
                //         $time_book_start = Carbon::parse($value);
                //         $item_time_book_start = Carbon::parse($item->time_book_start);
                //         $item_time_book_end = Carbon::parse($item->time_book_end);
                //         if ($time_book_start->eq($item_time_book_start)) {
                //             return $fail('The time book has already been taken.');
                //         }
                //         if ($time_book_start->gt($item_time_book_start) && $time_book_start->lt($item_time_book_end)) {
                //             return $fail('The time book has already been taken.');
                //         }
                //     });
                // }
            ],
            'time_book_end' => [
                'required',
                // function ($attribute, $value, $fail) use ($request) {

                //     if ($request->time_book_start == $value) {
                //         $fail('start time and end time booking cannot be the same.');
                //     }
                //     $booksCollection = Book::Where('court_id', $request->number)->get();
                //     $booksCollection->each(function ($item, $key) use ($value, $fail) {

                //         $time_book_end = Carbon::parse($value);
                //         $item_time_book_start = Carbon::parse($item->time_book_start);
                //         $item_time_book_end = Carbon::parse($item->time_book_end);
                //         if ($time_book_end->eq($item_time_book_end)) {
                //             return $fail('The time book has already been taken.');
                //         }
                //         if ($time_book_end->gt($item_time_book_start) && $time_book_end->lt($item_time_book_end)) {
                //             return $fail('The time book has already been taken.');
                //         }
                //     });
                // },
            ],
            //device|not required
            // !name and phone_no cannot be change for user that have acc,they need to edit/update official first, user cant simply change...
            'name' => ['required'],
            'phone_no' => 'required'
        ]);
    }

    # Post
    public function bookCourt(Request $request)
    {
        $this->bookValidation($request);
        $isSave = false;
        $message = '';
        $error = '';
        $book = new Book;
        try {
            if (!Auth::check()) {
                $anonymous = Anonymous::create([
                    'name' => $request->name,
                    'phone_no' => $request->phone_no,
                    'device' => $request->device,
                ]);

                $book->anonymous_id = $anonymous->id;
            } else {
                $book->user_id = Auth()->id();
            }
            $book->court_id = $request->court_id;
            // $book->court_id = $request->number;
            $book->state = 'pending';
            $book->book_date = $request->book_date;
            $book->time_book_start = $request->time_book_start;
            $book->time_book_end = $request->time_book_end;
            $isSave = $book->save();
            $message = 'Booking Pending..';
        } catch (\Throwable $e) {
            $error = $e->getMessage();
        }

        return view('sandbox', [
            // 'book' => $book,
            'is_save' => $isSave,
            'book_id' => $book->id,
            'message' => $message,
            'error' => $error,
        ]);

        // ----------------
        # code...
        // $anonymous = new Anonymous;
        // $anonymous->name = $request->name;
        // $anonymous->phone_no = $request->phone_no;
        // $anonymous->device = $request->device;
        // $anonymous->save();
        // $book = Book::create([
        //     'court_id' => $request->number,
        //     'state' => 'booked',
        //     'time_book_start' => $request->time_book,
        // ]);
        // $isSave = $book->exists();
        // $book = new Book;
        // $book->court_id = $request->number;
        // $book->state = 'booked';
        // $book->time_book = $request->time_book;
        // dd("all",$request->all(),$request->number);
        //add policy to add booking date
        // 'user_id' => 1,
        // 'anonymous_id' => 1,

        // return response()->json([
        //     'is_save' => $isSave,
        //     'book_id' => $book->id,
        //     'message' => $message,
        //     'error' => $error,
        // ], 200);
    }

    # Put
    public function updateBook(Book $book, Request $request)
    {
        // dd($book,$request->all());
        $v = $request->validate([
            'court_number' => ['required'],
            'time_book_start' => ['required'],
            'time_book_end' => ['required'],
            'book_date' => ['required'],
        ]);
        $c = Court::where('number',$v['court_number'])->first();
        $o = collect($v)->except(['court_number']);
        $o->put('court_id', $c->id);
        $isUpdate = $book->update($o->toArray());
        // $this->bookValidation($request);
        Session::flash('message', $isUpdate ? 'Your book has been updated.' : 'Something Went Wrong..');
        return view('showbook', compact('book'));

        // *KIV...when update the validation will be inconsistent because does not exclude itself
        // todo: need to structure the frontend and integrate with backend first to continue this..

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

    // https://medium.com/@laraveltuts/laravel-9-stripe-payment-gateway-integration-example-79b17969b6eb
    public function stripe()
    {
        return view('stripe');
    }

    /**
     * success response method.
     *
     * @return \Illuminate\Http\Response
     */
    public function stripePost(Request $request)
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
}
