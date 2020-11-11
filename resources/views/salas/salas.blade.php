<?php 
session_start();
$url='http://localhost:8080/squad-6/storage/app/public/';
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    @if ($_SESSION['santos'])
        <title>Fifo - Salas Santos</title>
    @else 
        <title>Fifo - Salas São Paulo</title>
    @endif
</head>
<body>
<h2>Logotipo - Fifo</h2>

<a href="criarsala">Criar Sala</a> 

@if ($_SESSION['santos'])
    <h3>Você esta conéctado a unidade de Santos</h3>
@else 
    <h3>Você esta conéctado a unidade de São Paulo</h3>
@endif

<div id="conteudo"></div>

<br><br>
<a href="unidade">Voltar a escolha da unidade</a>

<script src="https://code.jquery.com/jquery-2.1.3.min.js"></script>

<script>
// Função responsável por atualizar as salas
function atualizarSalas()
{
    var conteudo_salas = document.all['conteudo'];
    conteudo_salas.innerHTML="";
    $.get("{{ route('salasConteudo') }}", function (dadosSalas) {
        for (i = 0; i < dadosSalas.length; i++)
        {
            conteudo_salas.innerHTML += 
            "<p> Nome da sala: <b>" + dadosSalas[i].nm_sala + "</b></p>" +
            "<img src='{{ $url }}" + dadosSalas[i].img_sala + "'" +"<br><br><br>" +
            "<a href='salas/sala/" + dadosSalas[i].nm_sala +"/" +  dadosSalas[i]. 
            <?php if ($_SESSION["santos"]) { echo  "cd_sala_santos"; } else { echo "cd_sala_sao_paulo"; }  ?> 
            + "'>Entrar na Sala</a>"+
            "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;"+
            "<a href='salas/sala/"+ dadosSalas[i].nm_sala +"/excluir/" +  dadosSalas[i].cd_sala_santos +"'>Excluir Sala</a>";
        }
    }), 'JSON';
}
// Definindo intervalo que a função será chamada no caso 10 em 10 segundos
setInterval("atualizarSalas()", 10000);
// Quando carregar a página
$(function() {
    // Faz a primeira atualização
    atualizarSalas();
});
</script>

</body>
</html>

