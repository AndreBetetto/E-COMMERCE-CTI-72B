<?php
    include('conexao.php');
    session_start();
    $idget = $_GET['id'];

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
    
    $sqlverificaqtd = "SELECT qtd FROM carrinhoandre WHERE id_user = $id[0] and id_produto = $idprod";
    $rowverifica = pg_fetch_row(pg_query($conexao, $sqlverificaqtd));

    if($rowverifica[0] != 0) {
        $sqlupdate = "UPDATE carrinhoandre SET qtd = qtd + 1 WHERE id_user = $id[0] and id_produto = $idprod";
        $resultupdate = pg_query($sqlupdate);
        echo "Produto adicionado ao carrinho";
        //header('Location: carrinho.php');
        //exit;
    } else {
        $sqlinsert = "INSERT INTO carrinhoandre (id_user, id_produto, qtd) VALUES ($id[0], $idprod, 1)";
        $resultinsert = pg_query($sqlinsert);
        echo "Produto adicionado ao carrinho";
        //header('Location: carrinho.php');
        //exit;
    }
    
    //$sql = "insert into carrinhoandre (id_produto, qtd, id_user) values ($idprod, 1, $id[0])";

?>
