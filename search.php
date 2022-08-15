<?php
    session_start();
    include('conexao.php');
    $email = $_SESSION['email'];
    if($email != 'admin@gmail.com')
    {
        header('Location: home.php');
        exit();
    }
    
    $busca = $_POST["termo"];
    $sql = "select * from usuarioandre where CONCAT(id, nome, login) LIKE '%{$busca}%'";
    $_SESSION['buscarAtivo'] = true;
    $_SESSION['buscar'] = "select id from usuarioandre where CONCAT(id, nome, login) LIKE '%{$busca}%'";
    $_SESSION['buscarContador'] = "SELECT COUNT(*) as total FROM usuarioandre where concat(nome, login) like '%{$busca}%'";

    pg_query($conexao, $sql);
    header('Location: adm.php');
    exit;
?>


