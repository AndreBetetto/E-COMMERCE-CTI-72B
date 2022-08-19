<?php
    session_start();
    include('conexao.php');
    $n = $_POST["apagar"];
    $id = $_SESSION['id'];
    echo $n ."  " . $id;

    $sql = "delete from telefoneandre where qtd = $n and id_user = $id";
    pg_query($conexao, $sql);
    header('Location: perfil.php');
    exit;

?>
