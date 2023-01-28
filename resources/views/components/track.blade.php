<section>
    @if ($errors->any())
        {{ $errors }}
    @endif
</section>
{{-- <section  class="flex mx-auto w-fit justify-center items-center">

    <div class="inline-block ml-2">
        @include('components.form-input-auth', [
        'input' => 'book_number',
        'type' => 'text',
        'placeholder' => ' ',
        'title' => 'Track Booking',
    ])</div>
    <div class="mt-9 ml-1 inline-block">
        <a href="{{ route('book.track','book_') }}"
        class="text-white bg-gradient-to-r from-cyan-500 to-blue-500 hover:bg-gradient-to-bl focus:ring-4 focus:outline-none focus:ring-cyan-300 dark:focus:ring-cyan-800 font-medium rounded-lg text-sm px-5 py-2.5 text-center mr-2 mb-2">
            Track
        </a>

    </div>


</section> --}}
<form method="post" action="{{ route('book.track') }}" class="flex mx-auto w-fit justify-center items-center">
    @csrf

    <div class="inline-block ml-2">
        @include('components.form-input-auth', [
        'input' => 'book_number',
        'type' => 'text',
        'placeholder' => ' ',
        'title' => 'Track Booking',
    ])</div>
    <div class="mt-9 ml-1 inline-block"> @include('components.form-button-submit-auth', ['name' => 'Track'])</div>


</form>
