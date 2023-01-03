<?php

namespace App\Http\Controllers;

use App\Models\Court;
use Illuminate\Http\Request;

class CourtController extends Controller
{
    public function courts()
    {
        $courts = Court::all();
        return view('courts',compact('courts'));
    }
}
