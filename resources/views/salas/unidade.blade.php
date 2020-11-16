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

    <div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0 bg-gray-100"> <!--- GRID -->
        <!-- No php, pegamos dados através do campo "name" dos inputs -->
        <section class="w-full sm:max-w-md mt-6 px-6 py-4 bg-white shadow-md overflow-hidden sm:rounded-lg" align="center"> <!-- box igual do login -->
            <h2>Logotipo - Fifo</h2>
            <p>Escolha a unidade em que você está</p>
            <button class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md
             font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900
              focus:outline-none focus:border-gray-900 focus:shadow-outline-gray disabled:opacity-25 transition
               ease-in-out duration-150 ml-4"> <a href="/unidade/santos">Santos</a> </button>
            <br><br><br>
            <button class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md
             font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900
              focus:outline-none focus:border-gray-900 focus:shadow-outline-gray disabled:opacity-25 transition
               ease-in-out duration-150 ml-4"> <a href="/unidade/saopaulo">São Paulo</a></button>
            <br><br><br>
            <a href="dashboard">Sair</a>
        </section>
    </div>
</body>
</html>