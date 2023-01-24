@extends('layouts.play')
@section('content-play')
<main class="p-5">
    {{-- @if (Session::has('message'))
        <div class="">{{ Session::get('message') }}</div>
        <br><br>
    @endif --}}

        {{ $book }}
    <form action="{{ route('book.payment.decision', $book) }}" method="POST" class="my-4">
        @csrf
        <label for="payment_method" class="block mb-2.5 text-lg font-medium text-gray-900 dark:text-white">Payment Method</label>
        <select for="payment_method" name="payment_method" id="payment_method" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
            {{-- <option value=""></option> --}}
            <option selected value="">Choose An Option</option>
            <option value="counter">Counter</option>
            <option value="online">Online</option>
        </select>

        <div class="my-2.5 flex">
            {{-- <input type="submit" value="Submit"> --}}
            @include('components.form-button-submit-auth',['name'=>'Submit'])
            <button type="button" data-modal-toggle="popup-modal" class="w-fit mr-2 focus:outline-none text-white bg-red-700 hover:bg-red-800 focus:ring-4 focus:ring-red-300 font-medium rounded-lg text-sm px-4 py-2.5 mb-2 dark:bg-red-600 dark:hover:bg-red-700 dark:focus:ring-red-900">
                Cancel
            </button>
        </div>
    </form>
    {{-- ? https://laravel.com/docs/4.2/validation#working-with-error-messages --}}
    @if ($errors->any())
        <h4>{{ $errors }}</h4>
    @endif

    {{-- ? https://stackoverflow.com/questions/21963327/looping-through-validation-errors-in-view --}}
    @foreach ($errors->all() as $error)
        {{ $error }}<br />
    @endforeach
    @include('components.delete-modal')
</main>
@endsection
