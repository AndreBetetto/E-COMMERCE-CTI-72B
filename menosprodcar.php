<?php
    include ('conexao.php');
    session_start();
    $id = intval($_POST['submit']);
    $sql = "update carrinhoandre set qtd = qtd - 1 where id_prod = $id";
    pg_query($conexao, $sql);
    header('location: carrinho.php');
    exit;
?>
