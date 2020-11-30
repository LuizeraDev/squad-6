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

    <div class="background">
     
            <!-- No php, pegamos dados através do campo "name" dos inputs -->
            <section class="container" align="center">

                <div id="conteudo1"></div>
            
            
                <div id="conteudo"></div>
                <div id="conteudo2"></div>
                
                <div id="conteudo3"></div>
                

              


                <div id="Timer"></div>
                <div id="conteudo4"></div>
                
            </section>

            
    </div>

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
                        let userDiv = []

                        if (dadosFila.Utilizando[i].profile_photo_path) {
                            userDiv[i] = $("<div/>").addClass("userPlayingDiv").appendTo("#conteudo");

                            let userAvatar = $("<div/>").addClass("userPlayingAvatar");
                            let userStatus = $("<div/>").addClass("userPlayingStatus");
                            let userNowPlayingTag = $("<div/>").addClass("nowPlayingTag");

                                userAvatar.append("<img src='{{ $url }}" + dadosFila.dadosFila[i].profile_photo_path + "' width='40'>");
                                userStatus.append("<p> Em progresso <p/>");
                                userNowPlayingTag.append("<h3> LIVE <h3/>")

                                userDiv[i].append(userAvatar);
                                userDiv[i].append(userStatus);
                                userDiv[i].append(userNowPlayingTag);
                        
                        }
                       
                    }
                    // Informações do usuário que entrou na sala
                    for (i = 0; i < dadosFila.dadosUsuario.length; i++) {

                        let greetings = $("<div/>").addClass("greetMessage").appendTo("#conteudo1");

                        greetings.append("<h3> E aê " + dadosFila.dadosUsuario[i].name + "</h3>");
                        greetings.append("<p> Você está na fila da sala " + dadosFila.dadosUsuario[i].nm_sala + "</p>");
                        greetings.append("<p2> e a sua posição é" + dadosFila.dadosUsuario[i].cd_fila_usuario + "</p2>");
                     
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

                        let userDiv = []
                    
                        if (dadosFila.dadosFila[i].cd_fila_usuario) {
                        
                            userDiv[i] = $("<div/>").addClass("userDiv").appendTo("#conteudo2");

                            if (dadosFila.dadosFila[i].profile_photo_path) {

                                let userAvatar = $("<div/>").addClass("userAvatar");
                                userAvatar.append("<img src='{{ $url }}" + dadosFila.dadosFila[i].profile_photo_path + "' width='40'>");

                                userDiv[i].append(userAvatar);

                            } else {

                                let userAvatar = $("<div/>").addClass("userAvatar");
                                userAvatar.append("<img src= '{{ asset('assets/defaultPic.jpg') }}' alt='default picture'>");
                                userDiv[i].append(userAvatar);
                                

                            }
                      
                           

                            if (dadosFila.dadosUsuario[0].name != dadosFila.dadosFila[i].name) {
                                
                                let userName = $("<h3/>");
                                let userStatus = $("<p/>");
                                let reportButton = $("<div/>").addClass("reportButton");

                                
                                userName.append( dadosFila.dadosFila[i].name );
                                userStatus.append("Posição: " + dadosFila.dadosFila[i].cd_fila_usuario);
                                reportButton.append( "<a class='reportar' href='#" + i + "' onclick=reportar(this.href)>Reportar</a>");
                                
                                
                                userDiv[i].append(userName);
                                userDiv[i].append(userStatus);
                                userDiv[i].append(reportButton);

                                
                            } else {

                                let userName = $("<h3/>");
                                let userStatus = $("<p/>");
                                let reportButton = $("<div/>").addClass("reportButton");

                                
                                userName.append( dadosFila.dadosFila[i].name );
                                userStatus.append("Posição: " + dadosFila.dadosFila[i].cd_fila_usuario);
                                reportButton.append("<a href='#" + i + "'</a>");
                                
                                userDiv[i].append(userName);
                                userDiv[i].append(userStatus);
                                userDiv[i].append(reportButton);

                            }
                        }

               
                    }
                    // Exibe o botão vou jogar de acordo com os espaços da sala.
                    
                    let buttons = $('<div/>').addClass('buttons').appendTo('#conteudo2')

                    var espaco = dadosFila.dadosUsuario[0].demanda - dadosFila.Utilizando.length;

                    if (dadosFila.dadosUsuario[0].cd_fila_usuario <= espaco && dadosFila.Utilizando.length < dadosFila.dadosUsuario[0].demanda) {

                        buttons.append("<a class='leaveButton' href='{{$salaId}}/desistente'>Desistir</a>");
                        buttons.append("<a class='minhaVezButton' href='{{$salaId}}/voujogar'>Minha Vez</a>");

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