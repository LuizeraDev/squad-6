<?php
// Inicia sessão para pegar as sessions santos ou são paulo
session_start();

// Faz a importação do banco de dados ser necessária para execução do arquivo
require("conecta-banco.php");

// Recebe os valores do formulário da página index.php
$nome = $_POST['nome'];


if(isset($_SESSION["santos"])):
    // Fazendo inserção no banco de dados
    $comandoSQL = "INSERT INTO tb_usuario (nm_usuario) VALUES ('$nome')";
    $res = $con->query($comandoSQL);
    // Fechando a conexão com o banco de dados
    $con->close();

    // Esta função redireciona o usuário para outra página
    header("Location: ../salas/fila.php");
else:
    // Fazendo inserção no banco de dados
    $comandoSQL = "INSERT INTO tb_usuario (nm_usuario) VALUES ('$nome')";
    $res = $con->query($comandoSQL);
    // Fechando a conexão com o banco de dados
    $con->close();

    // Esta função redireciona o usuário para outra página
    header("Location: ../salas/fila.php");
endif;