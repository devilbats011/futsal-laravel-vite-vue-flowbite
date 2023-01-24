@extends('layouts.play')

@section('content-play')
    <section class="p-5">
        <div class="">
            @include('components.admin-tabs')
            <hr class="">
            <div class="p-5">
                <div class="mx-3 my-5 px-3 rounded-md">
                    <section class="overflow-x-auto relative shadow-md mb-5 rounded">
                        <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                            <thead class="text-xs  uppercase bg-blue-700 text-white">
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
                                    <th scope="col" class="py-3 px-6 text-center">
                                        Option
                                    </th>

                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($courts as $index => $court)
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
                                        <td class="py-4 px-6 relative ">
                                            <ul class="text-center">
                                                <li class="space-x-1 space-y-1 text-white">
                                                    <a href="{{ route('courts.edit', $court) }}"
                                                        class="border px-4 py-2.5 rounded-lg bg-green-500">
                                                        Edit
                                                    </a>
                                                    <button
                                                        onclick="deleteHandler(event)"
                                                        class="focus:outline-none text-white bg-red-700 hover:bg-red-800 focus:ring-4 focus:ring-red-300 font-medium rounded-lg text-sm px-4 py-2.5 dark:bg-red-600 dark:hover:bg-red-700 dark:focus:ring-red-900"
                                                        type="button" data-modal-toggle="popup-modal"
                                                        id="btn-del-id-{{$court->id}}"
                                                        data-court-id="{{$court->id}}">
                                                        Delete
                                                    </button>
                                                    {{-- <form method="POST" action="{{ route('courts.destroy', $court) }}"
                                                        class="inline-block">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button class="border py-1 px-1.5 bg-red-500 rounded">
                                                            Delete
                                                        </button>
                                                    </form> --}}
                                                </li>
                                            </ul>
                                        </td>
                                    </tr>
                                @endforeach
                                @push('scripts')
                                    <script></script>
                                @endpush
                            </tbody>
                        </table>
                        @include('components.court-modal')
                    </section>
                    <div>
                        <a type="button" href="{{ route('courts.create') }}"
                            class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">
                            Add Court
                        </a>
                    </div>


                </div>
            </div>
    </section>
@endsection
