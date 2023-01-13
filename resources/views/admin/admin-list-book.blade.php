@extends('layouts.play')

@section('content-play')
    <section class="p-5">
        <div class="">
            <div class="">
                @include('components.admin-tabs')
                <hr class="">
                {{-- <div class="m-3 min-h-[300px] relative"> --}}
                {{-- <book-list secret-admin-code="{{$secretAdminCode}}" ></book-list> --}}
                {{-- </div> --}}

                <section
                    class="w-full mt-10 p-4 text-center bg-white border rounded-lg shadow-md sm:p-8 dark:bg-gray-800 dark:border-gray-700">
                    <h5 class="mb-2 text-2xl font-bold text-gray-900 dark:text-white"> List Booking </h5>

                    <section class="space-y-3">

                        <div class="px-2 text-justify "> Filter Search </div>

                        <form>
                            @csrf
                            <div class="flex flex-col md:flex-row">
                                <label for="search-dropdown"
                                    class="mb-2 text-sm font-medium text-gray-900 sr-only dark:text-white">Your
                                    Email</label>
                                <button id="dropdown-button" data-dropdown-toggle="filter-dropdown"
                                    class="flex-shrink-0 z-10 inline-flex items-center py-2.5 px-4 text-sm font-medium text-center bg-blue-300 border border-blue-300  my-2 md:my-auto rounded lg:rounded-none lg:rounded-l"
                                    type="button"> Choose Categories <svg aria-hidden="true" class="w-4 h-4 ml-1"
                                        fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                        <path fill-rule="evenodd"
                                            d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                            clip-rule="evenodd"></path>
                                    </svg></button>
                                @push('scripts')
                                    <script>
                                        function hideDropDownMenu(e) {

                                            const buttonFilterDropDown = document.getElementById('dropdown-button');
                                            buttonFilterDropDown.innerText = e.target.innerText;
                                            const filterDropDown = document.getElementById('filter-dropdown');
                                            const dropdown = new Dropdown(filterDropDown, buttonFilterDropDown);
                                            dropdown.hide();
                                        }
                                    </script>
                                @endpush
                                <nav id="filter-dropdown"
                                    class="z-10 hidden bg-white divide-y divide-gray-100 rounded shadow w-44 dark:bg-gray-700"
                                    data-popper-reference-hidden="" data-popper-escaped="" data-popper-placement="top"
                                    style="position: absolute; inset: auto auto 0px 0px; margin: 0px; transform: translate3d(897px, 5637px, 0px);">
                                    <ul class="py-1 text-sm text-gray-700 dark:text-gray-200"
                                        aria-labelledby="dropdown-button">
                                        @foreach (['Court Number', 'Name', 'Email', 'Phone', 'Book Date'] as $index => $item)
                                            <li class="" onclick="hideDropDownMenu(event)">
                                                <button type="button" id="{{ 'id-filter-' . $index }}"
                                                    class="inline-flex w-full px-4 py-2 hover:bg-blue-300 dark:hover:text-white">
                                                    {{ $item }}
                                                </button>
                                            </li>
                                        @endforeach
                                    </ul>
                                </nav>
                                <div class="relative w-full">
                                    <input type="search" id="search-dropdown"
                                        class="block p-2.5 w-full z-20 text-sm text-gray-900 bg-gray-50 rounded-r-lg border-l-gray-50 border-l-2 border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-l-gray-700  dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:border-blue-500"
                                        placeholder="Search Court Number, Name, Email ..." required>
                                    <button type="submit"
                                        class="absolute top-0 right-0 p-2.5 text-sm font-medium text-white bg-blue-700 rounded-r-lg border border-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                                        <svg aria-hidden="true" class="w-5 h-5" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                                        </svg>
                                        <span class="sr-only">Search</span>
                                    </button>
                                </div>
                            </div>
                        </form>


                    </section>



                    <div class="mb-5 text-base text-gray-500 sm:text-lg dark:text-gray-400">
                        {{-- Stay up to date and move work forward with Flowbite on iOS & Android. Download the app today. --}}

                        <div class="relative overflow-x-auto mt-10 shadow-md border rounded">
                            <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400" border="2"
                                style="border-collapse:collapse;">
                                <thead class="text-xs text-gray-700 uppercase bg-blue-300">
                                    <tr>
                                        <th scope="col" class="pl-4 py-3 border" width="140px">
                                            Court Number
                                        </th>
                                        <th scope="col" class="px-6 py-3 border">
                                            Name
                                        </th>
                                        <th scope="col" class="px-6 py-3 border">
                                            Email
                                        </th>
                                        <th scope="col" class="px-6 py-3 border">
                                            phone
                                        </th>
                                        <th scope="col" class="px-6 py-3 border" width="130px">
                                            Book Date
                                        </th>
                                        <th scope="col" class="px-6 py-3 border">
                                            Time Start - Time End
                                        </th>
                                        <th scope="col" class="px-6 py-3 border">
                                            Book Number
                                        </th>
                                        <th scope="col" class="px-6 py-3 border">
                                            Status
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($books as $book)
                                        <tr class="bg-white border dark:bg-gray-800 dark:border-gray-700 ">
                                            <th scope="row"
                                                class="pl-[3.6rem] py-4 font-medium whitespace-nowrap dark:text-white border">
                                                {{ $book->court->number }}
                                            </th>
                                            <td class="px-6 py-4 ">
                                                {{ $book->anonymous->name }}
                                            </td>
                                            <td class="px-6 py-4 border">
                                                {{ $book->anonymous->email }}
                                            </td>
                                            <td class="px-6 py-4 border">
                                                {{ $book->anonymous->phone_no }}
                                            </td>
                                            <td class="pl-5 py-4 border">
                                                {{ $book->book_date }}
                                            </td>
                                            <td class="pl-10 py-4 border">
                                                {{ convertTo12hoursFormat($book->time_book_start) }} -
                                                {{ convertTo12hoursFormat($book->time_book_end) }}
                                            </td>
                                            <td class="px-2 py-4 border">
                                                {{ $book->book_number }}
                                            </td>
                                            <td class="px-6 py-4 border">
                                                {{ $book->state }}
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        {{ $books->links() }}

                    </div>

                </section>






            </div>
        </div>
        @pushOnce('scripts')
            {{-- <script src="https://unpkg.com/flowbite@1.5.5/dist/flowbite.js"></script> --}}
            {{-- <script>

            </script> --}}
        @endPushOnce

    </section>
@endsection
