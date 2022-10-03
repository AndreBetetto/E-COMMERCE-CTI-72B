<?php
    include ('conexao.php');
    session_start();
    $iduser = intval($_SESSION['id']);
    $id = intval($_POST['submit']);
    $sql = "SELECT qtd FROM carrinhoandre WHERE id_user = $iduser AND id_produto = $id";
    $result = pg_query($conexao, $sql);
    $row = pg_fetch_row($result);
    if($row[0] > 1) {
        $sqlupdate = "UPDATE carrinhoandre SET qtd = qtd - 1 WHERE id_user = $iduser AND id_produto = $id";
        $resultupdate = pg_query($conexao, $sqlupdate);
        $_SESSION['estoqueerro'] = false;
        echo "Produto adicionado ao carrinho";
        header('location: carrinho.php');
        exit;
    } else {
        $sqlinsert = "delete from carrinhoandre where id_user = $iduser and id_produto = $id";
        $resultinsert = pg_query($conexao, $sqlinsert);
        echo "Produto adicionado ao carrinho";
        $_SESSION['estoqueerro'] = false;
        header('location: carrinho.php');
        exit;
        
    }
?>
