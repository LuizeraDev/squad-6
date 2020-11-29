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

    <!-- Styles -->
    
    <link rel="stylesheet" href="{{ asset('css/global.css') }}">
    <link rel="stylesheet" href="{{ asset('css/fila.css') }}">

</head>

<body>
    <div class="min-h-screen flex flex-col items-center pt-6 sm:pt-0 ">
        <!--- GRID -->

        <main>
            <!-- No php, pegamos dados através do campo "name" dos inputs -->
            <section class="container" align="center">

                <div id="conteudo1"></div>
                <hr>
                <div id="conteudo"></div>


                <div id="Timer"></div>
                <div id="conteudo4"></div>

                <div id="conteudo2"></div>
                <div id="conteudo3"></div>
                
            </section>

            <a class="botaoDesistir" href="{{$salaId}}/desistente">Desistir</a>
        </main>

        <!-- Este script é necessário para fazer a conexão assíncrona com o AJAX -->
        <script src="https://code.jquery.com/jquery-3.5.1.js"></script>

        <script>
            var temporizador = 11;
            // Função responsável por atualizar as filas
            function atualizarFila() {
                $.ajax({
                    url: "{{ route('filaConteudo') }}",
                    dataType: "json",
                    cache: false,
                }).done(function (dadosFila) {
                    // Descarta todas as informações anteriores para novas informações
                    $('#conteudo').html("");
                    $('#conteudo1').html("");
                    $('#conteudo2').html("");
                    $('#conteudo3').html("");
                    $('#conteudo4').html("");
                    // Atualiza a quantidade de pessoas na demanda.
                    $('#demanda').text("Espaços: " + dadosFila.Utilizando.length + "\\" + dadosFila.dadosUsuario[0].demanda);
                    for (i = 0; i < dadosFila.Utilizando.length; i++) {
                        // Exibe foto do usuário se existir
                        if (dadosFila.Utilizando[i].profile_photo_path) {
                            $('#conteudo').append("<div class='user'> <img src='{{ $url }}" + dadosFila.Utilizando[i].profile_photo_path + "' width='40'>");
                            $('#conteudo').append("<div class='infoAndamento'> <b>" + dadosFila.Utilizando[i].name + "</b>" + "Status: <b>Em andamento</b></div>");
                        
                        }
                       
                    }
                    // Informações do usuário que entrou na sala
                    for (i = 0; i < dadosFila.dadosUsuario.length; i++) {
                        $('#conteudo1').append(
                            "E aew <b>" + dadosFila.dadosUsuario[i].name + "</b><br><br>" +
                            "Você está na fila da sala <b>" + dadosFila.dadosUsuario[i].nm_sala + "</b> " +
                            "e sua posição é <b>" + dadosFila.dadosUsuario[i].cd_fila_usuario
                        );
                    }
                    
                    
                    if (dadosFila.dadosUsuario[0].report) {
                        
                        $('#conteudo4').html(
                            "Você ainda está ai? <button id='estouaqui' type='button' onClick='clicksim()'>Sim</button>" +
                            "<hr>"
                        );
                        
                        if (temporizador == 11) {
                            contagemregressiva = setInterval(function () {
                                temporizador -= 1;
                                $('#Timer').text(temporizador + " segundos")
                            }, 1000);
                        }
                        setInterval(function () {
                            window.location.href = "{{$salaId}}/desistente";
                            alert("Você não confirmou que está na sala, estamos te redirecionando para o dashboard");
                        }, 12000);

                        
                    }
                    // Exibe usuários da fila
                    for (i = 0; i < dadosFila.dadosFila.length; i++) {
                        // Verifica se o usuário tem um código de fila
                        if (dadosFila.dadosFila[i].cd_fila_usuario) {
                            // Verifica se o usuário tem um caminho de imagem, se ele tiver a imagem é exibida.
                            if (dadosFila.dadosFila[i].profile_photo_path) {
                                $('#conteudo2').append(
                                    "<div class='user'><img src='{{ $url }}" + dadosFila.dadosFila[i].profile_photo_path + "' width='40'>"
                                );
                            }
                            // Exibe os usuários da fila da sala em questão
                            if (dadosFila.dadosUsuario[0].name != dadosFila.dadosFila[i].name) {
                                $('#conteudo2').append(
                                    "<div class='info'><b>" + dadosFila.dadosFila[i].name + "</b> - " +
                                    "Posição: <b>" + dadosFila.dadosFila[i].cd_fila_usuario + "</b>" +
                                    "<a class='reportar' href='#" + i + "' onclick=reportar(this.href)>Reportar</a></div></div>"
                                );
                            } else {
                                $('#conteudo2').append(
                                    "<div class='info'><b>" + dadosFila.dadosFila[i].name + "</b> - " +
                                    "Posição: <b>" + dadosFila.dadosFila[i].cd_fila_usuario + "</b></div></div>" +
                                    "<a href='#" + i + "'</a>"
                                );
                            }
                        }
                    }
                    // Exibe o botão vou jogar de acordo com os espaços da sala.
                    var espaco = dadosFila.dadosUsuario[0].demanda - dadosFila.Utilizando.length;
                    if (dadosFila.dadosUsuario[0].cd_fila_usuario <= espaco &&
                        dadosFila.Utilizando.length < dadosFila.dadosUsuario[0].demanda) {
                        $('#conteudo3').html("<a  class='minhaVez' href='{{$salaId}}/voujogar'>Minha Vez</a>");
                    }
                    setTimeout("atualizarFila()", 3000) // 3 segundos / Tempo de espera de atualização dos dados
                })
            }

            function reportar(pos) {
                $.ajax({
                    url: "{{ route('filaConteudo') }}",
                    dataType: "json",
                    cache: false,
                }).done(function (dadosFila) {
                    // Pegar posição pelo href
                    tamanho = pos.substring(pos.indexOf("#") + 1);
                    id = dadosFila.dadosFila[tamanho].id;
                    url = this.locate
                    if (confirm("Você está reportando " + dadosFila.dadosFila[tamanho].name))
                        window.location.href = "/reportar/" + url + "/" + id;

                });
            }

            function clicksim() {
                $.ajax({
                    url: "{{ route('filaConteudo') }}",
                    dataType: "json",
                    cache: false,
                }).done(function (dadosFila) {
                    clearInterval(contagemregressiva);
                    window.location.href = "/estouaqui/" + dadosFila.dadosUsuario[0].id;
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