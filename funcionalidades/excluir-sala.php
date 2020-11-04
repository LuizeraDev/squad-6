<?php
require("../funcionalidades/conecta-banco.php");
session_start();

$codigo_sala = $_GET['id'];


if (isset($_SESSION["santos"])) {
        // Pega o nome da imagem no banco de dados
        $comandoSQL = "SELECT nm_sala, img_sala from tb_sala_santos WHERE cd_sala_santos='$codigo_sala'";
        $resultado_sala = mysqli_query($con, $comandoSQL);
        $sala = mysqli_fetch_array($resultado_sala);

        // Deleta a sala criada no banco de dados
        $comandoSQL = "DELETE FROM tb_sala_santos WHERE cd_sala_santos='$codigo_sala'";
        $con->query($comandoSQL) or die("algo deu errado");
        $con->close();

        // Nessas 2 linhas deletamos a imagem  da sala
        $caminho = "img-salas-sao-paulo/$sala[0]";
        unlink($caminho."/".$sala[1]);
        rmdir($caminho);
        header("Location: ../salas/santos.php");
} else {
        // Pega o nome da imagem no banco de dados
        $comandoSQL = "SELECT  nm_sala, img_sala from tb_sala_sao_paulo WHERE cd_sala_sao_paulo='$codigo_sala'";
        $resultado_sala = mysqli_query($con, $comandoSQL);
        $sala = mysqli_fetch_array($resultado_sala);

        // Deleta a sala criada no banco de dados
        $comandoSQL = "DELETE FROM tb_sala_sao_paulo WHERE cd_sala_sao_paulo='$codigo_sala'";
        $con->query($comandoSQL) or die("algo deu errado");
        $con->close();

        // Nessas 2 linhas deletamos a imagem  da sala
        $caminho = "img-salas-sao-paulo/$sala[0]";
        unlink($caminho."/".$sala[1]);
        rmdir($caminho);
        header("Location: ../salas/saopaulo.php");
}