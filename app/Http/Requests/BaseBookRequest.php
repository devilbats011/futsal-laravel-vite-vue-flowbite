<?php

namespace App\Http\Requests;

use App\Models\Book;
use App\Models\Court;
use Carbon\Carbon;
use Illuminate\Foundation\Http\FormRequest;

class BaseBookRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    public function getCourtId() {
       if($this->court_id) {
        return $this->court_id;
       }
       $id = Court::Where('number',$this->court_number)->first()->id;
       return $id;

    }

    public function bookDateClosure() {
        return function ($attribute,$value,$fail) {
            $dateNow = Carbon::Parse(Carbon::now()->toDateString());
            $dateValue = Carbon::Parse($value);
            if($dateValue->lt($dateNow)) return $fail('Book date can\'t be less than today');

        };
    }

    public function timeBookStartClosure()
    {

        return function ($attribute, $value, $fail) {
            $time_book_start = $value;
            $time_book_end = $this->time_book_end;

            if ($time_book_start == $time_book_end) {
                return $fail('start time and end time booking cannot be the same.');
            }

            if ($time_book_start > $time_book_end) {
                return $fail('time book start cannot be greater than time book end');
            }
            //? https://stackoverflow.com/questions/19325312/how-to-create-multiple-where-clause-query-using-laravel-eloquent
            $bookFirst = Book::Where([
                ['court_id', '=', $this->getCourtId()],
                ['book_date', '=', $this->book_date],
                ['time_book_start', '=', $time_book_start],
            ])
            ->where('state','<>','empty')
            ->first();
            if ($bookFirst) {
                return $fail('The time book has already been taken');
            }

            $booksCollection = Book::Where('court_id', $this->getCourtId())
                ->where('book_date', $this->book_date)
                ->where('state','<>','empty')
                ->get();
            $booksCollection->each(function ($item, $key) use ($time_book_start, $time_book_end, $fail) {
                $item_time_book_start = $item->time_book_start;
                $item_time_book_end = $item->time_book_end;

                if ($time_book_start > $item_time_book_start && $time_book_start < $item_time_book_end) {
                    return $fail('The time book start has already been taken');
                } else if ($time_book_start < $item_time_book_start && $time_book_end > $item_time_book_end) {
                    return $fail('The time book start has already been taken');
                } else if ($time_book_end > $item_time_book_start && $time_book_end < $item_time_book_end) {
                    return $fail('The time book start has already been taken');
                }
            });
        };
    }

    public function timeBookEndClosure()
    {
        return function ($attribute, $value, $fail) {

            $time_book_start = $this->time_book_start;
            $time_book_end = $value;

            //? https://stackoverflow.com/questions/19325312/how-to-create-multiple-where-clause-query-using-laravel-eloquent
            $bookFirst = Book::Where([
                ['court_id', '=', $this->getCourtId()],
                ['book_date', '=', $this->book_date],
                ['time_book_end', '=', $time_book_end],
            ])
            ->where('state','<>','empty')
            ->first();

            // ? https://laravel.com/docs/9.x/collections#method-first
            if ($bookFirst) {
                return $fail('The time book end has already been taken');
            }
        };
    }
}
