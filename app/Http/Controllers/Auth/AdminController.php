<?php

namespace App\Http\Controllers\Auth;

use App\Models\Log;
use App\Models\Book;
use App\Models\Court;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class AdminController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('admin');
    }

    // private function secretAdminCode()
    // {
    //     return mt_rand(1000, 9999) . "-" . strtoupper(Str::random(4));
    // }

    public function adminCourts()
    {
        $courts = Court::all()->sortBy('number');
        return view('admin.admin-courts', compact('courts'));
    }

    #PUT
    public function adminCounterVerify(Book $book, Request $request) {

        abort_if(!$book,404);

        $v = Validator::make($request->all(),[
            'payment_status' => ['required','in:success'],
        ])->validate();

       $book->payment->update($v);
       session()->flash('message','counter verify!');
       return back();
        // return view('admin.admin-counter');
    }


    public function index()
    {
        return view('admin');
    }

    public function sandbox(Request $request)
    {
        $filter = $request->filter;
        $data = $request->data;
        $data_type = $request->data_type;

        // dump($filter,$data);
        $secret = '';
        /** @var \App\Models\User $user */
        $user = auth()->user();
        if ($user->role == 'admin') {
            $secret = GenerateSomeSaltyRandomCode();
            $user->secret =  $secret;
            $user->save();
        }
        //    With('anonymous')
        $books = Book::WhereHas('anonymous', function ($query) use ($filter, $data, $data_type) {
            if ($filter) {
                switch ($data_type) {
                    case 'name':
                        return  $query->where('name','like', "%".$data."%");
                    case 'phone_no':
                        return  $query->where('phone_no','like', "%".$data."%");
                    case 'email':
                        return  $query->where('email','like', "%".$data."%");
                }
            }
        })
            ->whereHas('court', function ($query) use ($filter, $data, $data_type) {
                if ($filter) {
                    switch ($data_type) {
                        case 'number':
                            return  $query->where('number', $data);
                    }
                }
                // return $query->get();
            })
            ->when($filter, function ($query) use ($data, $data_type) {
                switch ($data_type) {
                    case 'book_date':
                        return $query->where('book_date','like', "%".$data."%");
                        break;
                }
            })
            ->paginate(5);
        $books->appends([
            'filter' => $filter,
            'data' => $data,
            'data_type' => $data_type,
        ]);
        return view('admin.admin-list-book', ['secretAdminCode' => $secret, 'books' => $books]);
    }

    // public function log()
    // {
    //     $logs = Log::query()->paginate(10);
    //     return view('admin.admin-log', compact('logs'));
    // }
}
