<?php 
$url='http://localhost:8080/squad-6/storage/app/public/';
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

            @foreach($dadosUsuario as $dados)
            <p>E aew <b>{{$dados->name}}</b></p>
            <p>Você está na fila da sala <b>{{$nmSala}}</b> e sua posição é <b>{{$dados->cd_fila_usuario}}</b></p>
            @endforeach
            
            <hr style="width: 30%;">
            <br>

            @if ($_SESSION['santos'])
                @foreach ($filaSantos as $fila) 
                    @if($fila->profile_photo_path)
                        <span>Foto do usuário:</span>
                        <img src={{$url.$fila->profile_photo_path}} width=30 alt="Foto do usuário">
                    @endif
                    <span>Posição na fila: <b>{{$fila->cd_fila_usuario}}</b> Nome: <b>{{$fila->name}}</b></span>
                    <br><br>
                @endforeach
            @else
                @foreach ($filaSaoPaulo as $fila) 
                    @if($fila->profile_photo_path)
                        <span>Foto do usuário:</span>
                        <img src={{$url.$fila->profile_photo_path}} width=30 alt="Foto do usuário">
                    @endif
                     <span>Posição na fila: <b>{{$fila->cd_fila_usuario}}</b> Nome: <b>{{$fila->name}}</b></span>
                     <br><br>
                @endforeach
            @endif

            <br><br>
            <a href="#">Vou Jogar</a>
            <br><br>
            <a href="{{$salaId}}/desistente">Desistir</a>
        </section>
    </main>
</body>
</html>