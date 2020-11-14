<?php 
session_start();
$url='http://localhost:8080/squad-6/storage/app/public/';

// Verifica se o usuário já entrou em alguma sala
if (isset($_SESSION['entrou_sala']) && isset($_SESSION['cd_sala']) && $_SESSION['entrou_sala']) {

    // pega o Id da sala que ele deixou pelo botão voltar do browser
    $id_sala_anterior = $_SESSION['cd_sala']; 

    /* 
    * Resolvendo problema do usuário quando ele tenta voltar pelo browser
    * Basicamente eu passo o parâmetro com a sala anterior dele e retiro ele da sala 
    * mandando ele pro controler de desistência da fila
    */

   echo "<script>window.location.href='/salas/sala/nomesala/". $id_sala_anterior ."/desistente'</script>";
}
?>
<!DOCTYPE html>
<html lang="pt-br">

<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <!-- Fonts -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap">

    <!-- Styles -->
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <link rel="stylesheet" href="{{ asset('css/unidade.css') }}">


    @livewireStyles

    <!-- Scripts -->
    <script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.7.3/dist/alpine.js" defer></script>

    @if ($_SESSION['santos'])
    <title>Fifo - Salas Santos</title>
    @else
    <title>Fifo - Salas São Paulo</title>
    @endif

</head>

<body>


<div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0 bg-gray-100"> <!--- GRID -->

    <h2>Logotipo - Fifo</h2>

    <a href="criarsala">Criar Sala</a>

    @if ($_SESSION['santos'])
    <h3>Você esta conectado a unidade de Santos</h3>
    @else
    <h3>Você esta conectado a unidade de São Paulo</h3>
    @endif

    <section>
         
      
    </section>
    <br><br>
    <a href="unidade">Voltar a escolha da unidade</a>

    <!-- Este script é necessário para fazer a conexão assíncrona com o AJAX -->
    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>

    <script>

        // Função responsável por atualizar as salas
        function atualizarSalas() {
            //cria container para inserir as salas
            var conteudo_salas = $("<div/>").addClass("conteudoContainer").addClass("sm:flex mb-4").appendTo("section");

            conteudo_salas.innerHTML = "";
            //cria array das salas
            var wrapperSala = []

            var newSala = 
            $("<div/>")
            .addClass("criarSala")
            .addClass("")
            .addClass("");

              
            newSala.append( "<a href='criarsala'>Criar Sala</a>"  )


                $.get("{{ route('salasConteudo') }}", function (dadosSalas) {

                    $contador = 0; // contador de usuários para a sala

                    // Exibe informações sobre os usuários cadastrados / online / ausente / offline, sala em que está
                    for (sala of dadosSalas.usuarios){

                            console.log(dadosSalas.usuarios[sala] ); 
                        }
                
                    for (i = 0; i < dadosSalas.sala.length; i++){   
                        //cria sala individual baseada nas salas do DB
                        wrapperSala[i] = $("<div/>").addClass("wrapper").addClass("");

                        wrapperSala[i].append("<p> Nome da sala: <b>" + dadosSalas.sala[i].nm_sala + "</b></p>");

                        // Conta a quantidade de pessoas em uma determinada sala.
                        for(c = 0; c < dadosSalas.qt_usuarios.length; c++){
                            // Faz a verificação se o nome da sala é o mesmo do usuário.
                            if (dadosSalas.sala[i].nm_sala == dadosSalas.qt_usuarios[c].nm_sala) {

                                $contador *= 1 ; //adiciona +1 para cada usuário na                                
                            } 
                        }

                        wrapperSala[i].append(
                            "<p> Usuários na sala: <b>"
                            + $contador 
                            + "</b></p>"
                        );

                        wrapperSala[i].append(
                            "<img src='{{ $url }}" + dadosSalas.sala[i].img_sala 
                            + "' width=200>"
                        );
                        
                        wrapperSala[i].append(
                            //classes do tailwind css
                            "<button class='inline-flex items-center px-4 py-2 bg-gray-800 border" 
                            + "border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest"
                            + "hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:shadow-outline-gray"
                            + "disabled:opacity-25 transition ease-in-out duration-150 ml-4'"
                            //fim tailwind
                            + "class='enterButton'>"//adiciona classe
                            //rota da sala
                            + "<a href='salas/sala/" + dadosSalas.sala[i].nm_sala + "/" +  
                            //logica da rota
                            <?php if ($_SESSION["santos"]){ 
                                echo  "dadosSalas.sala[i].cd_sala_santos";
                                } else { 
                                    echo "dadosSalas.sala[i].cd_sala_sao_paulo"; 
                                    } ?> 

                            + "'>Entrar na Sala</a></button>"
                        );

                            wrapperSala[i].append(
                                "<button class='inline-flex items-center px-4 py-2 bg-gray-800 border" 
                                + "border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest"
                                + "hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:shadow-outline-gray"
                                + "disabled:opacity-25 transition ease-in-out duration-150 ml-4'"
                                //fim tailwind
                                + "class='deleteButton'>" //adiciona classe
                                //rota da sala
                                + "<a href='salas/sala/" + dadosSalas.sala[i].nm_sala + "/excluir/" + dadosSalas.sala[i].cd_sala_santos 
                                + "'>Excluir Sala</a></button>"
                            );                 
                        
                    }

                    
                    conteudo_salas.append(wrapperSala);
                  

                    conteudo_salas.append(newSala)
                })
                
                
        }

        // Definindo intervalo que a função será chamada no caso 10 em 10 segundos
        
        // Quando carregar a página
        $(function () {
            // Faz a primeira atualização
            atualizarSalas();
        });
    </script>

</body>

</html>