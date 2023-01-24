@extends('layouts.login-register')

@section('content')
    <main
        class="mx-4 md:mx-auto bottom-[150px] relative bg-transparent px-6 pb-8 shadow-xl ring-1 ring-gray-900/5 sm:mx-auto sm:max-w-lg sm:rounded-lg sm:px-10 ">
        <div class="absolute w-full h-full  bg-white top-0 right-0 opacity-40 backdrop-blur-xl z-0"></div>
        <section class="mx-auto max-w-md relative z-10 text-[#004157]">
            <div class="divide-y divide-gray-300/50">
                <div class="flex flex-col space-y-6 py-5">
                    {{-- <divx class="card"> --}}

                    <h5 class="text-lg font-medium mt-3">{{ __('Confirm Password') }}</h5>
                    {{-- <div class="card-header">{{ __('Confirm Password') }}</div> --}}
                    <div class="card-body">
                        <h5 class="my-2">{{ __('Please confirm your password before continuing.') }}</h5>

                        <form class="space-y-3" method="POST" action="{{ route('password.confirm') }}">
                            @csrf

                            <div class="">
                                {{-- <div class="col-md-6"> --}}
                                    {{-- <label for="password"
                                        class="col-md-4 col-form-label text-md-end">{{ __('Password') }}</label>
                                    <input id="password" type="password"
                                        class="form-control @error('password') is-invalid @enderror" name="password"
                                        required autocomplete="current-password"> --}}

                                    @include('components.form-input-auth',['input'=>'password','type'=>'password','title'=> __('Password')])

                                    @error('password')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                {{-- </div> --}}
                            </div>

                            <div class="py-3">
                                <div class="">
                                    {{-- <button type="submit" class="btn btn-primary">
                                        {{ __('Confirm Password') }}
                                    </button> --}}
                                    @include('components.form-button-submit-auth',['name'=>__('Confirm Password')])
                                    @if (Route::has('password.request'))
                                        <a class="ml-auto text-sm text-blue-700 hover:underline dark:text-blue-500 relative left-2 block lg:inline-block" href="{{ route('password.request') }}">
                                            {{ __('Forgot Your Password?') }}
                                        </a>
                                    @endif
                                </div>
                            </div>
                        </form>
                    </div>
                    {{-- </divx> --}}
                </div>
            </div>
        </section>
    </main>
@endsection
