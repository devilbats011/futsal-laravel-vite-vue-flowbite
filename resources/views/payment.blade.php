@extends('layouts.play')
@section('content-play')
    <main class="p-5">
        <form action="{{ route('book.payment.decision', $book) }}" method="POST"
            class="my-4 p-4 bg-blue-50 border-sky-200 border rounded-lg">
            @csrf
            <label for="payment_method" class="flex gap-x-1 mb-2.5 text-lg font-medium text-blue-800 dark:text-white">
                <svg class="w-5 h-5 relative top-1" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"
                    xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M9.879 7.519c1.171-1.025 3.071-1.025 4.242 0 1.172 1.025 1.172 2.687 0 3.712-.203.179-.43.326-.67.442-.745.361-1.45.999-1.45 1.827v.75M21 12a9 9 0 11-18 0 9 9 0 0118 0zm-9 5.25h.008v.008H12v-.008z">
                    </path>
                </svg>
                <span>Choose Payment Method</span>
            </label>
            {{-- ? https://laravel.com/docs/9.x/blade#validation-errors --}}
            <select for="payment_method" name="payment_method" id="payment_method"
                class="@error('payment_method') bg-red-50 border border-red-500 text-red-900 placeholder-red-700 text-sm rounded-lg focus:ring-red-500 dark:bg-gray-700 focus:border-red-500 block w-full p-2.5 dark:text-red-500 dark:placeholder-red-500 dark:border-red-500 @else bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500 @enderror">
                <option selected value="">Choose An Option</option>
                <option value="counter">Counter</option>
                <option value="online">Online</option>
            </select>
            @error('payment_method')
                <p class="ml-1 my-2 text-sm text-red-600 dark:text-red-500">
                    <span class="font-medium">Oh, snapp!</span>
                    {{ $message }}
                </p>
            @enderror

            <div class="my-4     mb-2 flex">
                @include('components.form-button-submit-auth', ['name' => 'Submit'])
                <button type="button" data-modal-toggle="popup-modal"
                    class="w-fit mr-2 focus:outline-none text-white bg-red-700 hover:bg-red-800 focus:ring-4 focus:ring-red-300 font-medium rounded-lg text-sm px-4 py-2.5 mb-2 dark:bg-red-600 dark:hover:bg-red-700 dark:focus:ring-red-900">
                    Cancel
                </button>
            </div>
        </form>

        @include('components.delete-modal')
    </main>
@endsection
