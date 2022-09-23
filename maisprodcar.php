<?php
    include ('conexao.php');
    session_start();
    $iduser = intval($_SESSION['id']);
    $id = intval($_POST['submit']);
    $verifica = "select estoque from produtosandre where id = $id";
    $resultverifica = pg_query($conexao, $verifica);
    $rowverifica = pg_fetch_row($resultverifica);
    $sql = "SELECT qtd FROM carrinhoandre WHERE id_user = $iduser AND id_produto = $id";
    $result = pg_query($conexao, $sql);
    $row = pg_fetch_row($result);

    if($row[0] >= $rowverifica[0]) {
        echo "Não há mais estoque deste produto.";
        $_SESSION['estoqueerro'] = true;
        header('location: carrinho.php');
        exit;
    } else {
        $sqlupdate = "UPDATE carrinhoandre SET qtd = qtd + 1 WHERE id_user = $iduser AND id_produto = $id";
        $resultupdate = pg_query($conexao, $sqlupdate);
        echo "Produto adicionado ao carrinho";
        $_SESSION['estoqueerro'] = false;
        header('location: carrinho.php');
        exit;
    }
    //$sql = "update carrinhoandre set qtd = qtd+ 1 where id_produto = $id and id_user = $iduser";
    //pg_query($conexao, $sql);
    //header('location: carrinho.php');
    //exit;
?>

