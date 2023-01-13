@extends('layouts.play')

@section('content-play')
    <section class="p-5">
        <div class="">
                <div class="">
                    <div class="">
                        @include('components.admin-tabs')
                        <hr class="">
                        <div class="mb-3 mt-10">
                          @include('components.track')
                        </div>
                    </div>
                </div>
        </div>
    </section>
@endsection
