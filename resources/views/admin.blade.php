@extends('layouts.play')

@section('content-play')
    <section class="container p-5">
        <div class="navbar-nav ms-auto">

         <p>name: {{ Auth::user()->name }} | role: {{ Auth::user()->role }} | FOR ADMIN ONLY~</p>
            <!-- Authentication Links -->
            @guest
                @if (Route::has('login'))
                    <div class="nav-item">
                        <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                    </div>
                @endif

                @if (Route::has('register'))
                    <div class="nav-item">
                        <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                    </div>
                @endif
            @else
                <div class="row justify-content-center">
                    <div class="col-md-8">
                        {{-- <div class="card border">
                            <div class="card-header">{{ __('Dashboard') }} | ADMIN </div>
                            <div class="card-body">
                                @if (session('status'))
                                    <div class="alert alert-success" role="alert">
                                        {{ session('status') }}
                                    </div>
                                @endif
                                {{ __('You are logged in!') }}
                            </div>
                        </div> --}}

                        {{-- border-b --}}

                        @include('components.admin-tabs')
                        <hr class="">
                        <div class="nav-item dropdown my-3">
                          @include('components.track')
                        </div>
                    </div>
                </div>

            @endguest
        </div>

    </section>
@endsection
