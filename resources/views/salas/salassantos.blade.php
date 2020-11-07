

<h2>Logotipo - Fifo</h2>
<a href="criarsala">Criar Sala</a> 

<?php $url='http://localhost:8080/squad-6/storage/app/public/'?>


@foreach ($dados as $dado) 
<p>Nome da sala: <b>{{$dado->nm_sala}}</b></p> 
<img src={{$url.$dado->img_sala}} alt="Não foi possível encontrar imagem">
<br><br>
<a href="salassantos/sala/<?php echo $dado->nm_sala."/".$dado->cd_sala_santos?>">Entrar na Sala</a> 
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
<a href="salassantos/sala/<?php echo $dado->nm_sala."/excluir/".$dado->cd_sala_santos?>">Excluir Sala</a>
@endforeach
