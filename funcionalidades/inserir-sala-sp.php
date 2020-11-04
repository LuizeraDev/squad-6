<meta charset="UTF-8">
<?php 
require "conecta-banco.php";

$nome_sala = $_POST['nome-sala'];

$comandoSQL = "SELECT nm_sala from tb_sala_sao_paulo WHERE nm_sala = '$nome_sala'";
$resultado = mysqli_query($con, $comandoSQL);
$quantidade = mysqli_num_rows($resultado);

if ($quantidade == 1) {
    echo "<script>alert('Uma sala com este nome já existe.');</script>";
    echo "<script>window.location.href='../salas/criar-sala-sao_paulo.php';</script>";
} else {
    // nesta linha inserimos no banco as informações que já foram faladas
    $comandoSQL = "INSERT INTO tb_sala_sao_paulo (nm_sala) VALUES  ('$nome_sala')";
    $con->query($comandoSQL);

    //verifica se a pasta existe, se não existir cria uma.
    $pasta = "img-salas-sao-paulo";
    if (!file_exists($pasta))
     mkdir($pasta, 0777);

    // caminho da pasta
    $dir = "img-salas-sao-paulo/".$nome_sala;
    // cria uma pasta no caminho especificado acima
    mkdir($dir, 0777);

    // If isset verifica se o arquivo existe ou não, se existir executa o bloco dentro do if.
    if (isset($_FILES['arquivo'])) {
        // nesta linha eu estou pegando a extensão do arquivo.
        $extensao = strtolower(substr($_FILES['arquivo']['name'], -4));

        if ($extensao == ".jpg" || $extensao == ".png" || $extensao == ".jpeg") {
            // nesta linha eu estou especificando o diretório. 
            $diretorio = "img-salas-sao-paulo/". $nome_sala ."/";

            // nesta linha eu movo a foto para o diretório e o nome da foto fica como "Fotodosala"
            move_uploaded_file($_FILES['arquivo']['tmp_name'], $diretorio ."Fotodasala". $extensao);

            $comandoSQL = "UPDATE tb_sala_sao_paulo SET img_sala='Fotodasala$extensao' WHERE nm_sala = '$nome_sala'";
            $con->query($comandoSQL) or die("Deu erro aqui");

            header("Location: ../salas/saopaulo.php");
        } else {
            echo "<script> alert('Formato de arquivo não aceito.'); </script>";
            echo "<script> window.location.href='../salas/criar-salas-sao-paulo.php'; </script>";
        }
    }
}
$con->close();




