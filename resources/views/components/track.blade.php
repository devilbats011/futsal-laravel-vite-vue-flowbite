
<section>
    @if($errors->any())
        {{$errors}}
    @endif
</section>
<form method="post" action="{{ route('book.track') }}" class="mx-auto w-fit">
    @csrf
    <label> <h2 class="pb-2 pt-4"> Track Booking </h2> </label>
    <input type="text" class="rounded" name="book_number" id="book_number" required>

    <button type="submit"
        class="ml-1 my-2 lg:my-auto text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm  sm:w-auto px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800 min-w-fit">
        Track
    </button>
</form>
