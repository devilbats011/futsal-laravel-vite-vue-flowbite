<div class="mx-auto my-5 w-fit text-sm text-red-400">
    @foreach ($errors->all() as $error)
    {{ $error }}
    <br/>
    @endforeach
</div>
