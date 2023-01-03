<h2> Track Booking </h2>
<section>
    @if($errors->any())
        {{$errors}}
    @endif
</section>
<form method="post" action="{{ route('book.track') }}">
    @csrf
    <input type="text" class="rounded" name="book_number" id="book_number" required>

    <button type="submit"
        class="ml-1 text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
        Track
    </button>
</form>
