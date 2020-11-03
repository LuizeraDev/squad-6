<!DOCTYPE html>
<?php
    require("../funcionalidades/conecta-banco.php");

    session_start();

    if (isset($_SESSION["santos"]))
        $cidade = "santos.php";
    else
        $cidade = "saopaulo.php";

    // puxando parâmetro com o código da sala
    $codigo_sala = $_GET['id'];
?>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Fifo - Squad 6</title>
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
            <form <?php echo "action='../funcionalidades/inserir-nome.php?id=$codigo_sala'" ?> method="POST">
                <input type="text" placeholder="Digite seu nome" name="nome">
                <br>
                <br>
                <input type="submit" value="Entrar">
                <br><br>
                <a href="<?php echo $cidade?>">Voltar para o menu principal</a>
            </form>
        </section>
    </main>
</body>
</html>