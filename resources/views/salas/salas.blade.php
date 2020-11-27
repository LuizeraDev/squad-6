<?php 
if (!isset($_SESSION))
session_start();
$url='http://localhost:8080/squad-6/storage/app/public/';

// Essa Session aqui é para controlar o que aparece no menu
$_SESSION['dashboard'] = false;

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


    <!-- Importando tailwind -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/tailwindcss/1.9.6/tailwind.min.css"
        integrity="sha512-l7qZAq1JcXdHei6h2z8h8sMe3NbMrmowhOl+QkP3UhifPpCW2MC4M0i26Y8wYpbz1xD9t61MLT9L1N773dzlOA=="
        crossorigin="anonymous" />

    <!-- Styles -->

    <link rel="stylesheet" href="{{ asset('css/salas/salasPage.css') }}">
    <link rel="stylesheet" href="{{ asset('css/global.css') }}">
    <link rel="stylesheet" href="{{ asset('css/salas/modal.css') }}">
    <link rel="stylesheet" href="{{ asset('css/salas/cards.css') }}">
    <link rel="stylesheet" href="{{ asset('css/salas/users.css') }}">

    @livewireStyles

    @if ($_SESSION['santos'])
    <title>Fifo - Salas Santos</title>
    @else
    <title>Fifo - Salas São Paulo</title>
    @endif

</head>

<body>
@livewire('navigation-dropdown') 

<div class="background">
<div class="mensagem">
        <h2>SELECIONE SUA ATIVIDADE</h2>
        <p>No momento estas são as atividades que estão rolando.</p>
        <p>Está esperando o que? Aproveite e entre já em uma!</p>
        @if($errors->any())
            <h4 style="color:red;">{{$errors->first()}}</h4>
        @endif
</div>
</div>
   

    <!--- GRID -->



   
  


        <section class="salasContainer" id="salasContainer"></section>

        <a class="voltarUnidade" href="dashboard">Voltar a escolha da unidade</a>



    


    
    <div class="onlineUsers">
        
        <div class="modalUser toggleActive">
            <div class="usersWindow">
                <!-- DIV QUE RECEBE A LISTA DE USUÁRIOS ONLINE-->
            </div>

    </div>
    
    

    <div class="deleteRoom active ">
       <div class="modal">

            <a class="closeButton" onclick="fecharModal()"> x </a>
            <div class="message">
                <h2 class="warning">TEM CERTEZA QUE DESEJA EXCLUIR? </h2>
                <p style="color:red;" id="resposta"></p>
            </div>
            <div class="input">
                <p class="confirmMessage"> Para confirmar a exclusão digite a senha "<label id="aleatorio"></label>" no campo abaixo</p>
                <input class="input" type="text" id="numero_aleatorio" maxlength="3">
            </div>
            <div class="buttons">
                <a class="cancelButton" onclick="fecharModal()"> Cancelar </a>
                <button class="corbotoesDelete delButton" id="confirma-excluir">Excluir</button>
            </div>
       </div>
    </div>

  

<script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.7.3/dist/alpine.js" defer></script>
<!-- Este script é necessário para fazer a conexão assíncrona com o AJAX -->
<script src="https://code.jquery.com/jquery-3.5.1.js"></script>

    <script>
        // Função responsável por atualizar as salas
        function atualizarSalas() {
            $.ajax({
                url: "{{ route('salasConteudo') }}",
                dataType: "json",
                cache: false,
            }).done(function (dadosSalas) {
                //cria container para inserir as salas
                $('#salasContainer').html("");
                var conteudo_salas = $("<div/>").addClass("conteudoContainer").appendTo("section");
                conteudo_salas.innerHTML = "";
                //cria array das salas
                var wrapperSala = []
                var newSala =
                    $("<div/>")
                        .addClass("criarSala")
                        .addClass("")
                        .addClass("");
                
                newSala.append("<div class='addBox'><img src='{{ asset('assets/add_img.png') }}' alt=''></div>")
                newSala.append("<a href='criarsala'>Criar Sala</a>")

                for (i = 0; i < dadosSalas.sala.length; i++) 
                {
                    //cria sala individual baseada nas salas do DB
                    wrapperSala[i] = $("<div/>").addClass("wrapper").addClass(" ");
                    wrapperSala[i].append(
                        "<img class='w-full' src='{{ $url }}" + dadosSalas.sala[i].img_sala
                        + "' width=200>"
                    );
                    wrapperSala[i].append("<div class=''>");
                    wrapperSala[i].append("<h3 class='font-bold text-xl'><b>" + dadosSalas.sala[i].nm_sala + "</b></h3>");
                    
                    var contador = 0; // contador de usuários para a sala

                    // Conta a quantidade de pessoas em uma determinada sala.
                    for (c = 0; c < dadosSalas.qt_usuarios.length; c++) 
                    {

                        /*
                        * Faz uma verificação se o nome da sala 
                        * é o mesmo nome que a sala em que o usuário está.
                        */ 

                        if (dadosSalas.sala[i].nm_sala == dadosSalas.qt_usuarios[c].nm_sala) {
                            contador += 1; //adiciona +1 para cada usuário na                                
                        }

                    }

                    wrapperSala[i].append(
                        "<p class='quantPessoas'> Há <b>"
                        + contador
                        + "</b> pessoas nesta atividade.</p>"
                      
                    );

                    wrapperSala[i].append("</div>");


                    wrapperSala[i].append(
                        //classes do tailwind css
                        "<button class='enterButton inline-flex items-center "
                            + "border-transparent font-semibold text-xs text-white uppercase tracking-widest'>"
                            //rota da sala
                            + "<a href='salas/sala/" + dadosSalas.sala[i].nm_sala + "/" +
                            //logica da rota
                            <?php if ($_SESSION["santos"]) {
                                echo  "dadosSalas.sala[i].cd_sala_santos";
                            } else {
                                echo "dadosSalas.sala[i].cd_sala_sao_paulo";
                            } ?>
                                + "'>Entrar na Sala</a></button>"
                        );

                    wrapperSala[i].append(
                        '<button class="corbotoesDelete deleteButton inline-flex items-center border'
                        + 'border-transparent font-semibold text-xs text-white uppercase tracking-widest">' 
                        // Desta maneira conseguimos passar o parâmetro em formato de String
                        + '<a onClick="modal(\'' + dadosSalas.sala[i].nm_sala + '\')">Excluir Sala</a></button>'
                    );
        } // Endfor 

        conteudo_salas.append(wrapperSala);

        conteudo_salas.append(newSala)
        
        
        setTimeout("atualizarSalas()", 3000) // 3 segundos / Tempo de espera de atualização dos dados

                });
                           
        }
        // Definindo intervalo que a função será chamada no caso 10 em 10 segundos

        // Quando carregar a página
        $(function () {
            // Faz a primeira atualização
            atualizarSalas();
        });
</script>



<script>

    //MODAL DA JANELA DE DELETAR SALAS
    function modal(nome_sala) 
    { 
        $("#nomeSala").html(nome_sala);
        $(".deleteRoom").addClass("active");
        $(".active").css("display", "block");
        $("body").css("overflow-y","hidden");

        var aleatorio = Math.floor(Math.random() * (999 - 100) + 100);
        $("#aleatorio").html(aleatorio);
        // Essa função realiza a exclusão da sala
        $( "#confirma-excluir" ).click(function(){
            var valor_digitado = document.all("numero_aleatorio").value;
            var resposta = document.all["resposta"];

            if (valor_digitado == aleatorio) {
                window.location.href = "salas/sala/" + nome_sala + "/excluir-sala/";
            }else{
                resposta.innerHTML = "O valor informado não confere";
            }
        }); 
    } 

    
    function fecharModal()
    {
        $(".active").css("display", "none");
        $(".active").removeClass("active");
        $("body").css("overflow-y","visible");
    }

    //MODAL DOS USUARIOS ONLINE
    function onlineAgora() {
            $.ajax({
                url: "{{ route('salasConteudo') }}",
                dataType: "json",
                cache: false,
            }).done(function (dadosSalas) {
                $(".usersWindow").html("");

                const statusUsuario = [];

                for (i = 0; i < dadosSalas.usuarios.length; i++) 
                {  
                    // esse código é necessário para descobrirmos se o usuário entrou na unidade de Santos ou São Paulo
                    <?php  
                        if ($_SESSION['santos']) { 
                           echo "var unidade = 'santos'";
                        } else {
                            echo "var unidade = 'sao_paulo'";
                        }
                    ?>

                    if (dadosSalas.usuarios[i].unidade == unidade) {

                        if (dadosSalas.usuarios[i].nm_sala && unidade === "santos") {
                            statusUsuario[i] = $("<div/>").addClass("userStatus");

                               
                                statusUsuario[i].append("<h3/> <b>" + dadosSalas.usuarios[i].name + "</b>");
                                statusUsuario[i].append("<p2/> <b>" + dadosSalas.usuarios[i].status + "</b>")
                                statusUsuario[i].append("<p3/> em: <b>" + dadosSalas.usuarios[i].nm_sala + "</b>")
                                statusUsuario[i].append("<button class='follow'><a href='/salas/sala/"+dadosSalas.usuarios[i].nm_sala+"/"+dadosSalas.usuarios[i].cd_sala_santos+"' >Seguir Usuário</a></button>")
                                
                        } else if (dadosSalas.usuarios[i].nm_sala && unidade === "sao_paulo") {
                            statusUsuario[i] = $("<div/>").addClass("userStatus");

                                statusUsuario[i].append("<h3/> <b>" + dadosSalas.usuarios[i].name + "</b>");
                                statusUsuario[i].append("<p2/><b>" + dadosSalas.usuarios[i].status + "</b>")
                                statusUsuario[i].append("<p3/>em: <b>" + dadosSalas.usuarios[i].nm_sala + "</b>")
                                statusUsuario[i].append("<button class='follow'><a href='/salas/sala/"+dadosSalas.usuarios[i].nm_sala+"/"+dadosSalas.usuarios[i].cd_sala_sao_paulo+"' >Juntar-se</a></button>")

                        } else {
                            statusUsuario[i] = $("<div/>").addClass("userStatus");

                                statusUsuario[i].append("<h3/><b>" + dadosSalas.usuarios[i].name + "</b>");
                                statusUsuario[i].append("<p2/><b>" + dadosSalas.usuarios[i].status + "</b>")
                        }
                            
                    } 
                         
                }
            
                $(".usersWindow").append("<button class='fecharUserList' onClick='closeUserList()'> x </button>");
                $(".usersWindow").append(statusUsuario);
                $(".usersWindow").append("<button class='cancelButtonUserModal' onClick='closeUserList()'> Cancelar </button>");            

            setTimeout("onlineAgora()", 3000); // 3 segundos / Tempo de espera de atualização dos dados
        });     
    }   

    // Requisitar a função
    $(function () {
        // Faz a primeira atualização
        onlineAgora();
    });   
    


    function modalUserList() {
    
        $(".modalUser").addClass("toggleActive");
        $(".toggleActive").css("display", "grid");
        $(".modalUser").css("display", "grid");
        $("body").css("overflow-y","hidden");
    
    }

    function closeUserList() {

        $(".modalUser").css("display", "none");
        $(".toggleActive").css("display", "none");
        $(".modalUser").removeClass("toggleActive");
        $("body").css("overflow-y","visible");
     
    }
</script>


</body>

</html>