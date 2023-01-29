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

                        <form id="form-id">
                            <div class="flex flex-col md:flex-row">
                                {{-- <label for="search-dropdown"
                                    class="mb-2 text-sm font-medium text-gray-900 sr-only dark:text-white">Your
                                    Email</label> --}}
                                <button id="dropdown-button" data-dropdown-toggle="filter-dropdown"
                                    class="flex-shrink-0 z-10 inline-flex items-center py-2.5 px-4 text-sm font-medium text-center text-white bg-blue-600 border border-blue-600  my-2 md:my-auto rounded lg:rounded-none lg:rounded-l"
                                    type="button">
                                    <p> Choose Categories </p>
                                    <svg aria-hidden="true" class="w-4 h-4 ml-1" fill="currentColor" viewBox="0 0 20 20"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <path fill-rule="evenodd"
                                            d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                            clip-rule="evenodd"></path>
                                    </svg>
                                </button>

                                <nav id="filter-dropdown"
                                    class="z-10 hidden bg-white divide-y divide-gray-100 rounded shadow w-44 dark:bg-gray-700"
                                    data-popper-reference-hidden="" data-popper-escaped="" data-popper-placement="top"
                                    style="position: absolute; inset: auto auto 0px 0px; margin: 0px; transform: translate3d(897px, 5637px, 0px);">
                                    <ul class="py-1 text-sm text-gray-700 dark:text-gray-200"
                                        aria-labelledby="dropdown-button">
                                        {{--  data-filter="{{$item}}" id="{{ 'id-filter-' . $index }}" --}}
                                        @foreach (['Court Number', 'Name', 'Email', 'Phone', 'Book Date'] as $index => $item)
                                            <li class="" onclick="hideDropDownMenu(event)">
                                                <button type="button"
                                                    class="inline-flex w-full px-4 py-2 hover:bg-blue-300 dark:hover:text-white">
                                                    {{ $item }}
                                                </button>
                                            </li>
                                        @endforeach
                                    </ul>
                                </nav>
                                <div class="relative w-full">
                                    {{-- ff: {{old('filter')}} {{ old('data')}} --}}
                                    <input type="search" id="search-dropdown" name="filter" onchange="searchChange()"
                                        class="block p-2.5 w-full z-20 text-sm text-gray-900 bg-gray-50 rounded-r-lg border-l-gray-50 border-l-2 border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-l-gray-700  dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:border-blue-500"
                                        placeholder="Search Court Number, Name, Email ...">

                                    <a type="submit" id="submit-id"
                                        class="cursor-pointer  absolute top-0 right-0 p-2.5 text-sm font-medium text-white bg-blue-600 rounded-r-lg border border-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                                        <svg aria-hidden="true" class="w-5 h-5" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                                        </svg>
                                        <span class="sr-only">Search</span>
                                    </a>
                                    {{-- <a id="filter-a" hidden>SEARCH</a> --}}

                                </div>
                            </div>
                        </form>


                    </section>



                    <div class="mb-5 text-base text-gray-500 sm:text-lg dark:text-gray-400">

                        <div class="relative overflow-x-auto mt-10 shadow-md  rounded">
                            @if (Request()->has('filter'))
                                <p class="text-justify p-2 text-sm">Filter Apply : {{ request('filter') }}
                                    @if (Request('data'))
                                        [ {{ request('data') }} ]
                                    @endif
                                </p>
                            @endif
                            <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400" border="2"
                                style="border-collapse:collapse;">
                                <thead class="text-xs text-white uppercase bg-blue-600">
                                    <tr>
                                        <th scope="col" class="pl-4 py-3 text-center border" width="140px">
                                            Counter
                                        </th>


                                        <th scope="col" class="text-center border">
                                            Payment Status
                                        </th>
                                        <th scope="col" class="text-center border">
                                            Payment Method
                                        </th>
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
                                    @forelse ($books as $book)
                                        <tr class="bg-white border dark:bg-gray-800 dark:border-gray-700 ">
                                            <td class="text-center">
                                                @if (($book->payment->payment_status ?? '') == 'counter')
                                                    <button
                                                        onclick="counterVerifyHandler({{ $book->id }})"
                                                        type="button"
                                                        data-modal-toggle="counter-popup-modal"
                                                        class="text-sm mt-1 bg-blue-600 hover:bg-blue-800 text-white rounded-lg px-2 py-2">
                                                        verify
                                                    </button>
                                                @else
                                                    <svg fill="none" class="w-5 h-5 m-auto text-slate-400"
                                                        stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"
                                                        xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            d="M6 18L18 6M6 6l12 12"></path>
                                                    </svg>
                                                @endif

                                            </td>
                                            <td class="border text-center">
                                                {{ $book->payment->payment_status ?? '' }}
                                            </td>
                                            <td class="text-center">
                                                {{ $book->payment->payment_method ?? '' }}
                                            </td>

                                            <td scope="row"
                                                class="pl-[3.6rem] py-4 font-medium whitespace-nowrap dark:text-white border">
                                                {{ $book->court?->number ?? '' }}
                                            </td>
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
                                    @empty
                                        <tr class="text-center">
                                            <td colspan="8" class="py-3 text-lg font-semibold">Empty..</td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>

                        </div>
                        {{ $books->links() }}

                    </div>

                </section>


            </div>
        </div>

        @include('components.admin-counter-modal')


        @push('scripts')
        <script>
            function hideDropDownMenu(e) {
                const buttonFilterDropDown = document.getElementById('dropdown-button');
                buttonFilterDropDown.querySelector('p').innerText = e.target.innerText;
                const filterDropDown = document.getElementById('filter-dropdown');
                const dropdown = new Dropdown(filterDropDown, buttonFilterDropDown);
                dropdown.hide();
                getFilterInfo();
            }

            function searchChange() {
                getFilterInfo();
            }

            function getFilterInfo() {
                const filterOptionArray = ['Court Number', 'Name', 'Email', 'Phone', 'Book Date'];
                const buttonFilterDropDown = document.getElementById('dropdown-button');
                let filter = buttonFilterDropDown.querySelector('p').innerText;
                const filterResult = filterOptionArray.find((opt) => {
                    if (opt.toLowerCase() == filter.toLowerCase()) return true;
                })

                if (filterResult) {
                    const a = document.getElementById('submit-id');
                    var url = new URL(window.location.href);
                    const inputEl = document.getElementById('search-dropdown');
                    url.searchParams.set('filter', filterResult);
                    url.searchParams.set('data', inputEl.value);
                    switch (filterResult.toLowerCase()) {
                        case 'court number':
                            url.searchParams.set('data_type', 'number');
                            break;
                        case 'name':
                            url.searchParams.set('data_type', 'name');
                            break;
                        case 'phone':
                            url.searchParams.set('data_type', 'phone_no');
                            break;
                        case 'email':
                            url.searchParams.set('data_type', 'email');
                            break;
                        case 'book date':
                            url.searchParams.set('data_type', 'book_date');
                            break;
                        default:
                            break;
                    }
                    url.searchParams.set('page', 1);

                    a.href = url;
                }
            }



            function counterVerifyHandler(bookId) {
                    setBookToFormAdminCounterVerify(bookId);
            }

            function setBookToFormAdminCounterVerify(_bookId) {
                    //* form-admin-counter-verify-id from include('components.admin-counter-modal')
                    const form = document.querySelector('#form-admin-counter-verify-id');
                    let splitAction = String(form.action).split('/');
                    splitAction.pop();
                    splitAction.push(_bookId);
                    let actionJoined = splitAction.join('/');
                    form.action = actionJoined;
            }

        </script>
    @endpush

    </section>
@endsection
