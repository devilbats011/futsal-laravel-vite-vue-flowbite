@extends('layouts.login-register')

@section('content')
    <main
        class="bottom-[100px] relative bg-transparent px-6 pb-8 shadow-xl ring-1 ring-gray-900/5 sm:mx-auto sm:max-w-lg sm:rounded-lg sm:px-10 ">
        <div class="absolute w-full h-full  bg-white top-0 right-0 opacity-40 backdrop-blur-xl z-0"></div>
        <section class="mx-auto max-w-md relative z-10 text-[#004157] ">
            <div class="divide-y divide-gray-300/50">
                <div class="flex flex-col space-y-4 py-5">
                    <h5 class="text-lg font-medium mt-2">{{ __('Reset Password') }}</h5>

                    <div class="">
                        <form class="space-y-2" method="POST" action="{{ route('password.update') }}">
                            @csrf
                            <input type="hidden" name="token" value="{{ $token }}">

                            <div class="">
                                {{-- <label for="email"
                                    class="col-md-4 col-form-label text-md-end">{{ __('Email Address') }}</label>

                                <div class="col-md-6">
                                    <input id="email" type="email"
                                        class="form-control @error('email') is-invalid @enderror" name="email"
                                        value="{{ $email ?? old('email') }}" required autocomplete="email" autofocus> --}}

                                @include('components.form-input-auth', [
                                    'title' => __('Email Address'),
                                    'type' => 'email',
                                    'input' => 'email',
                                ])

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                                {{-- </div> --}}
                            </div>

                            <div class="">
                                {{-- <label for="password"
                                    class="col-md-4 col-form-label text-md-end">{{ __('Password') }}</label>

                                <div class="col-md-6">
                                    <input id="password" type="password"
                                        class="form-control @error('password') is-invalid @enderror" name="password"
                                        required autocomplete="new-password"> --}}

                                @include('components.form-input-auth', [
                                    'title' => __('Password'),
                                    'type' => 'password',
                                    'input' => 'password',
                                ])

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            {{-- </div> --}}
                    </div>

                    <div class="">
                        {{-- <label for="password-confirm"
                                    class="col-md-4 col-form-label text-md-end">{{ __('Confirm Password') }}</label>

                                <div class="col-md-6">
                                    <input id="password-confirm" type="password" class="form-control"
                                        name="password_confirmation" required autocomplete="new-password">
                                </div> --}}
                        @include('components.form-input-auth', [
                            'title' => __('Confirm Password'),
                            'type' => 'password',
                            'input' => 'password_confirmation',
                        ])
                    </div>

                    <div class="py-4">
                        @include('components.form-button-submit-auth', [
                            'name' => __('Reset Password'),
                        ])
                        {{-- <button type="submit" class="border rounded py-2 px-4 bg-blue-500 text-white hover:bg-blue-700">
                                    {{ __('Reset Password') }}
                                </button> --}}
                    </div>
                    </form>
                </div>
            </div>

            </div>
        </section>
    </main>
@endsection
