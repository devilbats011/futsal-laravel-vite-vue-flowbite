@extends('layouts.play')

@section('content-play')


    <main class="p-5">
        {{-- <h1 class="mb-3 font-normal text-xl">
            BOOKING DETAIL
        </h1> --}}
        <div>
            @if (!$book)
                <p class="text-sm font-medium text-red-400 pt-5"> No Data Found..</p>
            @else
                <h2 class="text-xl font-semibold">BOOK NUMBER : {{ $book->book_number }}</h2>
                <section class="py-6">
                    <div class="border p-3 rounded">
                        <h2 class="text-xl font-medium">Current Book Detail</h2>
                        {{-- {{$book}} --}}
                        <div class="space-y-2 py-2">
                            <div class=""> Court Number : {{ $book->court->number }} </div>
                            <div class=""> Time Book Start : {{ $book->time_book_start }} </div>
                            <div class=""> Time Book End : {{ $book->time_book_end }} </div>
                            <div class=""> Book Date : {{ $book->book_date }} </div>

                        </div>
                    </div>

                </section>

                <section class="py-6">
                    <form action="{{ route('book.edit', $book->id) }}" method="POST" class="border space-y-4 p-3 rounded">
                        @method('PUT')
                        @csrf
                        <h2 class="text-xl font-medium">Edit Book Detail </h2>
                        <div class="">
                            <label class="inline-block w-[150px]" for="court_number"> Court Number : </label>
                            {{-- <label for="court_number"
                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Select an
                                option</label> --}}
                            <select id="court_number" required
                                class="mt-2 mb-4 bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                <option selected hidden value="{{ $book->court->number }}"> Choose Court Number </option>
                                <option value="1">1</option>
                                <option value="2">2</option>
                                <option value="3">3</option>
                                <option value="4">4</option>
                                <option value="5">5</option>
                            </select>

                            {{-- <input type="number" id="court_number" name="court_number" required
                                value=""> --}}
                        </div>

                        {{-- <div class="flex flex-col md:flex-row gap-3"> --}}
                        <div>
                            <label class="inline-block w-[150px]"> Time Book Start : </label>
                            <input class="rounded" type="number" id="time_book_start" name="time_book_start" required
                                max="24" min="9" value="{{ $book->time_book_start }}">
                        </div>
                        <div>
                            <label class="inline-block w-[150px]"> Time Book End : </label>
                            <input class="rounded" type="number" id="time_book_end" name="time_book_end" required
                                max="24" min="9" value="{{ $book->time_book_end }}">

                                {{--  animate-bounce bg-gray-200 text-slate-700 border-slate-300--}}
                                <div data-tooltip-target="tooltip-default" class="inline-block w-fit cursor-pointer transition ease-in-out  bg-blue-400  text-white text-base font-extrabold mx-2  px-[1rem] py-[.5rem] rounded-full dark:bg-purple-900 dark:text-purple-300">?</div>
                                <div id="tooltip-default" role="tooltip" class="absolute z-10 invisible inline-block px-3 py-2 text-sm font-medium text-white transition-opacity duration-300 bg-gray-700 rounded-lg shadow-sm opacity-0 tooltip dark:bg-gray-700">
                                        Show Booking Table
                                    <div class="tooltip-arrow mb-[2px]" data-popper-arrow></div>
                                </div>
                        </div>
                        {{-- </div> --}}

                        <div>
                            <label class="inline-block w-[150px]"> Book Date : </label>
                            <input class="rounded" class="rounded" type="date" id="book_date" name="book_date" required
                                value="{{ $book->book_date }}">
                        </div>
                        <hr class="my-3">
                        <div class="flex gap-2 flex-col md:flex-row">
                            <button type="submit"
                                class=" text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                                Submit
                            </button>
                            @auth()
                                @if (auth()->user()->role == 'admin')
                                    <button
                                        class="focus:outline-none text-white bg-red-700 hover:bg-red-800 focus:ring-4 focus:ring-red-300 font-medium rounded-lg text-sm px-5 py-2.5 dark:bg-red-600 dark:hover:bg-red-700 dark:focus:ring-red-900"
                                        type="button" data-modal-toggle="popup-modal">
                                        Delete
                                    </button>
                                @else
                                    <span
                                        class="bg-gray-100 text-gray-800 text-xs font-semibold px-2.5 py-3 rounded dark:bg-gray-700 dark:text-gray-300">
                                        Contact Admin to Cancel booking.
                                    </span>
                                @endif
                            @endauth
                            @guest()
                                <span
                                    class="bg-gray-100 text-gray-800 text-xs font-semibold px-2.5 py-3 rounded dark:bg-gray-700 dark:text-gray-300">
                                    Contact Admin to Cancel booking.
                                </span>
                            @endguest

                        </div>


                    </form>

                    <div id="popup-modal" tabindex="-1"
                        class="fixed top-0 left-0 right-0 z-50 hidden p-4 overflow-x-hidden overflow-y-auto md:inset-0 h-modal md:h-full">
                        <div class="relative w-full h-full max-w-md md:h-auto">
                            <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                                <button type="button"
                                    class="absolute top-3 right-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center dark:hover:bg-gray-800 dark:hover:text-white"
                                    data-modal-toggle="popup-modal">
                                    <svg aria-hidden="true" class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <path fill-rule="evenodd"
                                            d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
                                            clip-rule="evenodd"></path>
                                    </svg>
                                    <span class="sr-only">Close modal</span>
                                </button>
                                <div class="p-6 text-center">
                                    <form action="{{ route('book.delete', $book->id) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <svg aria-hidden="true"
                                            class="mx-auto mb-4 text-gray-400 w-14 h-14 dark:text-gray-200" fill="none"
                                            stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                        </svg>
                                        <h3 class="mb-5 text-lg font-normal text-gray-500 dark:text-gray-400">Are you sure
                                            you want to delete this product?</h3>
                                        <button data-modal-toggle="popup-modal" type="submit"
                                            class="text-white bg-red-600 hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 dark:focus:ring-red-800 font-medium rounded-lg text-sm inline-flex items-center px-5 py-2.5 text-center mr-2">
                                            Yes, I'm sure !
                                        </button>
                                        <button data-modal-toggle="popup-modal" type="button"
                                            class="text-gray-500 bg-white hover:bg-gray-100 focus:ring-4 focus:outline-none focus:ring-gray-200 rounded-lg border border-gray-200 text-sm font-medium px-5 py-2.5 hover:text-gray-900 focus:z-10 dark:bg-gray-700 dark:text-gray-300 dark:border-gray-500 dark:hover:text-white dark:hover:bg-gray-600 dark:focus:ring-gray-600">No,
                                            cancel</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>

                </section>
            @endif

        </div>
    </main>
@endsection
