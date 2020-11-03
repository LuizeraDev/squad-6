<?php 
require("../funcionalidades/conecta-banco.php");

error_reporting(0);

if (isset($_SESSION["santos"])) {
    // Seleciona todos os usuários que tem o mesmo código de sala
    $comandoSQL = "SELECT * FROM tb_usuario WHERE cd_sala_santos = '$codigo_sala'";
    $result_users = mysqli_query($con, $comandoSQL);
    $usuarios = mysqli_fetch_all($result_users, MYSQLI_ASSOC);
    $qt_linhas = mysqli_num_rows($result_users);
} else {
    // Seleciona todos os usuários que tem o mesmo código de sala
    $comandoSQL = "SELECT * FROM tb_usuario WHERE cd_sala_sao_paulo = '$codigo_sala'";
    $result_users = mysqli_query($con, $comandoSQL);
    $usuarios = mysqli_fetch_all($result_users, MYSQLI_ASSOC);
    $qt_linhas = mysqli_num_rows($result_users);
}

for ($i = 0; $i < $qt_linhas; $i++) {
    echo "<b>Posição na fila: ".$usuarios[$i]['cd_fila_usuario']." | Nome: ".$usuarios[$i]['nm_usuario']."</b>";
    echo "<br><br>";
} 