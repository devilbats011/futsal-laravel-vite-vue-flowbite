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
    <!-- Scripts -->
    @vite(['resources/sass/app.scss'])
</head>

<body>
    @include('components.nav-toast')

    <div id="app" class="">
        @include('components.nav')
        <hr>
        <main class="relative flex min-h-screen flex-col justify-center overflow-hiddenn bg-[url('http://localhost:8000/bg-grid.svg')]" >
            {{-- ? bg-[url('https://play.tailwindcss.com/img/grid.svg')] bg-[url('{{URL("bg-grid.svg")}}')]  --}}
            {{-- <div class="w-72 h-72 bg-white bg-opacity-20 backdrop-blur-lg rounded drop-shadow-lg"></div> --}}
            @yield('content')

        </main>
    </div>
    @vite(['resources/js/app.js'])
    @stack('scripts')
</body>

</html>
