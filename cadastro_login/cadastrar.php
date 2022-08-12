<?php
session_start();
include('conexao.php');

$nome = pg_escape_string(trim($_POST['name']));
$email = pg_escape_string(trim($_POST['email']));
$senha = pg_escape_string(trim(md5($_POST['password'])));

$sql = "select count(*) as total from usuarioandre where login = '$email'";
$result = pg_query($conexao, $sql);
$row = pg_fetch_assoc($result);

if($row['total'] == 1){
    $_SESSION['user_existe'] = true;
    header('Location: cadasstro.php');
    exit;
}

$sql = "INSERT INTO usuarioandre (login, senha, nome) VALUES ('$email', '$senha', '$nome')";

if($conexao->pg_query($sql) === TRUE) {
    $_SESSION['status_cadastro'] = true;  
}

$conexao->close();

header('Location: cadasstro.php');
exit;
?>