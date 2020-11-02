<?php
require("../funcionalidades/conecta-banco.php");
session_start();

$senha_sala = $_POST['senha-sala'];
$codigo_sala = $_GET['id'];

if(isset($_SESSION["santos"])){
    // Busca a senha da sala no banco de dados
    $comandoSQL = "SELECT cd_senha_sala from tb_sala_santos WHERE cd_sala_santos='$codigo_sala'";
    $resultado_sala = mysqli_query($con, $comandoSQL) or die("Erro no banco de dados!");
    $senha = mysqli_fetch_array($resultado_sala);

    if($senha_sala === $senha[0]):
        // Pega o nome da imagem no banco de dados
        $comandoSQL = "SELECT img_sala from tb_sala_santos WHERE cd_sala_santos='$codigo_sala'";
        $resultado_sala = mysqli_query($con, $comandoSQL) or die("Erro no banco de dados!");
        $nome_img = mysqli_fetch_array($resultado_sala);

        // Deleta os usuários que possuem a chave estrangeira da sala
        $comandoSQL = "DELETE FROM tb_usuario WHERE cd_sala_santos='$codigo_sala'";
        $con->query($comandoSQL) or die("algo deu errado");

        // Deleta a sala criada no banco de dados
        $comandoSQL = "DELETE FROM tb_sala_santos WHERE cd_sala_santos='$codigo_sala'";
        $con->query($comandoSQL) or die("algo deu errado");

        // Nessas 2 linhas deletamos a imagem  da sala
        $caminho = "img-salas-santos/$codigo_sala";
        unlink($caminho."/".$nome_img[0]);
        rmdir($caminho);
        header("Location: ../salas/santos.php");
    endif;
    $con->close();
}
else{
    // Busca a senha da sala no banco de dados
    $comandoSQL = "SELECT cd_senha_sala from tb_sala_sao_paulo WHERE cd_sala_sao_paulo='$codigo_sala'";
    $resultado_usuario = mysqli_query($con, $comandoSQL) or die("Erro no banco de dados!");
    $senha = mysqli_fetch_array($resultado_usuario);

    if($senha_sala === $senha[0]):
        // Pega o nome da imagem no banco de dados
        $comandoSQL = "SELECT img_sala from tb_sala_sao_paulo WHERE cd_sala_sao_paulo='$codigo_sala'";
        $resultado_sala = mysqli_query($con, $comandoSQL) or die("Erro no banco de dados!");
        $nome_img = mysqli_fetch_array($resultado_sala);

        // Deleta os usuários que possuem a chave estrangeira da sala
        $comandoSQL = "DELETE FROM tb_usuario WHERE cd_sala_sao_paulo='$codigo_sala'";
        $con->query($comandoSQL) or die("algo deu errado");

        // Deleta a sala criada no banco de dados
        $comandoSQL = "DELETE FROM tb_sala_sao_paulo WHERE cd_sala_sao_paulo='$codigo_sala'";
        $con->query($comandoSQL) or die("algo deu errado");

        // Nessas 2 linhas deletamos a imagem  da sala
        $caminho = "img-salas-sao-paulo/$codigo_sala";
        unlink($caminho."/".$nome_img[0]);
        rmdir($caminho);
        header("Location: ../salas/saopaulo.php");
    endif;
    $con->close();
}