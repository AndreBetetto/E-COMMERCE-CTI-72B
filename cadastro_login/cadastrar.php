<?php
session_start();
include('conexao.php');

$nome = pg_escape_string($conexao, trim($_POST['name']));
$email = pg_escape_string($conexao, trim($_POST['email']));
$senha = pg_escape_string($conexao, trim(md5($_POST['password'])));

$sql = "SELECT COUNT(*) as total FROM usuarioandre WHERE login = '$email'";

$row = pg_fetch_row(pg_query($sql));

if($row[0] == 1){
    $_SESSION['user_existe'] = true;
    header('Location: cadasstro.php');

    /*aparecer erro que usuario ja existe*/

    exit;

} else {
    $sql = "INSERT INTO usuarioandre (login, senha, nome) VALUES ('$email', '$senha', '$nome')";

    pg_query($conexao, $sql);
    /*aparecer mensagem que o usuario foi cadastrado com sucesso*/
}

    
pg_close($conexao);

header('Location: cadasstro.php');
exit;
?>