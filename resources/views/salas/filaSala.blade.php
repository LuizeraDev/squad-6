<?php 
$url='http://localhost:8080/squad-6/storage/app/public/';
$_SESSION['cd_sala'] = $salaId;
$_SESSION['entrou_sala'] = true;
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
            <!-- <div id="conteudo4"></div> -->
            <a href="{{$salaId}}/desistente">Desistir</a>

        </section>
    </main>

    <!-- Este script é necessário para fazer a conexão assíncrona com o AJAX -->
    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>

    <script>
        // Função responsável por atualizar as filas
        function atualizarFila() {
            $.ajax({ 
                url: "{{ route('filaConteudo') }}",
                dataType: "json",
                cache: false,
            }).done(function (dadosFila) {
                // Descarta todas as informações anteriores para novas informações
                $('#conteudo1').html("");
                $('#conteudo2').html("");
                $('#conteudo3').html("");

                // Informações do usuário que entrou na sala
                for (i = 0; i < dadosFila.dadosUsuario.length; i++) 
                {
                    $('#conteudo1').append(
                        "E aew <b>" + dadosFila.dadosUsuario[i].name+"</b><br><br>" +
                        "Você está na fila da sala <b>" + dadosFila.dadosUsuario[i].nm_sala +"</b> " +
                        "e sua posição é <b>" + dadosFila.dadosUsuario[i].cd_fila_usuario
                        
                    );  
                    if (dadosFila.dadosUsuario[i].report) {
                        resposta = confirm("Você foi reportado, para continuar click em algum dos botões abaixo!! ");
                            if(resposta || !resposta)
                            {
                                window.location.href = "/estouaqui/"+ dadosFila.dadosUsuario[i].id ;
                            }
                        }                  
                }

                // Todos os usuários
                for (i = 0; i < dadosFila.dadosFila.length; i++) 
                {
                    // Verifica se o usuário tem um caminho de imagem, se ele tiver a imagem é exibida.
                    if (dadosFila.dadosFila[i].profile_photo_path) {
                        $('#conteudo2').append(
                            "<img src='{{ $url }}" + dadosFila.dadosFila[i].profile_photo_path+"' width='40'> &nbsp;"
                        );
                    }

                    // Exibe os usuários da fila da sala em questão
                    $('#conteudo2').append(
                        "Nome: <b>" + dadosFila.dadosFila[i].name+"</b> " +
                        "Posição na fila: <b>" + dadosFila.dadosFila[i].cd_fila_usuario +"</b> "+ 
                        "Status usuário: <b>" + dadosFila.dadosFila[i].status + "</b> "+
                        "<a href='#"+i+"' onclick=reportar(this.href)> Reportar</a><br><br>"
                    );
                }

                // Exibe o botão vou jogar se a posição da fila do usuário for igual a 1
                if (dadosFila.dadosUsuario[0].cd_fila_usuario == 1) {
                    $('#conteudo3').html("<a href='{{$salaId}}/voujogar'>Vou Jogar</a><br><br>");
                }


                setTimeout("atualizarFila()", 3000) // 3 segundos / Tempo de espera de atualização dos dados
            })
        }

        function reportar(pos){
            $.ajax({ 
                url: "{{ route('filaConteudo') }}", 
                dataType: "json",
                cache: false,
            }).done(function (dadosFila){
                // Pegar posição pelo href
                tamanho = pos.substring(pos.indexOf("#") + 1 );
                id = dadosFila.dadosFila[tamanho].id;
                url = this.locate
                alert("Você está reportando " + dadosFila.dadosFila[tamanho].name);
                window.location.href = "/reportar/"+ url + "/"+id;

            });
        }

        // Quando carregar a página
        $(function () {
            // Faz a primeira atualização
            atualizarFila();
        });
    </script>
   
</body>

</html>