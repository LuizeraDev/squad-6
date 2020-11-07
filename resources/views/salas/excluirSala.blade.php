<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Confirmar Exclusão - Santos</title>
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
            <p>Digite <span id="aleatorio"></span> para excluir a sala <b>{{$nomeSala}}</b></p>
            <input type="text" id="numero_aleatorio" maxlength="3"><br><br>
            <input type="button" onclick="excluir()" value="Apagar Sala">
            <p id="resposta"></p>

        </section>
    </main>
    <script>
        var aleatorio = Math.floor(Math.random() * (999 - 100) + 100);
        var exibir = document.all["aleatorio"];
        exibir.innerHTML = aleatorio;
        
        function excluir() {
            var valor_digitado = document.all("numero_aleatorio").value;
            var resposta = document.all["resposta"];

            if (valor_digitado == aleatorio) {
                window.location.href = "/salassantos/sala/<?php echo $nomeSala ?>/excluir/<?php echo $salaId ?>/do";
            } else {
                resposta.innerHTML = "O valor informado não confere";
            }
        }   
    </script>
</body>

</html>