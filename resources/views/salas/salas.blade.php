
<head>
    <link rel="stylesheet" href="{{ asset('css/salas.css') }}">
</head>

<div class="grid">

    <div class="logo">
        <h1>LOGO</h2>
    </div>

  

<?php 
session_start();
$url='http://localhost:8080/squad-6/storage/app/public/';
?>

    <div class="menu">

        @if ($_SESSION['santos'])

        <div class="titleWrapper">
            <h3>Você esta conéctado a unidade de santos</h3>
        </div>

        @foreach ($dadosSantos as $dado) 

        <div class="option" class="col-sm">

            <div class="nomeSala">
                <p>Nome da sala: <b>{{$dado->nm_sala}}</b></p> 
            </div>

            <div class="fotoSala">
                <img src={{$url.$dado->img_sala}} alt="Não foi possível encontrar imagem">
            </div>

            <div class="buttons">
                <div class="buttonEnter">
                    <a href="salas/sala/<?php echo $dado->nm_sala."/".$dado->cd_sala_santos?>">Entrar na Sala</a> 
                </div>
            
                <div class="buttonDelRoom">
                    <a href="salas/sala/<?php echo $dado->nm_sala."/excluir/".$dado->cd_sala_santos?>">Excluir Sala</a>
                </div>
            </div>
        </div>
        @endforeach

        @else 
        <h3>Você esta conéctado a unidade de São Paulo</h3>
        @foreach ($dadosSaoPaulo as $dado) 
        <p>Nome da sala: <b>{{$dado->nm_sala}}</b></p> 
        <img src={{$url.$dado->img_sala}} alt="Não foi possível encontrar imagem">
        <br><br>
        <a href="salas/sala/<?php echo $dado->nm_sala."/".$dado->cd_sala_sao_paulo?>">Entrar na Sala</a> 
        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
        <a href="salas/sala/<?php echo $dado->nm_sala."/excluir/".$dado->cd_sala_sao_paulo?>">Excluir Sala</a>
        @endforeach

        @endif

        <div class="button">
            <a href="criarsala">Criar Sala</a> 
        </div>

        <div class="buttonVoltar">
            <a href="unidade">Voltar a escolha da unidade</a>
        </div>
    </div>

</div>
