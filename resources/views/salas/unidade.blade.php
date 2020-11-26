<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Fifo - Squad 6</title>

    <!-- Styles -->
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <link rel="stylesheet" href="{{ asset('css/unidade.css') }}">
    <link rel="stylesheet" href="{{ asset('css/global.css') }}">


    @livewireStyles

    <!-- Scripts -->
    <script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.7.3/dist/alpine.js" defer></script>
</head>

<body>
@livewire('navigation-dropdown')

        <!-- No php, pegamos dados através do campo "name" dos inputs -->
            <h2>Logotipo - Fifo</h2>
            <p>Escolha a unidade em que você está</p>

        <section class="grid"> <!-- box igual do login -->
           
            <a class="option " href="/unidade/santos">Santos</a>
            
            <a class="option " href="/unidade/saopaulo">São Paulo</a>
            
            
        </section>

        <a href="dashboard">Voltar</a>
  
</body>

</html>