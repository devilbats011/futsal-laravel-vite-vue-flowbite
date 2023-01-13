<?php

namespace App\Http\Controllers\Auth;

use App\Models\Book;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Log;

class AdminController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('admin');
    }

    private function secretAdminCode()
    {
        return mt_rand(1000, 9999) . "-" . strtoupper(Str::random(4));
    }

    public function index()
    {
        return view('admin');
    }

    public function sandbox()
    {
        $secret = '';
        /** @var \App\Models\User $user */
        $user = auth()->user();
        if ($user->role == 'admin') {
            $secret = GenerateSomeSaltyRandomCode();
            $user->secret =  $secret;
            $user->save();
        }

        $books = Book::With('anonymous')->with('court')->paginate(5);
        // dd($books);

        return view('admin.admin-list-book', [ 'secretAdminCode' => $secret,'books'=> $books ]);
    }

    public function log() {
        $logs = Log::query()->paginate(10);
        return view('admin.admin-log',compact('logs'));
    }
}
