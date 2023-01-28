@extends('layouts.play')

@section('content-play')
    <div class="flex justify-center items-center flex-col relative w-10/12 mx-auto gap-y-8 mt-10">

        @include('components.header',['colored_name'=>'Profile'])

        <div class="w-full bg-white border border-gray-200 rounded-lg shadow-md dark:bg-gray-800 dark:border-gray-700">
            <div class="flex justify-end px-4 pt-9">
            </div>

            <div class="flex flex-col items-center pb-10 space-y-1">
                <img class="w-24 h-24 mb-3 rounded-full shadow-lg" src="{{ URL('avatar-futsal-1.jpg') }}" alt="Avatar image" />
                <h3 class="mb-1 text-xl font-medium text-gray-900 dark:text-white p-1"  > {{ $user->name }} </h3>
                </h5>
                <h5 class="text-sm md:text-base text-gray-500 dark:text-gray-400"> Email: <span  class="p-2" >{{ $user->email }}</span>
                </h5>
                <h5 class="text-sm md:text-base text-gray-500 dark:text-gray-400"> Phone No:
                    <span  class="p-2">{{ $user->phone_no ?? 'No Info' }}</span> </h5>

                {{-- <div class="pt-4"><button class="border py-1 px-4 rounded-lg">Edit</button></div> --}}
            </div>
        </div>


        <div
            class="w-full p-4 text-center bg-white border rounded-lg shadow-md sm:p-8 dark:bg-gray-800 dark:border-gray-700">
            @include('components.header',['normal_name'=> 'History','colored_name'=>'Booked','direction'=>'reverse'])
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
                            @forelse ($books as $book)
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

        </div>
        {{-- </div> --}}
    </div>
@endsection
