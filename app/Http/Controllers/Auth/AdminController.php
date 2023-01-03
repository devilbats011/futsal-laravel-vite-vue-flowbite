<?php

namespace App\Http\Controllers\Auth;

use App\Models\Book;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AdminController extends Controller
{
    public function __construct() {
        $this->middleware('auth');
        $this->middleware('admin');
    }

    private function secretAdminCode() {
        return mt_rand(1000, 9999)."-".strtoupper(Str::random(4));
    }

    public function index() {
        return view('admin');
    }

    public function sandbox()
    {
        // dd($this->secretAdminCode());
        return view('admin.admin-sandbox',['secretAdminCode'=>$this->secretAdminCode()]);
    }
}
