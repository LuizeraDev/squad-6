<?php
// Inicia sessão para pegar as sessions santos ou são paulo
session_start();

// Faz a importação do banco de dados ser necessária para execução do arquivo
require("conecta-banco.php");

// Recebe os valores do formulário da página index.php
$nome = $_POST['nome'];

// Codigo da sala que vem passado pela página nome.php
$codigo_sala = $_GET['id'];

if(isset($_SESSION["santos"])):
    // Fazendo inserção no banco de dados
    $comandoSQL = "INSERT INTO tb_usuario (nm_usuario, cd_sala_santos) VALUES ('$nome', $codigo_sala)";
    $res = $con->query($comandoSQL);
    // Fechando a conexão com o banco de dados
    $con->close();

    // Esta função redireciona o usuário para outra página
    header("Location: ../salas/fila.php?id=".$codigo_sala);
else:
    // Fazendo inserção no banco de dados
    $comandoSQL = "INSERT INTO tb_usuario (nm_usuario, cd_sala_sao_paulo) VALUES ('$nome', $codigo_sala)";
    $res = $con->query($comandoSQL);
    // Fechando a conexão com o banco de dados
    $con->close();

    die();
    // Esta função redireciona o usuário para outra página
    header("Location: ../salas/fila.php?id=".$codigo_sala);
endif;