<?php 
require("../funcionalidades/conecta-banco.php");
session_start();

$_SESSION["saopaulo"] = false;
$_SESSION["santos"] = true;

// Seleciona código da sala criada
$comandoSQL = "SELECT * FROM tb_sala_santos WHERE cd_sala_santos IS NOT NULL";
$resultado_sala = mysqli_query($con, $comandoSQL) or die("Erro no banco de dados!");
$dados = mysqli_fetch_all($resultado_sala, MYSQLI_ASSOC);
// Pega o número de linhas no banco de dados que condizem com a condição do select
$quantidade = mysqli_num_rows($resultado_sala);
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Fifo - Santos</title>
</head>
<body>
    <h1>LOGOTIPO - FIFO</h1>
    <h4>Criar nova sala? <a href="criar-sala-santos.php">Clique aqui</a></h4>
    <h3>Selecione sua sala</h3>
    <?php 
        if ($quantidade != null) {
            for ($i = 0; $i < $quantidade; $i++) {
                echo "<p>Nome da sala: ". $dados[$i]['nm_sala'] ."</p>";
                echo "<p>Imagem da sala: </p>";
                echo "<img src='../funcionalidades/img-salas-santos/".$dados[$i]['nm_sala']."/".$dados[$i]['img_sala']."'>";
                echo "<br><a href='fila.php?id=". $dados[$i]['cd_sala_santos'] ."'>Selecionar sala</a><br>";
                echo "<br><a href='confirma-exclusao.php?id=". $dados[$i]['cd_sala_santos'] ."'>Excluir sala</a><br><br>";
            }
        }   
    ?>
    <a href="unidade.php">Voltar a escolha de unidade</a> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
    <a href="../index.php">Voltar ao login</a>
</body>
</html>