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

                        <a href="{{ route('courts.home') }}"
                            class="inline-flex items-center font-medium text-blue-600 dark:text-blue-500 hover:underline">
                            <svg aria-hidden="true" class="ml-1 w-5 h-5" fill="currentColor" viewBox="0 0 20 20"
                                xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd"
                                    d="M12.293 5.293a1 1 0 011.414 0l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414-1.414L14.586 11H3a1 1 0 110-2h11.586l-2.293-2.293a1 1 0 010-1.414z"
                                    clip-rule="evenodd"></path>
                            </svg>
                            VIEW COURTS
                        </a>
                        <hr class="my-3">

                        @include('components.track')

                    </div>

                </div>
            </div>
        </div>
    </div>
@endsection
