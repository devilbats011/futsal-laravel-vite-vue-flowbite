@extends('layouts.play')

@section('content-play')
    <section class="p-5">
        <div class="">
            @include('components.admin-tabs')
            <hr class="">
            <div class="p-5">
                <h1 class="text-lg py-3 m-0 text-white font-medium text-center bg-blue-700 rounded-t">
                    Edit Court
                </h1>
                {{-- <form action="{{route('courts.store')}}" method="POST" class="p-7" > --}}
                    <form action="{{route('courts.update',$court)}}" method="POST" class="p-5 border">
                        @include('components.errors')
                    @csrf
                    @method('PUT')
                    @include('components.form-input', ['title' => 'Court Number','type' => 'number','input' => 'number','value'=> $court->number])
                    @include('components.form-input', ['title' => 'Type Floor','type' => 'text','input' => 'type_floor','value'=> $court->type_floor])
                    @include('components.form-input', ['title' => 'Hour Rate (RM)','type' => 'number','input' => 'hour_rate','value'=> $court->hour_rate])
                    @include('components.form-button-submit',['name' => 'Edit'])
                </form>
            </div>
        </div>
    </section>
@endsection

