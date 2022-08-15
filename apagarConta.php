<?php
    session_start();
    include('conexao.php');
    $email = $_SESSION['email'];
    if($email != 'admin@gmail.com')
    {
        header('Location: home.php');
        exit();
    }
    
    $num = $_POST["id"];
    $sql = "delete from usuarioandre where id = {$num}";
    pg_query($conexao, $sql);
    header('Location: adm.php');
    exit;
?>


