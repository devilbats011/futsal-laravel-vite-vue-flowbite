@extends('layouts.login-register')

@section('content')
    <main
        class="bottom-[150px] relative bg-transparent px-6 pb-8 shadow-xl ring-1 ring-gray-900/5 sm:mx-auto sm:max-w-lg sm:rounded-lg sm:px-10 ">
        <div class="absolute w-full h-full  bg-white top-0 right-0 opacity-40 backdrop-blur-xl z-0"></div>
        <section class="mx-auto max-w-md relative z-10 text-[#004157] ">
            <div class="divide-y divide-gray-300/50">
                <div class="flex flex-col space-y-6 py-5">
                    <h5 class="text-lg font-medium mt-2">{{ __('Reset Password') }}</h5>
                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif

                        <form method="POST" action="{{ route('password.email') }}">
                            @csrf

                            <div class="row mb-3">
                                <label for="email"
                                    class="col-md-4 col-form-label text-md-end">{{ __('Email Address') }}</label>

                                <div class="col-md-6">
                                    <input id="email" type="email"
                                        class="form-control @error('email') is-invalid @enderror" name="email"
                                        value="{{ old('email') }}" required autocomplete="email" autofocus>

                                    @error('email')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="mb-0">
                                <div class="">
                                    <button type="submit" class="border rounded py-2 px-4 bg-blue-500 text-white hover:bg-blue-700">
                                        {{ __('Send Password Reset Link') }}
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </section>
    </main>
@endsection
