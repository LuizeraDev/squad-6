<?php
// Faz a importação do banco de dados ser necessária para execução do arquivo
require("conecta-banco.php");

// Recebe os valores do formulário da página index.php
$nome = $_POST['nome'];
$cidade = $_POST['cidade'];

if($cidade === "Santos"):
    // Fazendo inserção no banco de dados
    $comandoSQL = "INSERT INTO tb_usuario (nm_usuario, Santos) VALUES ('$nome', '1')";
    $res = $con->query($comandoSQL);
    // Fechando a conexão com o banco de dados
    $con->close();

    // Esta função redireciona o usuário para outra página
    header("Location: ../salas/santos.php");
else:
    // Fazendo inserção no banco de dados
    $comandoSQL = "INSERT INTO tb_usuario (nm_usuario, Sao_Paulo) VALUES ('$nome', '1')";
    $res = $con->query($comandoSQL);
    // Fechando a conexão com o banco de dados
    $con->close();

    // Esta função redireciona o usuário para outra página
    header("Location: ../salas/saopaulo.php");
endif;