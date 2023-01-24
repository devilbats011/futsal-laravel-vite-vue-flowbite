<?php

namespace App\Http\Controllers;

use App\Models\Book;
use Illuminate\Http\Request;

class BookController extends Controller
{
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
}
