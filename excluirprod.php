<?php
    include('conexao.php');
    session_start();

    $idget = $_POST['id'];
    echo $idget;
    $sql = "delete from produtosandre where id = $idget";
    pg_query($conexao, $sql);
    header('admProdutos.php');
    exit;
?>