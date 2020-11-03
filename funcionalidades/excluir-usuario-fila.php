<?php
require("../funcionalidades/conecta-banco.php");
session_start();

$codigo_sala = $_GET['id'];
$nome_usuario = $_SESSION['nome_usuario'];

if (isset($_SESSION["santos"])) {
    // seleciona o código do usuário de acordo com o nome do usuário
    $comandoSQL = "SELECT cd_usuario, cd_sala_santos, cd_fila_usuario from tb_usuario WHERE nm_usuario='$nome_usuario' AND cd_sala_santos='$codigo_sala'";
    $resultado_usuario = mysqli_query($con, $comandoSQL) or die("Erro no banco de dados!");
    $dados = mysqli_fetch_array($resultado_usuario);
    // Armazena o cd_usuario
    $codigo_usuario = $dados[0];
    // Armazena o cd_fila_usuario
    $codigo_fila_usuario = $dados[2];

    // Seleciona todos os usuários na fila.
    $comandoSQL = "SELECT * FROM tb_usuario WHERE cd_sala_santos = '$codigo_sala' ";
    $result_users = mysqli_query($con, $comandoSQL) or die("Erro no banco de dados!");
    $usuarios = mysqli_fetch_all($result_users, MYSQLI_ASSOC);

    // Armazena a quantidade de pessoas na fila.
    $qt_pessoas_fila = mysqli_num_rows($result_users);

    if ($codigo_sala === $dados[1]) {
        
        // Reajusta as posições da fila.
         for ($i = $codigo_fila_usuario; $i <= $qt_pessoas_fila; $i++) { 
            $aux = $i + 1;
            $comandoSQL = "UPDATE tb_usuario SET cd_fila_usuario = $i WHERE cd_fila_usuario = $aux AND cd_sala_santos = $codigo_sala";
            $con->query($comandoSQL) or die("Erro no banco de dados!");
            }

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

    if ($codigo_sala === $dados[1]) {
         // Deleta o usuário que desistir da fila da tabela de usuários
        $comandoSQL = "DELETE FROM tb_usuario WHERE cd_usuario='$codigo_usuario'";
        $con->query($comandoSQL) or die("algo deu errado");
        $con->close();
    }

    header("Location: ../salas/saopaulo.php");
}


