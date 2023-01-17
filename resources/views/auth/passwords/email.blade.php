@extends('layouts.login-register')

@section('content')
    <main
        class="mx-4 md:mx-auto bottom-[150px] relative bg-transparent px-6 pb-8 shadow-xl ring-1 ring-gray-900/5 sm:mx-auto sm:max-w-lg sm:rounded-lg sm:px-10 ">
        <div class="absolute w-full h-full  bg-white top-0 right-0 opacity-40 backdrop-blur-xl z-0"></div>
        <section class="mx-auto max-w-md relative z-10 text-[#004157]">
            <div class="divide-y divide-gray-300/50">
                <div class="flex flex-col space-y-6 py-5">
                    <h5 class="text-lg font-medium mt-3">{{ __('Reset Password') }}</h5>
                    @if (session('status'))
                        <div class="p-4 mb-4 text-sm text-green-700 bg-green-100 rounded-lg dark:bg-gray-800 dark:text-green-400"
                            role="alert">
                            {{ session('status') }}
                            <span class="font-medium"> Thank You </span>
                        </div>
                    @else
                        <form method="POST" action="{{ route('password.email') }}" class="flex flex-col space-y-3">
                            @csrf

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


                            <div class="pl-1.5 pt-1.5 text-center">
                                @include('components.form-button-submit-auth', [
                                    'name' => __('Send Password Reset Link'),
                                ])
                            </div>
                        </form>
                    @endif
                </div>
            </div>
        </section>
    </main>
@endsection
