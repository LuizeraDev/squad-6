<?php
    session_start();
    session_destroy();
?>
<!DOCTYPE html>
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
            <h2>Logotipo - Fifo</h2>
            <p>Escolha a unidade em que você está</p>
            <a href="santos.php">Santos</a> 
            <br><br><br>
            <a href="saopaulo.php">São Paulo</a>
            <br><br><br>
            <a href="../paginas/login.php">Sair</a>
        </section>
    </main>
</body>
</html>