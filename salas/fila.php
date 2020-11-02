<?php
    require("../funcionalidades/conecta-banco.php");
    session_start();
    // puxando nome do usuário por uma session e atribuindo a uma variável
    $nome_usuario = $_SESSION['nome_usuario'];
    // puxando parâmetro do código da sala 
    $codigo_sala = $_GET['id'];

    if(isset($_SESSION["santos"])):
        // buscando o nome da sala criada no banco
        $comandoSQL = "SELECT nm_sala from tb_sala_santos WHERE cd_sala_santos='$codigo_sala'";
        $resultado_sala = mysqli_query($con, $comandoSQL) or die("Erro no banco de dados!");
        $nome_sala = mysqli_fetch_array($resultado_sala);
    else:
        // buscando o nome da sala criada no banco
        $comandoSQL = "SELECT nm_sala from tb_sala_sao_paulo WHERE cd_sala_sao_paulo='$codigo_sala'";
        $resultado_sala = mysqli_query($con, $comandoSQL) or die("Erro no banco de dados!");
        $nome_sala = mysqli_fetch_array($resultado_sala);
    endif;
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
            <p>E aew <?php echo $nome_usuario; ?></p>
            <p>Você está na fila do <?php echo $nm_sala; ?> e sua posição é a (posição do usuário)</p>
            <hr style="width: 40%;">
            <h3>Aqui vai aparecer os usuários que estão atrás e na frente da fila</h3>
            <a href="#">Vou Jogar</a>
            <br><br>
            <a href="../funcionalidades/excluir-usuario-fila.php?id=<?php echo $codigo_sala ?>">Desistir</a>
        </section>
    </main>
</body>
</html>