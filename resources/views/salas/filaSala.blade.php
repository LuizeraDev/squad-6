<?php
    session_start();
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Fila</title>
</head>
<style>
    .container{
        margin-top: 15%;
    }
</style>
<body>
    <main>
        <!-- No php, pegamos dados através do campo "name" dos inputs -->
        <section class="container" align="center">
            <h2>Logotipo - Fifo</h2>
            <p>E aew <b>nome do usuário</b></p>
            <p>Você está na fila da sala <b>{{$nmSala}}</b> e sua posição é <b>posição fila usuário</b></p>
            <hr style="width: 30%;">
            <br>
            @if ($_SESSION['santos'])
                @foreach ($filaSantos as $fila) 
                    <p>Posição na fila: <b>{{$fila->cd_fila_usuario}}</b> Nome: <b>{{$fila->name}}</b> </p>
                @endforeach
            @else
                @foreach ($filaSaoPaulo as $fila) 
                     <p>Posição na fila: <b>{{$fila->cd_fila_usuario}}</b> Nome: <b>{{$fila->name}}</b> </p>
                @endforeach
            @endif
            <br><br>
            <a href="#">Vou Jogar</a>
            <br><br>
            <a href="#">Desistir</a>
        </section>
    </main>
</body>
</html>