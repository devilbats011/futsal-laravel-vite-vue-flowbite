@extends('layouts.play')

@section('content-play')

    <main>

        <div class="m-5">
            {{-- {{ $court }} --}}
            {{-- {{ $books}} --}}
            {{-- <a href="{{ route('courts.index') }}"
                class="inline-flex items-center font-medium text-blue-600 dark:text-blue-500 hover:underline">
                <svg aria-hidden="true" class="ml-1 w-5 h-5" fill="currentColor" viewBox="0 0 20 20"
                    xmlns="http://www.w3.org/2000/svg">
                    <path fill-rule="evenodd"
                        d="M12.293 5.293a1 1 0 011.414 0l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414-1.414L14.586 11H3a1 1 0 110-2h11.586l-2.293-2.293a1 1 0 010-1.414z"
                        clip-rule="evenodd"></path>
                </svg>
                VIEW OTHER COURTS
            </a> --}}
            @include('components.view-courts')

            <h1 class="mt-2 pt-2 pb-8 text-xl">
                Booking Court {{ $court->number }}
                <hr class="border-black">
            </h1>
            <section class="overflow-x-auto relative shadow-md sm:rounded-lg">
                <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                    <thead class="text-xs text-gray-700 uppercase bg-blue-300 dark:bg-gray-700 dark:text-gray-400">
                        <tr>
                            <th scope="col" class="py-3 px-6">
                                Court Number
                            </th>

                            <th scope="col" class="py-3 px-6">
                                floor type
                            </th>
                            <th scope="col" class="py-3 px-6">
                                Hourly rate
                            </th>

                        </tr>
                    </thead>
                    <tbody>
                        <tr
                            class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                            <th scope="row"
                                class="py-4 px-6 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                {{ $court->number }}
                            </th>
                            <td class="py-4 px-6">
                                {{ $court->type_floor }}
                            </td>
                            <td class="py-4 px-6">

                                RM{{ $court->hour_rate }}
                            </td>
                        </tr>
                    </tbody>
                </table>
            </section>
            <section class="pt-6">

                {{-- ? https://laravel.com/docs/9.x/requests#retrieving-old-input --}}
                <book
                    old-phone-no="{{ old('phone_no') }}"
                    old-start="{{old('time_book_start')}}"
                    old-end="{{old('time_book_end')}}"
                    old-name="{{ old('name') }}"
                    old-email="{{ old('email') }}"
                    errors="{{ $errors }}"
                    books="{{ $books }}"
                    book_date={{ $book_date }}
                    route-action="{{ route('book.add') }}"
                    court="{{ $court }}"
                    csrf="{{ csrf_token() }}"
                    user="{{auth()->user()}}"
                ></book>
            </section>

        </div>

    </main>
@endsection

{{-- <script>
    document.getElementById("device").value = window.navigator.userAgent;
    // document.getElementById("book_date").value = new date();
</script> --}}
