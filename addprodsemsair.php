<?php
include('conexao.php');
session_start();


    $idget = $_GET['id'];
    $idget2 = $_SERVER['REQUEST_URI'];
    $idprod2 = intval(substr($idget2, -4));
    $idprod = substr($idget, -4); // id do produto


    $email = $_SESSION['email'];
    // echo $email;

    if($email == null){
        echo "Você precisa estar logado para comprar";
        header('Location: login.php');
        exit;
    }


    $sqlpegaid = "select id from usuarioandre where login = '$email'";
    $id = pg_fetch_row(pg_query($sqlpegaid)); //id[0] é o id do usuario

    $sqlverificaqtd = "SELECT qtd FROM carrinhoandre WHERE id_user = $id[0] and id_produto = $idprod2";
    $rowverifica = pg_fetch_row(pg_query($conexao, $sqlverificaqtd));

    if($rowverifica[0] != 0) {
        $sqlupdate = "UPDATE carrinhoandre SET qtd = qtd + 1 WHERE id_user = $id[0] and id_produto = $idprod2";
        $resultupdate = pg_query($sqlupdate);
        echo "Produto adicionado ao carrinho";
        $_SESSION['adicionado'] = true;
    } else {
        $sqlinsert = "INSERT INTO carrinhoandre (id_user, id_produto, qtd) VALUES ($id[0], $idprod2, 1)";
        $resultinsert = pg_query($sqlinsert);
        echo "Produto adicionado ao carrinho";
        $_SESSION['adicionado'] = true;
    }
        header('Location: produtos.php');
        exit;
?>
