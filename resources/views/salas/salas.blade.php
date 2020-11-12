<?php 
session_start();
$url='http://localhost:8080/squad-6/storage/app/public/';
?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{ asset('css/salas.css') }}">

    @if ($_SESSION['santos'])
    <title>Fifo - Salas Santos</title>
    @else
    <title>Fifo - Salas São Paulo</title>
    @endif
</head>

<body>

<div class="grid">

    <div class="row">

            <div class="logo">
                <h1>LOGO</h1>
            </div>

                

                @if ($_SESSION['santos'])
                <h3>Você esta conéctado a unidade de Santos</h3>
                @else
                <h3>Você esta conéctado a unidade de São Paulo</h3>
                @endif


                <div id="conteudo">
                                      
                </div>

                <div class="option">
                        <a href="criarsala">Criar Sala</a>
                    </div> 

                <div class="button">
                    <a href="unidade">Voltar a escolha da unidade</a>
                </div>

                <!-- Este script é necessário para fazer a conexão assíncrona com o AJAX -->
                <script src="https://code.jquery.com/jquery-2.1.3.min.js"></script>

                <script>
                    // Função responsável por atualizar as salas
                    function atualizarSalas() {

                        let conteudo_salas = document.getElementById['conteudo'];

                        conteudo_salas.innerHTML = "";

                        $.get("{{ route('salasConteudo') }}", function (dadosSalas) {

                            console.log(dadosSalas.qt_usuarios);

                            // Exibe informações sobre os usuários cadastrados / online / ausente / offline, sala em que está
                            for (i = 0; i < dadosSalas.usuarios.length; i++) 
                            { 
                                console.log(dadosSalas.usuarios[i]);
                            }
                        
                            for (i = 0; i < dadosSalas.sala.length; i++) 
                            {      
                         
                                conteudo_salas.createElement +=
                                    "<p> Nome da sala: <b>" + dadosSalas.sala[i].nm_sala + "</b></p>";
                                    $contador = 0;
                                // Conta a quantidade de pessoas em uma determinada sala.
                                for(c = 0; c < dadosSalas.qt_usuarios.length; c++){
                                    
                                    // Faz a verificação se o nome da sala é o mesmo do usuário.
                                    if (dadosSalas.sala[i].nm_sala == dadosSalas.qt_usuarios[c].nm_sala) {
                                        $contador += 1;
                                    } 
                                }
                                conteudo_salas.innerHTML +=
                                                "<p> Usuários na sala: <b>" + $contador + "</b></p>";
                                conteudo_salas.innerHTML += "<img src='{{ $url }}" + dadosSalas.sala[i].img_sala + "' width=200>" + "<br>" +
                                        "<a href='salas/sala/" + dadosSalas.sala[i].nm_sala + "/" +  
                                    <?php if ($_SESSION["santos"]) { echo  "dadosSalas.sala[i].cd_sala_santos"; } 
                                    else { echo "dadosSalas.sala[i].cd_sala_sao_paulo"; }  ?>
                                    + "'>Entrar na Sala</a>" + "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;" +
                                    "<a href='salas/sala/" + dadosSalas.sala[i].nm_sala + 
                                    "/excluir/" + dadosSalas.sala[i].cd_sala_santos + "'>Excluir Sala</a>";
                                    
                                  
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
    </div>

</div>
</body>

</html>