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
    @if ($_SESSION['santos'])
    <title>Fifo - Salas Santos</title>
    @else
    <title>Fifo - Salas São Paulo</title>
    @endif
</head>

<body>
    <h2>Logotipo - Fifo</h2>

    <a href="criarsala">Criar Sala</a>

    @if ($_SESSION['santos'])
    <h3>Você esta conectado a unidade de Santos</h3>
    @else
    <h3>Você esta conectado a unidade de São Paulo</h3>
    @endif

    <div id="conteudo"></div>

    <br><br>
    <a href="unidade">Voltar a escolha da unidade</a>

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

                // Limpa os dados anteriores para depos substituir pelos novos dados
                $('#conteudo').html("");

                /* 
                * Exibe no console informações sobre os usuários cadastrados 
                *  online / ausente / offline, sala em que está
                */

                for (i = 0; i < dadosSalas.usuarios.length; i++) 
                { 
                    console.log(dadosSalas.usuarios[i]);
                }
        
                for (i = 0; i < dadosSalas.sala.length; i++) 
                {   
                    contador = 0;

                    // Conta a quantidade de pessoas em uma determinada sala.
                    for(c = 0; c < dadosSalas.qt_usuarios.length; c++){
                        
                        /*
                        * Faz uma verificação se o nome da sala 
                        * é o mesmo nome que a sala em que o usuário está.
                        */ 

                        if (dadosSalas.sala[i].nm_sala == dadosSalas.qt_usuarios[c].nm_sala) {
                            contador += 1;
                        } 
                    }

                    // Exibe os dados numa div com id de conteudo
                    $('#conteudo').append(
                        "<p> Nome da sala: <b>" + dadosSalas.sala[i].nm_sala + "</b>&nbsp;&nbsp;&nbsp;&nbsp;" + 
                        "Demanda da sala: <b>" + dadosSalas.sala[i].demanda + "</b></p>" + 
                        "<p> Usuários na sala: <b> " + contador +"</b></p>" +
                        "<img src='{{ $url }}" + dadosSalas.sala[i].img_sala + "' width=200>" + "<br>" +
                        "<a href='salas/sala/" + dadosSalas.sala[i].nm_sala + "/" +  
                        <?php if ($_SESSION["santos"]) { echo  "dadosSalas.sala[i].cd_sala_santos"; } 
                        else { echo "dadosSalas.sala[i].cd_sala_sao_paulo"; }  ?>
                        + "'>Entrar na Sala</a>" + "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;" +
                        "<a href='salas/sala/" + dadosSalas.sala[i].nm_sala + 
                        "/excluir/" + dadosSalas.sala[i].cd_sala_santos + "'>Excluir Sala</a>"
                    );
                    
                } // endfor
                setTimeout("atualizarSalas()", 3000) // 3 segundos / Tempo de espera de atualização dos dados
            }) 
        }

        // Quando carregar a página
        $(function () {
            // Faz a primeira atualização
            atualizarSalas();
        });
    </script>

</body>

</html>