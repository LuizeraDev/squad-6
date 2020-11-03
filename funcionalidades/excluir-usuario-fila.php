<?php
require("../funcionalidades/conecta-banco.php");
session_start();

$codigo_sala = $_GET['id'];
$nome_usuario = $_SESSION['nome_usuario'];

if (isset($_SESSION["santos"])) {
    // seleciona o código do usuário de acordo com o nome do usuário
    $comandoSQL = "SELECT cd_usuario, cd_sala_santos from tb_usuario WHERE nm_usuario='$nome_usuario' AND cd_sala_santos='$codigo_sala'";
    $resultado_usuario = mysqli_query($con, $comandoSQL) or die("Erro no banco de dados!");
    $dados = mysqli_fetch_array($resultado_usuario);
    
    $codigo_usuario = $dados[0];

    if($codigo_sala === $dados[1]){
        // Deleta o usuário que desistir da fila da tabela de usuários
        $comandoSQL = "DELETE FROM tb_usuario WHERE cd_usuario='$codigo_usuario'";
        $con->query($comandoSQL) or die("algo deu errado");
        $con->close();
    }

    header("Location: ../salas/santos.php");
} else {
    // seleciona o código do usuário de acordo com o nome do usuário
    $comandoSQL = "SELECT cd_usuario, cd_sala_sao_paulo from tb_usuario WHERE nm_usuario='$nome_usuario' AND cd_sala_sao_paulo='$codigo_sala'";
    $resultado_usuario = mysqli_query($con, $comandoSQL) or die("Erro no banco de dados!");
    $dados = mysqli_fetch_array($resultado_usuario);
        
    $codigo_usuario = $dados[0];

    if($codigo_sala === $dados[1]){
         // Deleta o usuário que desistir da fila da tabela de usuários
        $comandoSQL = "DELETE FROM tb_usuario WHERE cd_usuario='$codigo_usuario'";
        $con->query($comandoSQL) or die("algo deu errado");
        $con->close();
    }

    header("Location: ../salas/saopaulo.php");
}


