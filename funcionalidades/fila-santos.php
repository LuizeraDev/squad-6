<?php 
$comandoSQL = "UPDATE tb_usuario SET cd_sala_santos = $codigo_sala WHERE cd_usuario = '$codigo_usuario'";
$con->query($comandoSQL);

// Seleciona todos os usuários que tem o mesmo código de sala e os ordena de maneira crescente pelo cd_fila_usuario
$comandoSQL = "SELECT nm_usuario, cd_fila_usuario FROM tb_usuario WHERE cd_usuario='$codigo_usuario'";
$resultado_usuario = mysqli_query($con, $comandoSQL);
$usuario = mysqli_fetch_array($resultado_usuario);

// Seleciona todos os usuários que tem o mesmo código de sala e os ordena de maneira crescente pelo cd_fila_usuario
$comandoSQL = "SELECT * FROM tb_usuario WHERE cd_sala_santos='$codigo_sala' ORDER BY cd_fila_usuario";
$result_users = mysqli_query($con, $comandoSQL);
$usuarios = mysqli_fetch_all($result_users, MYSQLI_ASSOC);
$qt_usuarios = mysqli_num_rows($result_users);

if ($qt_usuarios != null) {
    // Faz atualização do campo cd_fila_usuario, para dizer sua posição na fila
    $comandoSQL = "UPDATE tb_usuario SET cd_fila_usuario = '$qt_usuarios + 1' WHERE cd_usuario = '$codigo_usuario'";
    $atualizando = mysqli_query($con, $comandoSQL);
} else {
    // Coloca usuário como primeiro da fila
    $comandoSQL = "UPDATE tb_usuario SET cd_fila_usuario = 1 WHERE cd_usuario = '$codigo_usuario'";
    $atualizando = mysqli_query($con, $comandoSQL);
}

// buscando o nome da sala no banco de dados
$comandoSQL = "SELECT nm_sala from tb_sala_santos WHERE cd_sala_santos='$codigo_sala'";
$resultado_sala = mysqli_query($con, $comandoSQL);
$nome_sala = mysqli_fetch_array($resultado_sala);

$nome = $usuario[0];
$posicao = $usuario[1];
$sala = $nome_sala[0];