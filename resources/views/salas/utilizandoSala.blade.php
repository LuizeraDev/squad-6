<?php 
$salaId = $_SESSION['cd_sala'];
$url='http://localhost:8080/squad-6/storage/app/public/';
?>
<!DOCTYPE html>

<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Fifo - Utilizando Sala</title>
    
    <!-- Styles -->
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <link rel="stylesheet" href="{{ asset('css/global.css') }}">
    <link rel="stylesheet" href="{{ asset('css/utilizando-sala.css') }}">
</head>


<body>

<div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0"> <!--- GRID -->
    <main>
        <section class="container" align=center>
            <h3>Utilizando a Sala</h3>
            <div id="demanda"></div>
            <br>
            <div id="Timer"></div>
            <div id="conteudo4"></div>
            <div id="conteudo"></div>
            <br>
            <h3>Selecione um botão após terminar</h3>
            <br>
            <a href="Voltar" class="corBotoes items-center border border-transparent font-semibold text-xs text-white uppercase tracking-widest">
            Voltar para o final da fila</a>

            <a href="Acabei" class="corBotoes desistir items-center border border-transparent font-semibold text-xs text-white uppercase tracking-widest">
                Sair da sala</a>
        </section>
    </main>
</div>

    
    <!-- Este script é necessário para fazer a conexão assíncrona com o AJAX -->
    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>

    <script>
        var temporizador = 11;

        function atualizarFila() {
                $.ajax({ 
                    url: "{{ route('filaConteudo') }}",
                    dataType: "json",
                    cache: false,
                }).done(function (dadosFila) {

                    $('#demanda').text("Espaços: " + dadosFila.Utilizando.length + "\\" + dadosFila.dadosUsuario[0].demanda);

                    // Descarta todas as informações anteriores para novas informações
                    $('#conteudo').html("");
                    

                    for (i = 0; i < dadosFila.Utilizando.length; i++) 
                    {
                        // Exibe foto do usuário se existir
                        if (dadosFila.Utilizando[i].profile_photo_path) {
                            $('#conteudo').append(
                                "<img src='{{ $url }}" + dadosFila.Utilizando[i].profile_photo_path+"' width='40'>&nbsp;&nbsp;"
                            );
                        }

                        // Exibe os usuários da fila da sala em questão
                        if (dadosFila.dadosUsuario[0].name != dadosFila.Utilizando[i].name) {
                            // Exibe usuários que estão utilizando a sala
                            $('#conteudo').append(
                                "<div class='info'><b>" + dadosFila.Utilizando[i].name+"</b></div>" +
                                "<a class='reportar' href='#"+i+"' onclick=reportar(this.href)>Reportar</a><br><br>"
                            );
                        } else {
                            $('#conteudo').append(
                                "<div class='info'><b>" + dadosFila.Utilizando[i].name+"</b></div>" +
                                "<a href='#"+i+"'</a><br><br>"
                            );
                        }
                        
            
                    }

                    if (dadosFila.dadosUsuario[0].report) {
                            $('#conteudo4').html(
                                "Você ainda está ai? <button id='estouaqui' type='button' onClick='clicksim()'>Sim</button>"
                            );
                            
                            if (temporizador == 11) {
                                setInterval(function(){
                                        temporizador -= 1;
                                        $('#Timer').text(temporizador+" segundos")
                                },1000);                               
                            }                        

                            setInterval(function(){window.location.href = "excluirjogando";
                                alert("Você não confirmou que está na sala, estamos te redirecionando para o dashboard");
                            }, 12000);
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
                    if (confirm("Você está reportando " + dadosFila.dadosFila[tamanho].name))
                        window.location.href = "/reportar/"+ url + "/"+id;

                });
            }
        
            function clicksim() {
                $.ajax({ 
                    url: "{{ route('filaConteudo') }}", 
                    dataType: "json",
                    cache: false,
                }).done(function (dadosFila){
                    window.location.href = "/estouaqui/"+ dadosFila.dadosUsuario[0].id ;
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