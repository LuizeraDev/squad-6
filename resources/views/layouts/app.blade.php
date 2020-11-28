<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta content="width=device-width, initial-scale=1" name="viewport" />
        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Importando tailwind -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/tailwindcss/1.9.6/tailwind.min.css" 
        integrity="sha512-l7qZAq1JcXdHei6h2z8h8sMe3NbMrmowhOl+QkP3UhifPpCW2MC4M0i26Y8wYpbz1xD9t61MLT9L1N773dzlOA==" 
        crossorigin="anonymous" />

        <!-- Styles -->
        <link rel="stylesheet" href="{{ asset('css/app.css') }}">
        <link rel="stylesheet" href="{{ asset('css/dashboard.css') }}">
        <link rel="stylesheet" href="{{ asset('css/global.css') }}">
    
        @livewireStyles
    </head>

    <body>
        <div class="navBar">
            @livewire('navigation-dropdown')
        </div>
            <!-- Page Heading -->
        

            <!-- Page Content -->
            <main class="main">
                {{ $slot }}
            </main>
            
           
        

        @stack('modals')

        @livewireScripts

        <!-- Scripts -->
        <script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.7.3/dist/alpine.js" defer></script>
    </body>

</html>
