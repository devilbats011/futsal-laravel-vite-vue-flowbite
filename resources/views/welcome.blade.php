@extends('layouts.play')

@section('content-play')
    <div class="relative flex min-h-screen flex-col justify-center overflow-hidden bg-gray-50">
        <div
            class="relative bg-white px-6 pt-10 pb-8 shadow-xl ring-1 ring-gray-900/5 sm:mx-auto sm:max-w-lg sm:rounded-lg sm:px-10">
            <div class="mx-auto max-w-md">
                <div class="divide-y divide-gray-300/50">

                    <div class=" py-8 text-base leading-7 text-gray-600">
                        {{-- https://stackoverflow.com/questions/51366437/best-practice-to-pass-data-from-laravel-to-vue-component --}}
                        {{-- <futsal-component test="{{$name}}" ></futsal-component> --}}
                        <h1 class="text-xl font-medium ">FUTSAL HOME</h1>
                        <hr class="my-3">

                        @include('components.view-courts')
                        <hr class="my-3">

                        @include('components.track')

                    </div>

                </div>
            </div>
        </div>
    </div>
@endsection
