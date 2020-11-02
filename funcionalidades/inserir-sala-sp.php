<?php 
require "conecta-banco.php";

$nome_sala = $_POST['nome-sala'];

// If isset verifica se o arquivo existe ou não, se existir executa o bloco dentro do if.
if(isset($_FILES['arquivo'])){
    $extensao = strtolower(substr($_FILES['arquivo']['name'], -4));
    $diretorio = "../../img_restaurantes/";

    move_uploaded_file($_FILES['arquivo']['tmp_name'], $diretorio."FotodePerfil".$extensao);

    $comandoSQL = "UPDATE tb_distribuidor SET img_distribuidor='FotodePerfil$extensao' WHERE cd_distribuidor = $codigo_distribuidor";
    $con->query($comandoSQL) or die("algo deu errado");
    $con->close();
}