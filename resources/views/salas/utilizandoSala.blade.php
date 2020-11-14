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
</head>

<style>
    .container {
        margin-top: 15%;
    }
</style> 

<body>
    <main>
        <section class="container" align=center>
            <h2>Utilizando a Sala</h2>
            <div id="demanda"></div>
            <br>
            <div id="Timer"></div>
            <div id="conteudo4"></div>
            <div id="conteudo"></div>
            <br><br>
            <h3>Selecione um botão após terminar</h3>
            <a href="Voltar">Voltar para o final da fila</a>
            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
            <a href="Acabei">Sair da sala</a>
        </section>
    </main>

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
                                "<img src='{{ $url }}" + dadosFila.Utilizando[i].profile_photo_path+"' width='40'> &nbsp;"
                            );
                        }

                        // Exibe os usuários da fila da sala em questão
                        if (dadosFila.dadosUsuario[0].name != dadosFila.Utilizando[i].name) {
                            // Exibe usuários que estão utilizando a sala
                            $('#conteudo').append(
                                "Nome: <b>" + dadosFila.Utilizando[i].name+"</b>&nbsp;&nbsp;" +
                                "Status: <b>Em andamento</b>&nbsp;&nbsp;"+
                                "<a href='#"+i+"' onclick=reportar(this.href)>Reportar</a><br><br>"
                            );
                        } else {
                            $('#conteudo').append(
                                "Nome: <b>" + dadosFila.Utilizando[i].name+"</b>&nbsp;&nbsp;" +
                                "Status: <b>Em andamento</b>&nbsp;&nbsp;"+
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