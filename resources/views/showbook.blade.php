@extends('layouts.play')

@section('content-play')


    <main class="p-5">
        <div>
            @if (!$book)
                <h1 class="text-lg font-semibold text-red-400 p-5"> No Data Found..</h1>
            @else
                <h2 class="text-xl font-semibold">BOOK NUMBER : {{ $book->book_number }}</h2>
                <section class="py-6">
                    <div class="border p-3 rounded">
                        <h2 class="text-xl font-medium">Current Book Detail</h2>
                        {{-- {{$book}} --}}
                        <div class="space-y-2 py-2">

                            <div class=""> Name : {{ $book->anonymous->name }} </div>
                            <div class=""> Phone No : {{ $book->anonymous->phone_no }} </div>
                            <div class=""> Email : {{ $book->anonymous->email }} </div>
                            <div class=""> Court Number : {{ $book->court->number }} </div>
                            <div class=""> Total Duration (Hour) :
                                {{ totalHours($book->time_book_start, $book->time_book_end) }} </div>
                            <div class=""> Time Book Start <span class="text-sm"> </span> :
                                {{ convertTo12hoursFormat($book->time_book_start) }} </div>
                            <div class=""> Time Book End <span class="text-sm"> </span> :
                                {{ convertTo12hoursFormat($book->time_book_end) }} </div>
                            <div class=""> Book Date : {{ $book->book_date }} </div>

                        </div>
                    </div>

                </section>

                <section class="py-6">



                    {{-- ! errors --}}
                    @if ($errors->any())
                        <section class="p-2 mb-1 flex gap-3 flex-col sm:flex-row transition-all">
                            <div class="w-full flex p-4 mb-4 text-sm text-red-800 border border-red-300 rounded-lg"
                                role="alert">
                                <svg aria-hidden="true" class="flex-shrink-0 inline w-5 h-5 mr-3" fill="currentColor"
                                    viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                    <path fill-rule="evenodd"
                                        d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z"
                                        clip-rule="evenodd"></path>
                                </svg>
                                <span class="sr-only"> Errors:</span>
                                <div>
                                    <span class="font-medium"> Error while editing info:</span>
                                    <ul class="mt-1.5 ml-4 list-disc list-inside">
                                        {!! implode('', $errors->all('<li>:message</li>')) !!}
                                    </ul>
                                </div>
                            </div>
                        </section>
                    @endif

                    <form action="{{ route('book.edit', $book->id) }}" method="POST" class="border space-y-4 p-3 rounded">
                        @csrf
                        @method('PUT')

                        <h2 class="text-xl font-medium">Edit Book Detail </h2>



                        <div class="@auth @if (auth()->user()->role != 'admin') {{ 'hidden' }} @endif @endauth @guest {{'hidden'}} @endguest">
                            <label class="inline-block w-[150px]" for="court_number"> Court Number : </label>
                            {{-- <label for="court_number"
                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Select an
                                option</label> --}}
                            <select id="court_number" name="court_number" required
                                class="mt-2 mb-4 bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                {{-- <option selected hidden value="{{ $book->court->number }}"> Choose Court Number </option> --}}
                                @foreach ($courts as $key => $court)
                                    <option value="{{ $court->number }}"
                                        {{ $book->court->number == $court->number ? 'selected' : '' }}>
                                        {{ $court->number }}</option>
                                @endforeach
                            </select>

                            {{-- <input type="number" id="court_number" name="court_number" required
                                value=""> --}}
                        </div>


                        <div>
                            <label class="inline-block w-[150px]"> Name : <p class="text-xs "> </p>
                            </label>
                            <input class="rounded relative bottom-0" type="text" name="name" id="name"
                                value="{{ $book->anonymous->name }}">
                        </div>
                        <div>
                            <label class="inline-block w-[150px]"> Phone No : <p class="text-xs "> </p>
                            </label>
                            <input class="rounded relative bottom-0" type="text" name="phone_no" id="phone_no"
                                value="{{ $book->anonymous->phone_no }}">
                        </div>
                        <div class="pb-5">
                            <label class="inline-block w-[150px]"> Email: <p class="text-xs "> </p>
                            </label>
                            <input class="rounded relative bottom-0" type="text" name="email" id="email"
                                value="{{ $book->anonymous->email }}">
                        </div>


                        <div class="border-t relative py-4 border-slate-200">

                            <span class="flex items-center text-sm font-medium text-gray-900 dark:text-white"><span
                                    class="flex w-2.5 h-2.5 bg-indigo-500 rounded-full mr-1.5 flex-shrink-0"></span>

                                Total Duration: {{ totalHours($book->time_book_start, $book->time_book_end) }} Hour
                            </span>



                        </div>
                        <div>
                            {{-- {{ $book->time_book_start }} 9 --}}
                            {{-- {{ $book->time_book_end }} 10 --}}
                            <label class="inline-block w-[150px]"> Time Book Start: <p class="text-xs ">
                                </p> </label>
                            {{-- <input class="rounded relative bottom-0" type="number" id="time_book_start" name="time_book_start" required
                                max="24" min="9" value="{{ $book->time_book_start }}"> --}}
                            <select name="time_book_start" id="time_book_start" class="rounded relative bottom-0">

                                {{-- <option value="{{ $book->time_book_start }}"  hidden> {{ convertTo12hoursFormat($book->time_book_start) }} </option> --}}
                                @foreach ($times as $hour24format => $hour12format)
                                    <option value="{{ $hour24format }}"
                                        {{ $book->time_book_start == $hour24format ? 'selected' : '' }}>
                                        {{ $hour12format }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div>
                            <label class="inline-block w-[150px]"> Time Book End: <p class="text-xs "> </p>
                            </label>
                            {{-- <input class="rounded relative bottom-0" type="number" id="time_book_end" name="time_book_end" required
                                max="24" min="9" value="{{ $book->time_book_end }}"> --}}
                            <select name="time_book_end" id="time_book_end" class="rounded relative bottom-0">
                                {{-- <option value="{{ $book->time_book_end }}"  hidden> {{ convertTo12hoursFormat($book->time_book_end) }} </option> --}}
                                @foreach ($times as $hour24format => $hour12format)
                                    <option value="{{ $hour24format }}"
                                        {{ $book->time_book_end == $hour24format ? 'selected' : '' }}>{{ $hour12format }}
                                    </option>
                                @endforeach
                            </select>
                            {{--  animate-bounce bg-gray-200 text-slate-700 border-slate-300 --}}

                            <div data-tooltip-target="tooltip-default" data-modal-target="booktable-modal"
                                data-modal-toggle="booktable-modal"
                                class="my-2 relative bottom-0 inline-block w-fit cursor-pointer transition duration-700 ease-in-out hover:rotate-[360deg] bg-blue-600 hover:bg-gradient-to-br from-blue-500 via-blue-600 to-blue-700 text-white text-base font-extrabold mx-2  px-[1rem] py-[.5rem] rounded-full dark:bg-purple-900 dark:text-purple-300">
                                ?
                                {{-- --}}
                            </div>
                            <div id="tooltip-default" role="tooltip"
                                class="absolute z-10 invisible inline-block px-3 py-2 text-sm font-medium text-white transition-opacity duration-300 bg-gray-700 rounded-lg shadow-sm opacity-0 tooltip dark:bg-gray-700">
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
                        {{-- class=" text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800"> --}}
                        <div class="flex gap-2 flex-col md:flex-row">
                            <button type="submit"
                                class="flex m-2 relative w-fit bottom-[2px] text-sm  px-5 py-2.5 text-white bg-gradient-to-r from-blue-500 via-blue-600 to-blue-700 hover:bg-gradient-to-br focus:ring-4 focus:outline-none focus:ring-blue-300 dark:focus:ring-blue-800 font-medium rounded-xl text-center">
                                Submit
                            </button>

                            @auth()
                                @if (auth()->user()->role == 'admin')
                                    <div class="my-1.5 mx-2 md:mx-0">
                                        <button
                                            class="px-3 py-2.5 focus:outline-none text-white bg-red-700 hover:bg-red-800 focus:ring-4 focus:ring-red-300 font-medium rounded-lg text-sm dark:bg-red-600 dark:hover:bg-red-700 dark:focus:ring-red-900"
                                            type="button" data-modal-toggle="popup-modal">
                                            Delete
                                        </button>
                                    </div>
                                @else
                                    <span
                                        class="bg-gray-100 text-gray-800 text-xs font-semibold px-4 pt-[1.2rem] pb-2 sm:pb-2 rounded-lg dark:bg-gray-700 dark:text-gray-300">
                                        Contact Admin to cancel booking.
                                        (+0134567790)
                                    </span>
                                @endif
                            @endauth
                            @guest()
                                <span
                                    class="bg-gray-100 text-gray-800 text-xs font-semibold px-4 pt-[1.2rem] pb-4 sm:pb-2 rounded-lg dark:bg-gray-700 dark:text-gray-300">
                                    Contact Admin to cancel booking.
                                    (+0134567790)
                                </span>
                            @endguest


                        </div>
                        <input type="hidden" name="book_id" id="book_id" value="{{ $book->id }}">

                    </form>

                    @include('components.showbooking-modal')
                    @include('components.delete-modal')

                </section>
            @endif

        </div>
    </main>
@endsection
