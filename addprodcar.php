<?php
    include('conexao.php');
    session_start();
    $id = $_GET['id'];
    $email = $_SESSION['email'];
    echo $email;
    if($email == null){
        echo "Você precisa estar logado para comprar";
        header('Location: login.php');
        exit;
    }

    $sqlpegaid = "select id from usuarioandre where login = '$email'";
    $id = pg_fetch_row(pg_query($sqlpegaid));
    
    echo $id[0];
    exit;
    
    $sqlverificaqtd = "SELECT * FROM carrinhoandre WHERE id";




    $sql = "insert into carrinhoandre (id_produto, qtd, id_user) values ($id, 1, $email)";









?>
