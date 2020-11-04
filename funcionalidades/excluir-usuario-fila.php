<?php
require("../funcionalidades/conecta-banco.php");
session_start();

$codigo_sala = $_GET['id'];
$codigo_usuario = $_SESSION['codigo_usuario'];

if ($_SESSION["santos"]) {
    // seleciona o código do usuário de acordo com o nome do usuário
    $comandoSQL = "SELECT cd_sala_santos, cd_fila_usuario from tb_usuario WHERE cd_usuario='$codigo_usuario' AND cd_sala_santos='$codigo_sala'";
    $resultado_usuario = mysqli_query($con, $comandoSQL);
    $dados = mysqli_fetch_array($resultado_usuario);

    // Armazena o cd_fila_usuario
    $codigo_fila_usuario = $dados[1];

    // Seleciona todos os usuários da mesma sala
    $comandoSQL = "SELECT * FROM tb_usuario WHERE cd_sala_santos = '$codigo_sala'";
    $result_users = mysqli_query($con, $comandoSQL);
    $qt_pessoas_fila = mysqli_num_rows($result_users);

    if ($codigo_sala === $dados[0]) {
        
        // Reajusta as posições da fila.
        for ($i = $codigo_fila_usuario; $i <= $qt_pessoas_fila; $i++) { 
            $aux = $i + 1;
            $comandoSQL = "UPDATE tb_usuario SET cd_fila_usuario = $i WHERE cd_fila_usuario = $aux AND cd_sala_santos = $codigo_sala";
            $con->query($comandoSQL);
        }

        // Deleta o usuário que desistir da fila da tabela de usuários
        $comandoSQL = "UPDATE tb_usuario SET cd_fila_usuario = NULL, cd_sala_santos = NULL WHERE cd_usuario = '$codigo_usuario'";
        $con->query($comandoSQL);
        $con->close();        
    }

    header("Location: ../salas/santos.php");
} else {
    // seleciona o código do usuário de acordo com o nome do usuário
    $comandoSQL = "SELECT cd_sala_sao_paulo, cd_fila_usuario from tb_usuario WHERE cd_usuario='$codigo_usuario' AND cd_sala_sao_paulo='$codigo_sala'";
    $resultado_usuario = mysqli_query($con, $comandoSQL);
    $dados = mysqli_fetch_array($resultado_usuario);

    // Armazena o cd_fila_usuario
    $codigo_fila_usuario = $dados[1];

    // Seleciona todos os usuários da mesma sala
    $comandoSQL = "SELECT * FROM tb_usuario WHERE cd_sala_sao_paulo = '$codigo_sala'";
    $result_users = mysqli_query($con, $comandoSQL);
    $qt_pessoas_fila = mysqli_num_rows($result_users);

    if ($codigo_sala === $dados[0]) {
        
        // Reajusta as posições da fila.
        for ($i = $codigo_fila_usuario; $i <= $qt_pessoas_fila; $i++) { 
            $aux = $i + 1;
            $comandoSQL = "UPDATE tb_usuario SET cd_fila_usuario = $i WHERE cd_fila_usuario = $aux AND cd_sala_sao_paulo = $codigo_sala";
            $con->query($comandoSQL);
        }

        // Deleta o usuário que desistir da fila da tabela de usuários
        $comandoSQL = "UPDATE tb_usuario SET cd_fila_usuario = NULL, cd_sala_sao_paulo = NULL WHERE cd_usuario = '$codigo_usuario'";
        $con->query($comandoSQL);
        $con->close();        
    }

    header("Location: ../salas/saopaulo.php");
}