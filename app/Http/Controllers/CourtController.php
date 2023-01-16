<?php

namespace App\Http\Controllers;

use App\Models\Log;
use App\Models\Court;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CourtController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $courts = Court::all();
        return view('courts', compact('courts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.courts-create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // $request->validate([]) ..
        $validateData = Validator::make(
            $request->all(),
            [
                'number' => ['required', 'numeric', 'unique:courts,number'],
                'type_floor' => ['required'],
                'hour_rate' => ['required', 'numeric'],

            ],
            [
                'number.required' => 'Court Number canot be Empty',
                'number.numeric' => 'Court Number must be Numeric',
                'number.unique' => 'Court Number Taken',
            ]
        );

        $validateData = $validateData->validated();

        $court = Court::Create($validateData);
        !$court->exists() ? session()->flash('message', 'Whoops Something Wrong') :  session()->flash('message', 'Court Created');
        return redirect()->route('admin.courts');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Court $court)
    {
        return view('admin.courts-edit', compact('court'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Court $court)
    {
        $validateData = Validator::make(
            $request->all(),
            [
                'number' => ['required', 'numeric', 'unique:courts,number'],
                'type_floor' => ['required'],
                'hour_rate' => ['required', 'numeric'],

            ],
            [
                'number.required' => 'Court Number canot be Empty',
                'number.numeric' => 'Court Number must be Numeric',
                'number.unique' => 'Court Number Taken',
            ]
        );

        $validateData = $validateData->validated();

        try {
            $oldCourtNumber = $court->number;
            $court->update($validateData);
            session()->flash('message', "Updated ~ Court Number Currently: {$court->number} | Court Number Before: {$oldCourtNumber}");
            return redirect()->route('admin.courts');
        } catch (\Throwable $e) {
            session()->flash('message', $e->getMessage());
            return back();
            // return abort(500, $e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy(Court $court)
    {
        try {
            $isDelete = $court->delete();
            if (!$isDelete) {
                // session()->flash('', '');
                abort(500, 'Whoops Something Wrong');
            }

            session()->flash('message', "court id {$court->id} | court number : {$court->number} deleted");
            return back();
        } catch (\Throwable $e) {
            session()->flash('message', $e->getMessage());
            return back();
            // abort(500, $e->getMessage());
        }
    }
}
