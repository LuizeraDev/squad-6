<?php 
// Configuração do banco de dados 
$servername = "localhost";
$database = "db_squad6";
$username = "root";
$password = "usbw";

// Cria conexão com o banco de dados passando os valores das variáveis acima
$con = mysqli_connect($servername, $username, $password, $database);

// Esse código faz com que a inserção de acentuação no banco não seja afetada
mysqli_query($con, "set names 'utf8'"); 

// Checa a conexão do banco e retorna um erro se encontrado
if (!$con) {
    die("Connection failed: " . mysqli_connect_error());
}


