{{-- Home Futsal show Courts --}}
@extends('layouts.play')

@section('content-play')
    <body>
        <div class="mx-auto">
            {{-- {{ route('book.home',0) }} --}}
                <courts routebook="{{ route('book.home') }}" courts="{{$courts}}" ></courts>
        </div>
    </body>
@endsection
