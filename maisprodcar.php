<?php
    include ('conexao.php');
    session_start();
    $iduser = intval($_SESSION['id']);
    $id = intval($_POST['submit']);
    $sql = "update carrinhoandre set qtd = qtd+ 1 where id_produto = $id and id_user = $iduser";
    pg_query($conexao, $sql);
    header('location: carrinho.php');
    exit;
?>

