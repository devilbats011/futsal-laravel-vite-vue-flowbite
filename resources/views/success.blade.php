@extends('layouts.play')

@section('content-play')
    <div class="py-5 px-6">
        {{-- !  - ADDEDD 'pending' for testing purpose --}}
        @if (in_array($book->payment->payment_status, ['counter', 'success']) )
            <h1> </h1>
            <section class="pb-1 space-y-1">
                <div
                    class="bg-green-100 text-green-800 text-xs font-medium inline-flex items-center px-2.5 py-2 rounded mr-2 dark:bg-gray-700 dark:text-gray-400 border border-green-500">

                    <svg aria-hidden="true" class="w-4 h-4 mr-1 text-green-800 dark:text-green-300" fill="currentColor"
                        viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd"
                            d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z"
                            clip-rule="evenodd"></path>
                    </svg>

                    <span>
                        Booking Success!
                    </span>
                </div>
                <div
                    class="bg-blue-100 text-blue-800 text-xs font-medium inline-flex items-center px-2.5 py-2 rounded dark:bg-gray-700 dark:text-blue-400 border border-blue-400">
                    <svg aria-hidden="true" class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20"
                        xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd"
                            d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-12a1 1 0 10-2 0v4a1 1 0 00.293.707l2.828 2.829a1 1 0 101.415-1.415L11 9.586V6z"
                            clip-rule="evenodd"></path>
                    </svg>

                    @if (strtolower($book->payment->payment_method) == 'counter')
                        Status: Pay At Our Counter
                    @elseif (strtolower($book->payment->payment_method) == 'online')
                        Status: Paid Online
                    @endif

                </div>
            </section>
            <section id="alert-additional-content-5"
                class="p-4 border border-gray-300 rounded-lg bg-gray-50 dark:border-gray-600 dark:bg-gray-800"
                role="alert">
                <div class="flex items-center">
                    <svg aria-hidden="true" class="w-5 h-5 mr-2 text-gray-800 dark:text-gray-300" fill="currentColor"
                        viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd"
                            d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z"
                            clip-rule="evenodd"></path>
                    </svg>
                    <span class="sr-only">Info</span>
                    <h3 class="text-lg font-medium text-gray-800 dark:text-gray-300">
                        Remember your booking number ! </h3>
                </div>
                <div class="mt-2 mb-3 text-sm text-gray-800 dark:text-gray-300">
                    <p class="px-1">We have sent an <span class="font-bold">email</span> regard your booking number.</p>
                </div>
                <div
                    class="px-3 py-2 mr-2 text-white bg-gray-700 hover:bg-gray-800 focus:ring-4 focus:outline-none focus:ring-gray-300 font-medium rounded-lg text-xs text-center inline-flex items-center dark:bg-gray-600 dark:hover:bg-gray-500 dark:focus:ring-gray-800">
                    <svg aria-hidden="true" class="-ml-0.5 mr-2 h-4 w-4" fill="currentColor" viewBox="0 0 20 20"
                        xmlns="http://www.w3.org/2000/svg">
                        <path d="M10 12a2 2 0 100-4 2 2 0 000 4z"></path>
                        <path fill-rule="evenodd"
                            d="M.458 10C1.732 5.943 5.522 3 10 3s8.268 2.943 9.542 7c-1.274 4.057-5.064 7-9.542 7S1.732 14.057.458 10zM14 10a4 4 0 11-8 0 4 4 0 018 0z"
                            clip-rule="evenodd"></path>
                    </svg>
                    <span class="text-xs"> Booking Number : {{ $book->book_number }}</span>
                </div>
                <p class="text-xs px-1 py-2"> You can track your booking info at our <a
                        class="hover:underline hover:text-blue-900 text-blue-600" href="{{ route('real.home') }}"
                        target="_blank"> Home Page</a></p>
                {{-- <div class="py-4"> --}}
                {{-- @include('components.view-courts') --}}

                {{-- </div> --}}
            </section>
        @else
            <h1 class="text-red-700 border p-3 w-fit rounded-md border-red-500 bg-red-50">Whoops, Something Wrong ☠️ ..
            </h1>
        @endif


    </div>
@endsection

</html>
