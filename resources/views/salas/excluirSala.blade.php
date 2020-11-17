<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Confirmar Exclusão - Santos</title>
    <!-- Fonts -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap">

    <!-- Styles -->
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <link rel="stylesheet" href="{{ asset('css/excluirSala.css') }}">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/tailwindcss/1.9.6/tailwind.min.css" 
    integrity="sha512-l7qZAq1JcXdHei6h2z8h8sMe3NbMrmowhOl+QkP3UhifPpCW2MC4M0i26Y8wYpbz1xD9t61MLT9L1N773dzlOA==" crossorigin="anonymous" />
    

    @livewireStyles

    <!-- Scripts -->
    <script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.7.3/dist/alpine.js" defer></script>
</head>

<body>
@livewire('navigation-dropdown')

<div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0 bg-gray-300"> <!--- GRID -->


        <!-- No php, pegamos dados através do campo "name" dos inputs -->
        <section class="painel w-full sm:max-w-md mt-6 px-6 py-4 bg-gray-100 sm:justify-center items-center shadow-md overflow-hidden sm:rounded-lg">
            <h1>Digite <span id="aleatorio"></span> para excluir a sala <b>{{$nomeSala}}</b></h1>
            <input class="input" type="text" id="numero_aleatorio" maxlength="3">
            <input type="button" onclick="excluir()" value="Apagar Sala" class="deleteButton items-center px-4 py-2 bg-blue-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase ">
            <p id="resposta"></p>
            @if (isset($MsgErro))
                <p>{{$MsgErro}}</p>
            @endif
            <a href="/salas">Voltar</a>
        </section>
 
    <script>
        var aleatorio = Math.floor(Math.random() * (999 - 100) + 100);
        var exibir = document.all["aleatorio"];
        exibir.innerHTML = aleatorio;
        
        function excluir() {
            var valor_digitado = document.all("numero_aleatorio").value;
            var resposta = document.all["resposta"];

            if (valor_digitado == aleatorio) {
                window.location.href = "/salas/sala/<?php echo $nomeSala ?>/excluir/<?php echo $salaId ?>/do";
            } else {
                resposta.innerHTML = "O valor informado não confere";
            }
        }   
    </script>
</body>

</html>