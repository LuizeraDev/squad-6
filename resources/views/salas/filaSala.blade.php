<?php 
$url='http://localhost:8080/squad-6/storage/app/public/';
?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Fifo - Fila</title>
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
            <h2>Logotipo - Fifo</h2>

            <div id="conteudo1"></div>

            <hr style="width: 30%;">
            <br>

            <div id="conteudo2"></div>

            <br><br>
            <div id="conteudo3"></div>
            <a href="{{$salaId}}/desistente">Desistir</a>

        </section>
    </main>

    <!-- Este script é necessário para fazer a conexão assíncrona com o AJAX -->
    <script src="https://code.jquery.com/jquery-2.1.3.min.js"></script>

    <script>
        // Função responsável por atualizar as salas
        function atualizarSalas() {

            var conteudo_usuario = document.all['conteudo1'];
            var conteudo_fila = document.all['conteudo2'];
            var conteudo_vou_jogar = document.all['conteudo3'];
            conteudo_vou_jogar.innerHTML = "";
            conteudo_fila.innerHTML = "";
            conteudo_usuario.innerHTML = "";

            $.get("{{ route('filaConteudo') }}", function (dadosFila) {

                // Usuário que entrou na fila
                for (i = 0; i < dadosFila.dadosUsuario.length; i++) {
                    conteudo_usuario.innerHTML +=
                    "E aew <b>" + dadosFila.dadosUsuario[i].name+"</b><br><br>" +
                    "Você está na fila da sala <b>" + dadosFila.dadosUsuario[i].nm_sala +"</b> " +
                    "e sua posição é <b>" + dadosFila.dadosUsuario[i].cd_fila_usuario;
                }

                if (dadosFila.dadosUsuario[0].cd_fila_usuario == 1) {
                    conteudo_vou_jogar.innerHTML = "<a href='{{$salaId}}/voujogar'>Vou Jogar</a><br><br>";
                }
                
                // Todos os usuários
                for (i = 0; i < dadosFila.dadosFila.length; i++) {
                    
                    // Verifica se o usuário tem um caminho de imagem
                    if (dadosFila.dadosFila[i].profile_photo_path) {
                        conteudo_fila.innerHTML += "<img src='{{ $url }}" + dadosFila.dadosFila[i].profile_photo_path+"' width='40'> ";
                    }
                    conteudo_fila.innerHTML += "Nome: <b>" + dadosFila.dadosFila[i].name+"</b> " +
                    "Posição na fila: <b>" + dadosFila.dadosFila[i].cd_fila_usuario +"</b> "+ 
                    "Status usuário: <b>" + dadosFila.dadosFila[i].status + "</b><br><br>";
                }

            }), 'JSON';
        }

        // Definindo intervalo que a função será chamada no caso 10 em 10 segundos
        setInterval("atualizarSalas()", 10000);

        // Quando carregar a página
        $(function () {
            // Faz a primeira atualização
            atualizarSalas();
        });
    </script>

</body>

</html>