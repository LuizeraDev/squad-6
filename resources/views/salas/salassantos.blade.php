

<h2>Logotipo - Fifo</h2>
<a href="criarsala">Criar Sala</a> 

<p>Aqui deverá aparecer as salas</p>

<?php $url='http://localhost:8080/squad-6/storage/app/public/'?>


<?php 
    $quantidade = count($caminho);
?>
@for($i = 0; $i < $quantidade; $i++)
<br><br>{{$nome[$i]}}
<img src="<?php echo $url.$caminho[$i]?>">
@endfor
