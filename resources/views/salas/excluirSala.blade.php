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

    @livewireStyles

    <!-- Scripts -->
    <script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.7.3/dist/alpine.js" defer></script>
</head>
<style>
    .container {
        margin-top: 15%;
    }
</style>

<body>

<div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0 bg-gray-100"> <!--- GRID -->

    <main>
        <!-- No php, pegamos dados através do campo "name" dos inputs -->
        <section class="container" align="center">
            <p>Digite <span id="aleatorio"></span> para excluir a sala <b>{{$nomeSala}}</b></p>
            <input type="text" id="numero_aleatorio" maxlength="3"><br><br>
            <input type="button" onclick="excluir()" value="Apagar Sala">
            <p id="resposta"></p>
            @if (isset($MsgErro))
                <p>{{$MsgErro}}</p>
            @endif
            <a href="/salas">Voltar</a>
        </section>
    </main>
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