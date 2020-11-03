<?php 
require("../funcionalidades/conecta-banco.php");

error_reporting(0);

if (isset($_SESSION["santos"])) {
    // Seleciona todos os usuários que tem o mesmo código de sala
    $comandoSQL = "SELECT * FROM tb_usuario WHERE cd_sala_santos = '$codigo_sala' ORDER BY cd_fila_usuario";
    $result_users = mysqli_query($con, $comandoSQL);
    $usuarios = mysqli_fetch_all($result_users, MYSQLI_ASSOC);
    $qt_linhas = mysqli_num_rows($result_users);
} else {
    // Seleciona todos os usuários que tem o mesmo código de sala
    $comandoSQL = "SELECT * FROM tb_usuario WHERE cd_sala_sao_paulo = '$codigo_sala' ORDER BY cd_fila_usuario";
    $result_users = mysqli_query($con, $comandoSQL);
    $usuarios = mysqli_fetch_all($result_users, MYSQLI_ASSOC);
    $qt_linhas = mysqli_num_rows($result_users);
}


for ($i = 0; $i < $qt_linhas; $i++) {
    if($i < 5){
        // Limitando a quantidade de pessoas que vão aparecer para 5
        echo "<b>Posição na fila: ".$usuarios[$i]['cd_fila_usuario']." | Nome: ".$usuarios[$i]['nm_usuario']."</b>";
        echo "<br><br>";
    } else 
        break;
} 