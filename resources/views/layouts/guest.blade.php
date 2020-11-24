<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Styles -->
        <link rel="stylesheet" href="{{ asset('css/app.css') }}">
        <link rel="stylesheet" href="{{ asset('css/login/tela.css') }}">
        <link rel="stylesheet" href="{{ asset('css/login/inputs.css') }}">
        <link rel="stylesheet" href="{{ asset('css/global.css') }}">
    </head>
    <body>
        <div class="grid sm:grid-cols-1 md:grid-cols-2 sm:justify-center items-center">
            {{ $slot }}
        </div>
            <!-- Scripts -->
            <script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.7.3/dist/alpine.js" defer></script>
    </body>
</html>
