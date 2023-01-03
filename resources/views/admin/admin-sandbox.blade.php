@extends('layouts.play')

@section('content-play')
    <section class="container p-5">
        <div class="navbar-nav ms-auto">
            <p>name: {{ Auth::user()->name }} | role: {{ Auth::user()->role }} | FOR ADMIN ONLY~</p>
            <div class="row justify-content-center">
                <div class="col-md-8">
                    @include('components.admin-tabs')
                    <hr class="">
                    <div class="m-3 min-h-[300px] relative">
                        {{-- {{$secretAdminCode}} --}}
                        {{--  data-dropdown-toggle="dropdownDividerState" --}}
                        <book-list secret-admin-code="{{$secretAdminCode}}" ></book-list>

                    </div>

                </div>
            </div>

        </div>
        @pushOnce('scripts')
            {{-- <script src="https://unpkg.com/flowbite@1.5.5/dist/flowbite.js"></script> --}}
            {{-- <script>

            </script> --}}
        @endPushOnce

    </section>
@endsection
