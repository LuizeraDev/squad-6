<?php 
require "conecta-banco.php";

$nome_sala = $_POST['nome-sala'];

// nesta linha inserimos no banco as informações que já foram faladas
$comandoSQL = "INSERT INTO tb_sala_sao_paulo (nm_sala) VALUES  ('$nome_sala')";
$con->query($comandoSQL) or die("algo deu errado");

// seleciona código da sala criada
$comandoSQL = "SELECT cd_sala_sao_paulo from tb_sala_sao_paulo WHERE nm_sala='$nome_sala'";
$resultado_usuario = mysqli_query($con, $comandoSQL) or die("Erro no banco de dados!");
$codigo = mysqli_fetch_array($resultado_usuario);

//verifica se a pasta existe, se não existir cria uma.
$pasta = "img-salas-sao-paulo";
if(!file_exists($pasta))
   mkdir($pasta, 0777);

// caminho da pasta
$dir = "img-salas-sao-paulo/".$codigo[0];

// cria uma pasta no caminho especificado acima
mkdir($dir, 0777);

// If isset verifica se o arquivo existe ou não, se existir executa o bloco dentro do if.
if(isset($_FILES['arquivo'])){
    // nesta linha eu estou pegando a extensão do arquivo.
    $extensao = strtolower(substr($_FILES['arquivo']['name'], -4));

    if($extensao == ".jpg" || $extensao == ".png" || $extensao == ".jpeg"):
        // nesta linha eu estou especificando o diretório. 
        $diretorio = "img-salas-sao-paulo/".$codigo[0]."/";

        // nesta linha eu movo a foto para o diretório e o nome da foto fica como "Fotodosala"
        move_uploaded_file($_FILES['arquivo']['tmp_name'], $diretorio."Fotodasala".$extensao);

        // nesta linha eu atualizo a tabela do banco colocando o nome da foto junto com sua extensão
        $comandoSQL = "UPDATE tb_sala_sao_paulo SET img_sala='Fotodasala$extensao' WHERE cd_sala_sao_paulo = $codigo[0]";
        $con->query($comandoSQL) or die("algo deu errado");

        header("Location: ../salas/saopaulo.php");
    else:
        // se o formato de arquivo for diferente de jpg, png ou jpeg ele é redirecionado
        echo
        "<script>
        alert('Formato de arquivo não aceito.');
        window.location.href='../salas/criar-salas-sao-paulo.php';
        </script>";
    endif;
    $con->close();
}