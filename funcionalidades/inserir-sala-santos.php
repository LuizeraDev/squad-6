<?php 
require "conecta-banco.php";

$nome_sala = $_POST['nome-sala'];

// If isset verifica se o arquivo existe ou não, se existir executa o bloco dentro do if.
if(isset($_FILES['arquivo'])){
    // nesta linha eu estou pegando a extensão do arquivo.
    $extensao = strtolower(substr($_FILES['arquivo']['name'], -4));
    // nesta linha eu estou especificando o diretório. 
    $diretorio = "img-salas-santos/";

    // neste linha eu movo a foto para o diretório e o nome da foto fica como "Fotodosala"
    move_uploaded_file($_FILES['arquivo']['tmp_name'], $diretorio."Fotodasala".$extensao);

    // nesta linha inserimos no banco as informações que já foram faladas
    $comandoSQL = "INSERT INTO tb_sala_santos (nm_sala, img_sala) VALUES  ('Fotodasala${extensao}', '$nome_sala')";
    $con->query($comandoSQL) or die("algo deu errado");
    $con->close();
}