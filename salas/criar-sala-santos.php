<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Criar Sala - Santos</title>
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
            <h3>Exemplo básico de aplicação</h3>
            <input type="text" name="nome">
            <p>
            Santos
            <input type="radio" name="cidade" value="Santos">
            São Paulo
            <input type="radio" name="cidade" value="SaoPaulo">
            <br><br>
            <input type="submit" value="Entrar">
            </p>
            </form>
        </section>
    </main>
</body>
</html>