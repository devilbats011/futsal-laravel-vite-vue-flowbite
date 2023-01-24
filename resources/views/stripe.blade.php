@extends('layouts.play')

@section('content-play')
    {{-- ? https://flowbite.com/docs/components/card/#pricing-card --}}
    {{-- ? https://flowbite.com/application-ui/demo/e-commerce/invoice/# --}}
    <section class="my-5 mx-8">

        <div class="my-3">
            @include('components.breadcrumbs', [
                'data' => [
                    ['name' => 'Courts', 'route' => route('courts.index')],
                    ['name' => 'Payment Method', 'route' => route('book.payment', 1)],
                    ['name' => 'Checkout', 'current' => true],
                ],
            ])
        </div>
        {{-- class=""
        max-w-sm hover:bg-gray-100
        --}}
        <div class="block p-6 bg-white border border-gray-200 rounded-lg shadow-md dark:bg-gray-800 dark:border-gray-700 ">
            <div class="relative overflow-x-auto">
                <div class="flex flex-col mb-5 mt-3">
                    <div class="text-right">
                        <h1 class="font-extrabold text-gray-900 px-2 space-y-2">
                            <span class="text-3xl">
                                Invoice #00{{ $book->id }}
                            </span>
                            <p class="text-xl text-gray-800"> Booking Court {{ $book->court->number }} </p>
                        </h1>
                    </div>
                    <div class=" flex md:justify-start my-3">
                        <h1 class="text-lg font-extrabold text-gray-800 px-1">
                            {{-- <table class="text-lg font-extrabold text-gray-800 px-1">
                                <tr>
                                    <td class="text-right">  <span class="font-semibold text-right"> Name: </span> </td>
                                    <td> {{$book->anonymous->name}}</td>
                                </tr>

                                <tr>
                                    <td class="text-right"></td>  <span class="font-semibold"> email: </span> </td>
                                    <td> {{$book->anonymous->email}}</td>
                                </tr>

                                <tr>
                                    <td >  <span class="font-semibold"> Phone Number: </span> </td>
                                    <td> {{$book->anonymous->phone_no}}</td>
                                </tr>
                            </table> --}}
                            <p><span class="font-semibold">Name:</span> {{ $book->anonymous->name }}</p>
                            <p><span class="font-semibold">Email: </span>{{ $book->anonymous->email }}</p>
                            <p><span class="font-semibold">Phone Number: </span>{{ $book->anonymous->phone_no }}</p>
                        </h1>


                    </div>
                </div>
                {{-- <hr class=" border-gray-400 mb-2"> --}}
                <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                    <thead class="text-xs text-gray-900 uppercase dark:text-gray-400 border-b border-gray-400">
                        <tr>
                            <th scope="col" class="px-6 py-3">
                                Floor Type
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Rm / Hour
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Start Time - End Time
                            </th>
                            {{-- <th scope="col" class="px-6 py-3">
                                Total Hours
                            </th> --}}
                        </tr>
                    </thead>
                    <tbody class="border-gray-400 border-b">
                        <tr class="bg-white dark:bg-gray-800">
                            <th scope="row"
                                class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                {{ $book->court->type_floor }}
                            </th>

                            <th scope="row"
                                class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                {{ $book->court->hour_rate }}
                            </th>
                            <th scope="row"
                                class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                {{ $book->time_book_start }} - {{ $book->time_book_end }}
                            </th>

                        </tr>
                        {{-- <tr class="bg-white dark:bg-gray-800">
                        </tr>
                        <tr class="bg-white dark:bg-gray-800">
                        </tr> --}}
                    </tbody>
                </table>
            </div>
            {{-- <div class="md:px-5 my-2"></div> --}}

            <div class="md:px-3 mt-8 mb-3 text-right space-y-3">
                {{-- <hr class=" border-gray-400 mb-2"> --}}
                <h2 class=" text-right px-2 text-lg font-semibold">Total Hours: <span class="font-extrabold">
                        {{ totalHours($book->time_book_start, $book->time_book_end) }}
                    </span></h2>

                <section class="flex justify-end items-end md:gap-x-3 flex-col md:flex-row">
                    {{-- <form action="{{ route('book.payment.decision', $book) }}" method="POST">
                        @csrf
                        <button type="submit" --}}

                    <a href="{{ route('book.payment', $book->id) }}"
                        class="text-white bg-gradient-to-r from-red-400 via-red-500 to-red-600 hover:bg-gradient-to-br focus:ring-4 focus:outline-none focus:ring-red-300 dark:focus:ring-red-800 font-medium rounded-lg text-sm px-5 py-2.5 text-center mr-2 mb-2">
                        <svg class="hidden w-4 h-4 sm:inline-block" fill="none" stroke="currentColor" stroke-width="1.5"
                            viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M10.5 19.5L3 12m0 0l7.5-7.5M3 12h18">
                            </path>
                        </svg>

                        <span>
                            Back
                        </span>
                    </a>

                    <button type="button"
                    data-modal-toggle="popup-modal"
                        class="w-fit mr-2 focus:outline-none text-white bg-red-700 hover:bg-red-800 focus:ring-4 focus:ring-red-300 font-medium rounded-lg text-sm px-4 py-2.5 mb-2 dark:bg-red-600 dark:hover:bg-red-700 dark:focus:ring-red-900">
                        Cancel
                    </button>
                    {{-- </button> --}}
                    {{-- </form> --}}
                    <form action="{{ route('payment.stripe.v3', $book) }}" method="POST">
                        @csrf
                        @include('components.form-button-submit-auth', ['name' => 'Checkout'])
                    </form>
                    {{-- <button type="submit"
                        class="my-2 text-white bg-blue-600 hover:bg-blue-700 focus:ring-4 focus:outline-none focus:ring-blue-200 dark:focus:ring-blue-900 font-medium rounded text-sm px-5 py-2.5 inline-flex justify-center w-full text-center">
                        Checkout
                    </button> --}}
                </section>
            </div>
        </div>
        @include('components.delete-modal')
    </section>
@endsection
