<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Criar Sala - São Paulo</title>
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
            <form enctype="multipart/form-data" action="../funcionalidades/inserir-sala-sp.php" method="POST">
            <h3>Criar Sala de São Paulo</h3>
            <p>
            Nome da sala
            <input type="text" name="nome-sala" required><br><br>
            Escolha uma foto para a sala<br>
            <input type="file" name="arquivo" placeholder="Foto de Perfil">
            <br><br>
            <input type="submit" value="Criar Sala">
            </p>
            <a href="saopaulo.php">Voltar as salas já criadas</a>
            </form>
        </section>
    </main>
</body>
</html>