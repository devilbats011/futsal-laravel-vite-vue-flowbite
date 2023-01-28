<?php

namespace App\Http\Controllers;

use App\Http\Requests\UpdateUserRequest;
use App\Models\Book;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    #GET
    public function index()
    {
        /** @var \App\Models\User $user */
        $user = auth()->user();
        $books = Book::Where('user_id',$user->id)->with('anonymous')->with('court')->paginate(5);
        // dd($books);
        return view('home',compact('books','user'));
    }

    #GET
    public function edit() {
        $user = auth()->user();
        return view('home-edit',compact('user'));
    }

    #PUT
    public function update(User $user,UpdateUserRequest $r) {
        $isUpdate = $user->update($r->safe()->only(['name','email','phone_no']));
        abort_if(!$isUpdate,500);
        session()->flash('message','User Info Updated!');
        return redirect()->route('home');
    }
}
