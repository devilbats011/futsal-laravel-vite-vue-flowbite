<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">
    {{-- <meta http-equiv="Content-Security-Policy" content="default-src *; style-src 'self' 'unsafe-inline'; script-src 'self' 'unsafe-inline' 'unsafe-eval' https://checkout.stripe.com/ "> --}}
    <!-- Scripts -->
    @vite(['resources/sass/app.scss'])

</head>

<body>
    @include('components.nav-toast')

    <main id="app">
        @include('components.nav')
        <hr>
        <section class="pb-[6rem]">
            @yield('content-play')

        </section>
        <footer id="footer" class="p-4 text-xs sm:text-sm bg-white min-h-[3rem] text-slate-400">
            <p class="text-center px-1 pb-2 "> © 2023 ⚽  Futsal-Malaya™ All Rights Reserved.
            </p>
            <hr>
            <ul class="flex flex-col md:flex-row justify-end items-center gap-2 pt-3">
                <li class="md:border-r border-b md:border-b-transparent md:pr-2">
                    <p class="">Privacy Policy</p>
                </li>
                <li class="border-b md:border-b-transparent">
                    <p >Licensing</p>
                </li>

            </ul>
        </footer>



        </footer>
    </main>
    @stack('scripts')
    @vite(['resources/js/app.js'])
</body>



</html>
