<?php

namespace App\Http\Requests;

use App\Models\Book;
use App\Models\User;
use Illuminate\Support\Carbon;
use App\Http\Requests\BaseBookRequest;
use Illuminate\Support\Facades\Auth;

class UpdateBookRequest extends BaseBookRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'book_date' => ['required', 'date', $this->updateBookDateClosure(), $this->bookDateClosure()],
            'court_number' => ['required', $this->courtNumberClosure()],
            'name' => ['required', 'regex:/^[a-zA-Z\s\']+$/'],
            'phone_no' => ['required', 'regex:/^[\+]?[(]?[0-9]{3}[)]?[-\s\.]?[0-9]{3}[-\s\.]?[0-9]{4,6}$/'],
            'email' => ['required', 'email'],
            'time_book_start' => ['required', $this->timeBookStartClosure()],
            'time_book_end' => ['required', $this->timeBookEndClosure()],
            'book_id' => ['required', $this->totalHoursClosure()],
        ];
    }

    public function courtNumberClosure()
    {
        return function ($attribute, $value, $fail) {
            /** @var \App\Models\User $user */
            $user = Auth()->user();
            // dd($user);
            $book = Book::find($this->book_id);
            if (!$this->courtNumberAuthorizeChecking($user,$book)) {
                return $fail("Only Admin can change Court Number, Please Contact Admin.");
            }
        };
    }

    private function courtNumberAuthorizeChecking($user,Book $book)
    {
        if($user) {

            //* normal user
            if($user->role != 'admin') {
                return $this->isBookCourtNumberSameValue($book->court->number);
            }

            //* return true if admin
            return true;
        }

        //* annoymouser user
        return $this->isBookCourtNumberSameValue($book->court->number);
    }

    private function isBookCourtNumberSameValue($bookCourtNumber) {
        return $bookCourtNumber == $this->court_number ? true : false;
    }

    public function updateBookDateClosure()
    {
        return function ($attribute, $value, $fail) {
            $dateNow = Carbon::Parse(Carbon::now()->toDateString());
            $book = Book::find($this->book_id);
            if (!$book)  return $fail('Book Court Does Not Exist');
            $dateValue = Carbon::Parse($book->book_date);
            if ($dateValue->lt($dateNow)) return $fail('Book date Expired, this book has Expired!');
        };
    }

    public function totalHoursClosure()
    {
        return function ($attribute, $value, $fail) {
            // dd($value,$attribute);
            $time_book_start = $this->time_book_start;
            $time_book_end = $this->time_book_end;
            $totalHour = $time_book_end - $time_book_start;
            $book = Book::find($value);
            if (!$book)  return $fail('Book Court Does Not Exist');
            $book_time_book_start = $book->time_book_start;
            $book_time_book_end = $book->time_book_end;
            $book_total_hour = $book_time_book_end - $book_time_book_start;
            if ($totalHour != $book_total_hour) {
                return $fail('Duration of hour must be the same and can\'t be change');
            }
        };
    }
}
