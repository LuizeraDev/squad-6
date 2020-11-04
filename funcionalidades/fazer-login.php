<meta charset="UTF-8">
<?php
require("../funcionalidades/conecta-banco.php");
session_start();

$usuario = $_POST['usuario'];
$senha = $_POST['senha'];

// Verifica se usuário e senha existem e são iguais aos que foram informados
$comandoSQL = "SELECT nm_usuario, cd_senha from tb_usuario WHERE nm_usuario = '$usuario' AND cd_senha = '$senha'";
$resultado = mysqli_query($con, $comandoSQL);
$quantidade = mysqli_num_rows($resultado);

// Permite login
if ($quantidade === 1) {
    // Pegamos o código do usuário 
    $comandoSQL = "SELECT cd_usuario from tb_usuario WHERE nm_usuario = '$usuario' AND cd_senha = '$senha'";
    $resultado = mysqli_query($con, $comandoSQL);
    $codigo = mysqli_fetch_array($resultado);

    $_SESSION['codigo_usuario'] = $codigo[0];
    $_SESSION['logado'] = true;
    header("Location: ../salas/unidade.php");
} else {
    echo "<script>alert('Nome ou senha, não conferem com nossos registros.');</script>";
    echo "<script>window.location.href='../paginas/login.php';</script>";
}