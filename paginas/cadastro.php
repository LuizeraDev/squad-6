<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Fifo - Squad 6</title>
</head>
<style>
    .container {
        margin-top: 15%;
    }
</style>

<body>
    <main>
        <!-- No php, pegamos dados através do campo "name" dos inputs -->
        <section class="container" align="center">
            <form action="../funcionalidades/fazer-cadastro.php" method="POST">
                <p>
                    <h3>Cadastro</h3>
                    Usuário 
                    <input type="text" placeholder="Usuário" name="usuario"><br><br>
                    Senha
                    <input type="text" placeholder="Senha" name="senha"><br>
                    <br>
                    <br>
                    <input type="submit" value="Entrar">
                </p>
                <a href="login.php">Possuo uma conta</a>
            </form>
        </section>
    </main>
</body>

</html>