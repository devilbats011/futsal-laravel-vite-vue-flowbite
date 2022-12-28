<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BookController extends Controller
{
    # Post
    public function bookCourt(Request $request)
    {
        // $book = new Book;
        // $book->court_id = $request->number;
        // $book->state = 'booked';
        // $book->time_book = $request->time_book;

        // dd("all",$request->all(),$request->number);

        // $this->authorize('create', $book); //policy kena user sekali, x blh independent..use model event closure or observers
        $book = Book::create([
            'court_id' => $request->number,
            'state' => 'booked',
            'time_book' => $request->time_book,
        ]);

        //add policy to add booking date
        // 'user_id' => 1,
        // 'anonymous_id' => 1,
        # if Auth true add it to user table
        // if(Auth::check()){
        //     //add
        // }

        return response()->json([
            'isSave' => $book->exists(),
            'book_id' => $book->id,
        ], 200);
    }
}
