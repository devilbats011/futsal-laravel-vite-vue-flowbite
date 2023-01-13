@extends('layouts.play')

@section('content-play')
    <div class="p-3">

        <div> Success </div>
        <h1>Pay At Counter.</h1>
        REMEMBER BOOK NUMBER ! WE HAVE SENT EMAIL ABOUT YOUR BOOK NUMBER <br>
        @if ($data)
        <p class="underline"> Book Number : {{ $data }}</p>
        @endif
        ---
        @include('components.view-courts')
        <br><br>
        @if (Session::has('message'))
            <div class="">{{ Session::get('message') }}</div>
        @endif
    </div>
@endsection

</html>
