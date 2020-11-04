<?php

if ($_SESSION['logado'] != true) {
    echo "<script>alert('Você precisa fazer login para acessar o sistema.');</script>";
    echo "<script>window.location.href='../paginas/login.php';</script>";
}