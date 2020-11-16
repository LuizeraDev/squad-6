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
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!-- Styles -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/tailwindcss/1.9.6/tailwind.min.css" 
    integrity="sha512-l7qZAq1JcXdHei6h2z8h8sMe3NbMrmowhOl+QkP3UhifPpCW2MC4M0i26Y8wYpbz1xD9t61MLT9L1N773dzlOA==" crossorigin="anonymous" />
    <link rel="stylesheet" href="{{ asset('css/salas.css') }}">
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

<header class="bg-white shadow ">
                <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                <div class="w-full block flex-grow lg:flex lg:items-center lg:w-auto max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                    <div class="text-sm lg:flex-grow">
                        <a href="#responsive-header" class="block mt-4 lg:inline-block lg:mt-0 text-teal-200 hover:text-white mr-4">
                            <div class="mockup">xxxxxxx</div> <img src="" alt="">
                        </a>
                        <a href="./user/profile" class="perfilLink block mt-4 lg:inline-block lg:mt-0 text-gray-800 hover:text-white mr-4">
                            Perfil
                        </a>    
                    </div>
                    


                    @if ($_SESSION['santos'])
                    <h3>Você esta conectado a unidade de Santos</h3>
                    @else
                    <h3>Você esta conectado a unidade de São Paulo</h3>
                    @endif

                </div>
</header>

<div class="grid min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0 bg-gray-100"> <!--- GRID -->

    <section class="salasContainer">
         
      
    </section>
    <a class="voltarUnidade font-bold text-sm text-blue-500 hover:text-orange-800" href="unidade">Voltar a escolha da unidade</a>
        
    
</div>

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
            .addClass("max-w-sm rounded overflow-hidden shadow-lg bg-gray-200 tracking-widest")
            .addClass("bg-gray-500 hover:bg-blue-600 text-white font-bold py-2 px-4 border border-gray-200 rounded");

              
            newSala.append( "<a href='criarsala'>Criar Sala</a>"  )


                $.get("{{ route('salasConteudo') }}", function (dadosSalas) {

                    $contador = 0; // contador de usuários para a sala

                    // Exibe informações sobre os usuários cadastrados / online / ausente / offline, sala em que está
                    for (sala of dadosSalas.usuarios){

                            console.log(dadosSalas.usuarios[sala] ); 
                        }
                
                    for (i = 0; i < dadosSalas.sala.length; i++){   
                        //cria sala individual baseada nas salas do DB
                        wrapperSala[i] = $("<div/>").addClass("wrapper").addClass("max-w-sm rounded overflow-hidden shadow-lg bg-gray-200");

                        wrapperSala[i].append(
                            "<img class='w-full' src='{{ $url }}" + dadosSalas.sala[i].img_sala 
                            + "' width=200>"
                        );

                        wrapperSala[i].append("<div class='px-6 py-4'>");

                        wrapperSala[i].append("<h3 class='font-bold text-xl mb-2'><b>" + dadosSalas.sala[i].nm_sala + "</b></h3>");

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
                        
                        wrapperSala[i].append("</div>");
                        
                        wrapperSala[i].append(
                            //classes do tailwind css
                            "<button class='inline-flex items-center px-4 py-2 bg-blue-600 border" 
                            + "border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest"
                    
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
                                "<button class='inline-flex items-center px-4 py-2 bg-orange-300 border" 
                                + "border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest"
                                + " ml-4'"
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