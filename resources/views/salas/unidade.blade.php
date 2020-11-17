<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Fifo - Squad 6</title>
    <!-- Fonts -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/tailwindcss/1.9.6/tailwind.min.css" 
    integrity="sha512-l7qZAq1JcXdHei6h2z8h8sMe3NbMrmowhOl+QkP3UhifPpCW2MC4M0i26Y8wYpbz1xD9t61MLT9L1N773dzlOA==" crossorigin="anonymous" />

    <!-- Styles -->
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <link rel="stylesheet" href="{{ asset('css/unidade.css') }}">


    @livewireStyles

    <!-- Scripts -->
    <script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.7.3/dist/alpine.js" defer></script>
</head>

<body>
@livewire('navigation-dropdown')


    <div class="min-h-full flex sm:justify-center items-center md:pt-0 lg:pt-0 sm:pt-0 xl:pt-0 mt-10"> <!--- GRID -->
        <!-- No php, pegamos dados através do campo "name" dos inputs -->
        
        <section class="flex flex-col sm:justify-center items-center w-full sm:max-w-md mt-6 px-6 py-4 bg-white shadow-md overflow-hidden sm:rounded-lg"> <!-- box igual do login -->
            <h2>Logotipo - Fifo</h2>
            <p>Escolha a unidade em que você está</p>
            <a class="option max-w-sm rounded overflow-hidden bg-gray-500 shadow-lg tracking-widest hover:bg-blue-600 text-white font-bold py-2 px-4 border border-gray-200 rounded" href="/unidade/santos">Santos</a>
            
            <a class="option max-w-sm rounded overflow-hidden bg-gray-500 shadow-lg tracking-widest hover:bg-blue-600 text-white font-bold py-2 px-4 border border-gray-200 rounded" href="/unidade/saopaulo">São Paulo</a>
            
            <a href="dashboard">Sair</a>
        </section>
    </div>
</body>
</html>