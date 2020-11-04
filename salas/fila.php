<?php
require("../funcionalidades/conecta-banco.php");
session_start();

$codigo_sala = $_GET['id'];
$codigo_usuario = $_SESSION['codigo_usuario'];

// Se a session santos for true / verdadeira.
if ($_SESSION["santos"]) {
    require("../funcionalidades/fila-santos.php");
} else {
    require("../funcionalidades/fila-sao-paulo.php");
}
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
            <p>E aew <b><?php echo $nome; ?></b></p>
            <p>Você está na fila de <b><?php echo $sala; ?></b> e sua posição é <b><?php echo $posicao ?></b></p>
            <hr style="width: 30%;">
            <br>
            <?php
               for ($i = 0; $i < $qt_usuarios; $i++) {
                 if ($i < 5) {
                    // Limitando a quantidade de pessoas que vão aparecer para 5
                    echo "<b>Posição na fila: ".$usuarios[$i]['cd_fila_usuario']." | Nome: ".$usuarios[$i]['nm_usuario']."</b>";
                    echo "<br><br>";
                } else 
                    break;
                } 
            ?>
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
