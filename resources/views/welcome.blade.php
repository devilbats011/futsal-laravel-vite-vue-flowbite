@extends('layouts.play')

@section('content-play')
    <div class="relative flex min-h-screen flex-col justify-center overflow-hidden bg-[url('{{$bgGridUrl}}')]" >
        {{--? https://play.tailwindcss.com/img/grid.svg --}}
        {{-- <div class="w-72 h-72 bg-white bg-opacity-20 backdrop-blur-lg rounded drop-shadow-lg"></div> --}}
        <div
            class="mx-3 bottom-9 relative bg-transparent px-6 pt-6 pb-8 shadow-xl ring-1 ring-gray-900/5 sm:mx-auto sm:max-w-lg sm:rounded-lg sm:px-10 " >
            <div class="absolute w-full h-full  bg-white top-0 right-0 opacity-40 backdrop-blur-xl z-0"></div>
            <div class="mx-auto max-w-md relative z-10 text-[#004157] ">
                <div class="divide-y divide-gray-300/50">
                    <div class="text-center">
                        <h1 class="text-lg font-medium pb-5">FUTSAL MALAYA </h1>
                        <img src="{{ URL('futsal-logo.jpg') }}" alt="futsal-logo">
                    </div>
                    <div class=" py-8 text-base leading-7 text-gray-600">
                        {{-- https://stackoverflow.com/questions/51366437/best-practice-to-pass-data-from-laravel-to-vue-component --}}
                        {{-- <futsal-component test="{{$name}}" ></futsal-component> --}}
                        <hr class="my-3">

                        @include('components.view-courts')
                        <hr class="my-3">
                        <div class="text-justify">

                            @include('components.track')
                        </div>

                    </div>

                </div>
            </div>
        </div>
    </div>
@endsection
