<?php
require("../funcionalidades/conecta-banco.php");
session_start();
// puxando nome do usuário por uma session e atribuindo a uma variável
$nome_usuario = $_SESSION['nome_usuario'];
// puxando parâmetro do código da sala 
$codigo_sala = $_GET['id'];
$_SESSION['codigo-sala'] = $codigo_sala;

if (isset($_SESSION["santos"])) {
    // buscando o nome da sala criada no banco
    $comandoSQL = "SELECT nm_sala from tb_sala_santos WHERE cd_sala_santos='$codigo_sala'";
    $resultado_sala = mysqli_query($con, $comandoSQL) or die("Erro no banco de dados!");
    $nome_sala = mysqli_fetch_array($resultado_sala);

    // Seleciona todos os usuários que tem o mesmo código de sala
    $comandoSQL = "SELECT * FROM tb_usuario WHERE cd_sala_santos = '$codigo_sala' ";
    $result_users = mysqli_query($con, $comandoSQL) or die("Erro no banco de dados!");
    $usuarios = mysqli_fetch_all($result_users, MYSQLI_ASSOC);
    $qt_linhas = mysqli_num_rows($result_users);
    
    if ($qt_linhas != null) {
        // Faz atualização do campo cd_fila_usuario, para dizer sua posição na fila
        $comandoSQL = "UPDATE tb_usuario SET cd_fila_usuario = '$qt_linhas + 1' WHERE nm_usuario = '$nome_usuario'";
        $att = mysqli_query($con, $comandoSQL) or die("Erro no banco de dados!");
    } else {
        // Coloca usuário como primeiro da fila
        $comandoSQL = "UPDATE tb_usuario SET cd_fila_usuario = 1 WHERE nm_usuario = '$nome_usuario'";
        $att = mysqli_query($con, $comandoSQL) or die("Erro no banco de dados!");
    }

    // Capturar a posição da fila do usuário
    $comandoSQL = "SELECT cd_fila_usuario from tb_usuario WHERE nm_usuario = '$nome_usuario'";
    $resultado_posicao = mysqli_query($con, $comandoSQL) or die("Erro no banco de dados!");
    $posicao = mysqli_fetch_array($resultado_posicao); 

    $posicao_fila = $posicao[0];
} else {
    // buscando o nome da sala criada no banco
    $comandoSQL = "SELECT nm_sala from tb_sala_sao_paulo WHERE cd_sala_sao_paulo='$codigo_sala'";
    $resultado_sala = mysqli_query($con, $comandoSQL) or die("Erro no banco de dados!");
    $nome_sala = mysqli_fetch_array($resultado_sala);

    // Seleciona todos os usuários que tem o mesmo código de sala
    $comandoSQL = "SELECT * FROM tb_usuario WHERE cd_sala_sao_paulo = '$codigo_sala' ";
    $result_users = mysqli_query($con, $comandoSQL) or die("Erro no banco de dados!");
    $usuarios = mysqli_fetch_all($result_users, MYSQLI_ASSOC);
    $qt_linhas = mysqli_num_rows($result_users);
    
    if ($qt_linhas != null) {
        // Faz atualização do campo cd_fila_usuario, para dizer sua posição na fila
        $comandoSQL = "UPDATE tb_usuario SET cd_fila_usuario = '$qt_linhas + 1' WHERE nm_usuario = '$nome_usuario'";
        $att = mysqli_query($con, $comandoSQL) or die("Erro no banco de dados!");
    } else {
        // Coloca usuário como primeiro da fila
        $comandoSQL = "UPDATE tb_usuario SET cd_fila_usuario = 1 WHERE nm_usuario = '$nome_usuario'";
        $att = mysqli_query($con, $comandoSQL) or die("Erro no banco de dados!");
    }

    // Capturar a posição da fila do usuário
    $comandoSQL = "SELECT cd_fila_usuario from tb_usuario WHERE nm_usuario = '$nome_usuario'";
    $resultado_posicao = mysqli_query($con, $comandoSQL) or die("Erro no banco de dados!");
    $posicao = mysqli_fetch_array($resultado_posicao); 

    $posicao_fila = $posicao[0];
}
$con->close();

// atribuindo o nome da sala a uma variável
$nm_sala = $nome_sala['nm_sala'];
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Fila</title>
</head>
<style>
    .container{
        margin-top: 15%;
    }
</style>
<body>
    <main>
        <!-- No php, pegamos dados através do campo "name" dos inputs -->
        <section class="container" align="center">
            <h2>Logotipo - Fifo</h2>
            <form method="post" action="../funcionalidades/excluir-sala.php?id=<?php echo $codigo_sala ?>">
                <p>Excluir sala:</p>
                <input type="password" placeholder="senha da sala" name="senha-sala" maxlength="5" required>
                <input type="submit" value="excluir sala">
            </form>
            <p>E aew <b><?php echo $nome_usuario; ?></b></p>
            <p>Você está na fila do <b><?php echo $nm_sala; ?></b> e sua posição é <b><?php echo $posicao_fila ?></b></p>
            <hr style="width: 30%;">
            <br>
            <?php
                include("../funcionalidades/fila-assincrona.php");
            ?>
            <div class="usuarios"></div>
            <br><br>
            <a href="#">Vou Jogar</a>
            <br><br>
            <a href="../funcionalidades/excluir-usuario-fila.php?id=<?php echo $codigo_sala ?>">Desistir</a>
        </section>
    </main>

    <script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
    <script src="../scripts/assincrono.js"></script>
</body>
</html>
