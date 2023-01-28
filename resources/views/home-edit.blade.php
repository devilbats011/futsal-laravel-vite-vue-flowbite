@extends('layouts.play')

@section('content-play')
    <div class="flex justify-center items-center flex-col relative w-10/12 mx-auto gap-y-8 mt-10">
        @include('components.header', ['normal_name' => 'Edit', 'colored_name' => 'Profile'])

        <div class="w-full bg-white sm:border border-gray-200 rounded-lg sm:shadow-md dark:bg-gray-800 dark:border-gray-700">
            <div class="flex justify-end px-4 pt-9">
            </div>
            <section class="flex w-fit mx-auto flex-col items-center mb-10 space-y-3 border rounded-lg shadow">
                <form action="{{ route('home.update', $user) }}" method="POST" class="pt-3 w-[270px]  mx-3 mb-3">
                    @csrf
                    @method('PUT')
                    <input type="hidden" name="user_id" value="{{ $user->id }}">
                    <div class="py-2 flex justify-center">
                        <img class="w-24 h-24 rounded-full shadow-lg" src="{{ URL('avatar-futsal-1.jpg') }}"
                            alt="Avatar image" />
                    </div>

                    <div class="group-input p-3">
                        <div class="relative">
                            {{-- rounded-t-lg px-2.5 pb-2.5 pt-5 w-full text-sm text-gray-900 bg-gray-50 dark:bg-gray-700 border-0 border-b-2 appearance-none dark:text-white dark:border-red-500 focus:outline-none focus:ring-0 focus:border-red-600 dark:focus-border-red-500 --}}
                            <input type="text" value="{{ $user->name }}" name="name" id="name"
                                class="block px-2.5 pb-2.5 pt-4 w-full text-sm @error('name')
                                border-red-600
                                @else
                                border-gray-300 dark:text-white dark:border-gray-600
                                @enderror
                                text-gray-900 bg-transparent rounded-lg border-1  appearance-none  dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer"
                                placeholder=" " />
                            <label for="name"
                                class="absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-4 scale-75 top-2 z-10 origin-[0] bg-white dark:bg-gray-900 px-2 peer-focus:px-2 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:-translate-y-1/2 peer-placeholder-shown:top-1/2 peer-focus:top-2 peer-focus:scale-75 peer-focus:-translate-y-4 left-1 capitalize">Name</label>
                        </div>
                        @error('name')
                            <p class="mt-2 ml-2 text-xs text-red-600 dark:text-red-400"><span class="font-medium">Oh,
                                    snapp!</span> {{ $message }}</p>
                        @enderror
                    </div>
                    <div class="group-input p-3">
                        <div class="relative">
                            {{-- rounded-t-lg px-2.5 pb-2.5 pt-5 w-full text-sm text-gray-900 bg-gray-50 dark:bg-gray-700 border-0 border-b-2 appearance-none dark:text-white dark:border-red-500 focus:outline-none focus:ring-0 focus:border-red-600 dark:focus-border-red-500 --}}
                            <input type="email" value="{{ $user->email }}" name="email" id="email"
                                class="block px-2.5 pb-2.5 pt-4 w-full text-sm @error('email')
                                border-red-600
                                @else
                                border-gray-300 dark:text-white dark:border-gray-600
                                @enderror
                                text-gray-900 bg-transparent rounded-lg border-1  appearance-none  dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer"
                                placeholder=" " />
                            <label for="email"
                                class="absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-4 scale-75 top-2 z-10 origin-[0] bg-white dark:bg-gray-900 px-2 peer-focus:px-2 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:-translate-y-1/2 peer-placeholder-shown:top-1/2 peer-focus:top-2 peer-focus:scale-75 peer-focus:-translate-y-4 left-1 capitalize">Email</label>
                        </div>
                        @error('email')
                            <p class="mt-2 ml-2 text-xs text-red-600 dark:text-red-400"><span class="font-medium">Oh,
                                    snapp!</span> {{ $message }}</p>
                        @enderror
                    </div>
                    <div class="group-input p-3">
                        <div class="relative">
                            {{-- rounded-t-lg px-2.5 pb-2.5 pt-5 w-full text-sm text-gray-900 bg-gray-50 dark:bg-gray-700 border-0 border-b-2 appearance-none dark:text-white dark:border-red-500 focus:outline-none focus:ring-0 focus:border-red-600 dark:focus-border-red-500 --}}
                            <input type="text" value="{{ $user->phone_no }}" name="phone_no" id="phone_no"
                                class="block px-2.5 pb-2.5 pt-4 w-full text-sm @error('phone_no')
                                border-red-600
                                @else
                                border-gray-300 dark:text-white dark:border-gray-600
                                @enderror
                                text-gray-900 bg-transparent rounded-lg border-1  appearance-none  dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer"
                                placeholder=" " />
                            <label for="phone_no"
                                class="absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-4 scale-75 top-2 z-10 origin-[0] bg-white dark:bg-gray-900 px-2 peer-focus:px-2 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:-translate-y-1/2 peer-placeholder-shown:top-1/2 peer-focus:top-2 peer-focus:scale-75 peer-focus:-translate-y-4 left-1 capitalize">Phone
                                No</label>
                        </div>
                        @error('phone_no')
                            <p class="mt-2 ml-2 text-xs text-red-600 dark:text-red-400"><span class="font-medium">Oh,
                                    snapp!</span> {{ $message }}</p>
                        @enderror
                    </div>
                    <div class="pb-5 pt-1.5 text-center">
                        <button type="submit"
                            class="w-11/12 text-white bg-gradient-to-r from-cyan-500 to-blue-500 hover:bg-gradient-to-bl focus:ring-4 focus:outline-none focus:ring-cyan-300 dark:focus:ring-cyan-800 font-medium rounded-lg text-sm px-5 py-2.5 text-center">
                            Update
                        </button>

                    </div>
                </form>

            </section>
        </div>

    </div>
@endsection
