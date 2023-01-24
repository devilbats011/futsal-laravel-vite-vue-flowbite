@extends('layouts.play')

@section('content-play')
    <div class="p-3">
        <h1 class="text-3xl font-bold"> Payment Cancel </h1>
        <div>Detail: ... </div>
        @if (Session::has('message'))
            <div class="">{{ Session::get('message') }}</div>
        @endif
    </div>
@endsection

</html>
