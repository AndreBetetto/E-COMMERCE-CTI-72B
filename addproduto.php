<?php
include('conexao.php');
session_start();
$email = $_SESSION['email'];
if($email != 'admin@gmail.com'){
    header('Location: logout.php');
    exit;
} else {
    $titulo = pg_escape_string($conexao, ($_POST['titulo']));
    $titulo = pg_escape_string($conexao, ($_POST['desc']));
    $titulo = pg_escape_string($conexao, ($_POST['titulo']));







}




?>