
<h2>Logotipo - Fifo</h2>
<a href="criarsala">Criar Sala</a> 

<?php 
session_start();
$url='http://localhost:8080/squad-6/storage/app/public/';
?>

@if ($_SESSION['santos'])
<h3>Você esta conéctado a unidade de santos</h3>
@foreach ($dadosSantos as $dado) 
<p>Nome da sala: <b>{{$dado->nm_sala}}</b></p> 
<img src={{$url.$dado->img_sala}} alt="Não foi possível encontrar imagem">
<br><br>
<a href="salas/sala/<?php echo $dado->nm_sala."/".$dado->cd_sala_santos?>">Entrar na Sala</a> 
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
<a href="salas/sala/<?php echo $dado->nm_sala."/excluir/".$dado->cd_sala_santos?>">Excluir Sala</a>
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

<br><br>
<a href="unidade">Voltar a escolha da unidade</a>
