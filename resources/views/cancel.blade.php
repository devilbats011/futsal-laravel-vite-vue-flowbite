@extends('layouts.play')

@section('content-play')
    <div class="mt-10 border rounded-lg shadow-lg w-10/12 mx-auto grid md:grid-cols-1 lg:grid-cols-2 ">
        {{-- <h1 class="text-3xl font-bold"> Payment Cancel </h1>` --}}
        <section class="lg:border-r border-b lg:border-b-0">
            <div class="m-5 md:p-5 ">

                <div class="text-center w-fit">@include('components.header', [
                    'colored_name' => 'Payment',
                    'normal_name' => 'Cancel',
                    'direction' => 'reverse',
                ])</div>

                <div class="block border border-slate-700 rounded-lg my-5 p-5 text-sm lg:text-base capitalize">
                    <h2 class="font-semibold mb-3">Payment Detail:</h2>
                    <section class="sm:grid grid-cols-3 pl-2.5 gap-y-2 text-slate-800">
                        <div class="text-start">Payment Status: </div>
                        <div class="text-start col-span-2">{{ $book->payment->payment_status }}</div>
                        <div class="text-start">Payment Method: </div>
                        <div class="text-start col-span-2 ">{{ $book->payment->payment_method }}</div>

                        <div class="text-start"> Online Gateway: </div>
                        <div class="text-start col-span-2">
                            {{ $book->payment->online_gateway_name }}
                        </div>

                    </section>
                </div>
                <div class="hidden md:block border border-slate-700 rounded-lg my-5 p-5 lg:text-base">

                    <h2 class="font-semibold mt-1 mb-3">Booking Detail:</h2>
                    <section class="grid grid-cols-3 pl-2.5 gap-y-1 text-slate-800">
                        <div class="text-start">Name: </div>
                        <div class="text-start col-span-2">{{ $book->anonymous->name }}</div>
                        <div class="text-start">Email: </div>
                        <div class="text-start col-span-2">{{ $book->anonymous->email }}</div>

                        <div class="text-start"> Times: </div>
                        <div class="text-start col-span-2">
                            {{ convertTo12hoursFormat($book->time_book_start) . ' - ' . convertTo12hoursFormat($book->time_book_end) }}
                        </div>
                        <div class="text-start"> Total Duration: </div>
                        <div class="text-start col-span-2">
                            {{ totalHours($book->time_book_start, $book->time_book_end) }} Hour

                        </div>


                    </section>

                </div>
            </div>

        </section>
        <section class="hidden md:block">
            {{-- <div class=" w-fit">@include('components.header',['colored_name'=>'Payment','normal_name'=>'Cancel','direction'=>'reverse'])</div> --}}
            <div class="block rounded-lg my-3 p-5">
                <div class="py-1 px-8">
                    <img src="{{ URL('futsal-logo.jpg') }}" class="w-full h-[270px] mx-auto shadow-lg rounded" alt=""
                        srcset="">

                    <div class="block border border-slate-700 rounded-lg my-5 p-5 text-sm lg:text-base capitalize">
                        <h2 class="font-semibold mb-3">Court Detail:</h2>
                        <section class="grid grid-cols-3 pl-2.5 gap-y-1 text-slate-800">
                            {{-- * row 1 * --}}
                            <div class="text-start"> Court No: </div>
                            <div class="text-start col-span-2">{{ $book->court->number }}</div>
                            <div class="text-start"> Type Floor: </div>
                            <div class="text-start col-span-2">{{ $book->court->type_floor }}</div>
                            <div class="text-start"> Rm/Hour: </div>
                            <div class="text-start col-span-2">{{ $book->court->hour_rate }}</div>
                        </section>
                    </div>
                </div>

            </div>
        </section>


    </div>
@endsection

</html>
