<meta charset="UTF-8">
<?php
require("../funcionalidades/conecta-banco.php");
session_start();

$usuario = $_POST['usuario'];
$senha = $_POST['senha'];

$comandoSQL = "SELECT nm_usuario from tb_usuario WHERE nm_usuario = '$usuario'";
$resultado = mysqli_query($con, $comandoSQL);
$quantidade = mysqli_num_rows($resultado);

// Verifica se usuário já existe
if ($quantidade) {
    echo "<script>alert('Usuário já cadastrado no sistema');</script>";
    echo "<script>window.location.href='../paginas/cadastro.php';</script>";
} else {
    $comandoSQL = "INSERT INTO tb_usuario (nm_usuario, cd_senha) VALUES ('$usuario', '$senha')";
    $res = $con->query($comandoSQL);
    $con->close();
    $_SESSION['logado'] = true;
    header("Location: ../salas/unidade.php");
}