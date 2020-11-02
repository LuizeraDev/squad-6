<?php
    include("funcionalidades/conecta-banco.php");
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
            <form action="funcionalidades/inserir.php" method="POST">
                <input type="text" placeholder="Digite seu nome" name="nome">
            </form>
        </section>
    </main>
</body>
</html>