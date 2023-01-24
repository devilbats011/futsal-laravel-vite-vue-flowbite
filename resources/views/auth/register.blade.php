@extends('layouts.login-register')

@section('content')
    {{-- https://flowbite.com/blocks/marketing/register/ --}}
    <main
        class="-bottom-6 relative bg-transparent px-6 pb-8 shadow-xl ring-1 ring-gray-900/5 sm:mx-auto sm:max-w-lg sm:rounded-lg sm:px-10 ">
        <div class="absolute w-full h-full  bg-white top-0 right-0 opacity-40 backdrop-blur-xl z-0"></div>
        <div class="mx-auto max-w-md relative z-10 text-[#004157] ">
            <div class="divide-y divide-gray-300/50">
                <div class="">
                    <div class="">
                        <div>
                            <div class="">
                                {{-- <div class="card-header">{{ __('Register') }}</div> --}}
                                <div class="">
                                    <form method="POST" action="{{ route('register') }}" class="space-y-5">
                                        @csrf
                                        <h3 class="text-xl font-medium text-gray-900 dark:text-white text-center">Futsal
                                            Malaya</h3>
                                        <img src="{{ URL('futsal-logo.jpg') }}" alt="futsal-logo" class="w-[330px]">
                                        <h5 class="text-lg font-medium text-gray-800 dark:text-white">
                                            Create An Account
                                        </h5>



                                        <div class="">
                                            {{-- <label for="name"
                                                class="col-md-4 col-form-label text-md-end">{{ __('Name') }}</label> --}}

                                            {{-- <div class="col-md-6"> --}}
                                            {{-- <input id="name" type="text"
                                                    class="form-control @error('name') is-invalid @enderror" name="name"
                                                    value="{{ old('name') }}" required autocomplete="name" autofocus> --}}
                                            @include('components.form-input-auth', [
                                                'title' => __('Name'),
                                                'type' => 'text',
                                                'input' => 'name',
                                                'placeholder' => ' ',
                                            ])
                                            @error('name')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                            {{-- </div> --}}
                                        </div>

                                        <div class="">
                                            {{-- <label for="name"
                                                class="col-md-4 col-form-label text-md-end">{{ __('Name') }}</label> --}}

                                            {{-- <div class="col-md-6"> --}}
                                            {{-- <input id="name" type="text"
                                                    class="form-control @error('name') is-invalid @enderror" name="name"
                                                    value="{{ old('name') }}" required autocomplete="name" autofocus> --}}
                                            @include('components.form-input-auth', [
                                                'title' => 'Phone Number',
                                                'type' => 'text',
                                                'input' => 'phone_no',
                                                'placeholder' => '0123456789',
                                            ])

                                            @error('name')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                            {{-- </div> --}}
                                        </div>

                                        <div class="">
                                            {{-- <label for="email"
                                                class="col-md-4 col-form-label text-md-end">{{ __('Email Address') }}</label>

                                            <div class="col-md-6">
                                                <input id="email" type="email"
                                                    class="form-control @error('email') is-invalid @enderror" name="email"
                                                    value="{{ old('email') }}" required autocomplete="email"> --}}
                                            @include('components.form-input-auth', [
                                                'title' => __('Email Address'),
                                                'type' => 'email',
                                                'input' => 'email',
                                                'placeholder' => ' ',
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
                                                    class="form-control @error('password') is-invalid @enderror"
                                                    name="password" required autocomplete="new-password"> --}}
                                            @include('components.form-input-auth', [
                                                'title' => __('Password'),
                                                'type' => 'password',
                                                'input' => 'password',
                                                'placeholder' => ' ',
                                            ])

                                            @error('password')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                            {{-- </div> --}}
                                        </div>

                                        <div class="">

                                            @include('components.form-input-auth', [
                                                'title' => __('Confirm Password'),
                                                'type' => 'password',
                                                'input' => 'password_confirmation',
                                                'placeholder' => ' ',
                                            ])

                                            {{-- <label for="password-confirm"
                                                class="col-md-4 col-form-label text-md-end">{{ __('Confirm Password') }}</label>

                                            <div class="col-md-6">
                                                <input id="password-confirm" type="password" class="form-control"
                                                    name="password_confirmation" required autocomplete="new-password">
                                            </div> --}}
                                        </div>

                                        <div class="mb-0">
                                            <div class="">
                                                @include('components.form-button-submit-auth',['name'=> __('Register') ])
                                                {{-- <button type="submit"
                                                    class="text-white bg-gradient-to-r from-cyan-500 to-blue-500 hover:bg-gradient-to-bl focus:ring-4 focus:outline-none focus:ring-cyan-300 dark:focus:ring-cyan-800 font-medium rounded-lg text-sm px-5 py-2.5 text-center mr-2 mb-2">
                                                    {{ __('Register') }}
                                                </button> --}}
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        </div>
    @endsection
