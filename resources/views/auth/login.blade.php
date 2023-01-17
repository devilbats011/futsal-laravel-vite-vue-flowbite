@extends('layouts.login-register')

@section('content')
    <main
        class="bottom-8 relative bg-transparent px-6 pb-8 shadow-xl ring-1 ring-gray-900/5 sm:mx-auto sm:max-w-lg sm:rounded-lg sm:px-10 ">
        <div class="absolute w-full h-full  bg-white top-0 right-0 opacity-40 backdrop-blur-xl z-0"></div>
        <div class="mx-auto max-w-md relative z-10 text-[#004157] ">
            <div class="divide-y divide-gray-300/50">
                <form class="space-y-5" method="POST" action="{{ route('login') }}">
                    @csrf
                    <h3 class="text-xl font-medium text-gray-900 dark:text-white text-center">Futsal Malaya</h3>
                    <img src="{{ URL('futsal-logo.jpg') }}" alt="futsal-logo" class="w-[330px]">
                    <h5 class="text-lg font-medium text-gray-800 dark:text-white">Login in to our platform</h5>
                    <div>
                        {{-- <label for="email" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Your
                            email</label>
                        <input type="email" name="email" id="email"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white"
                            placeholder="name@company.com" value="{{ old('email') }}" required autocomplete="email"
                            autofocus required> --}}

                        {{--  @error('email') is-invalid @enderror" --}}

                        @include('components.form-input-auth', ['title' => 'Your Email','type' => 'email','input' => 'email','placeholder' => 'name@company.com',])
                        @error('email')
                            <span class="text-red-400 text-sm px-2" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div>

                        {{-- <label for="password" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Your
                            password</label>
                        <input type="password" name="password" id="password" placeholder="••••••••"
                            autocomplete="current-password" value="password"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white"
                            required> --}}

                        @include('components.form-input-auth', ['title' => 'Password','type' => 'password','input' => 'password','value' => 'password','placeholder' => ' '])
                        @error('password')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="flex items-start">
                        <div class="flex items-start">
                            <div class="flex items-center h-5">
                                <input id="remember" value="" type="checkbox" name="remember" id="remember"
                                    {{ old('remember') ? 'checked' : '' }}
                                    class="w-4 h-4 border border-gray-300 rounded bg-gray-50 focus:ring-3 focus:ring-blue-300 dark:bg-gray-700 dark:border-gray-600 dark:focus:ring-blue-600 dark:ring-offset-gray-800 dark:focus:ring-offset-gray-800">
                                {{-- required --}}
                            </div>
                            <label for="remember" class="ml-2 text-sm font-medium text-gray-900 dark:text-gray-300">Remember
                                {{-- me</label> --}}
                        </div>
                        @if (Route::has('password.request'))
                            <a href="{{ route('password.request') }}"
                                class="ml-auto text-sm text-blue-700 hover:underline dark:text-blue-500">Lost Password?</a>
                        @endif
                    </div>
                    {{-- <button type="submit"
                        class="text-white bg-gradient-to-r from-cyan-500 to-blue-500 hover:bg-gradient-to-bl focus:ring-4 focus:outline-none focus:ring-cyan-300 dark:focus:ring-cyan-800 font-medium rounded-lg text-sm px-5 py-2.5 text-center mr-2 mb-2">
                        Login to your account
                    </button> --}}
                    @include('components.form-button-submit-auth',['name'=> 'Login to your account'])

                    <div class="text-sm font-medium text-gray-500 dark:text-gray-300">
                        Not registered? <a href="{{ route('register') }}"
                            class="text-blue-700 hover:underline dark:text-blue-500">Create account</a>
                    </div>

                </form>
            </div>
        </div>
        </div>
    @endsection
