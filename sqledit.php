<?php
include ('conexao.php');
session_start();

    $id = $_POST['id'];
    $tituloget = $_POST['titulo'];
    $materialget = $_POST['material'];
    $descget = $_POST['desc'];
    $precoget = floatval($_POST['preco']); 
    $estoqueget = intval($_POST['estoque']);
    $promoget = $_POST['promocao'];
    $promoporcentagemget = intval($_POST['porcentagem']);
    
    echo $id;
    echo $tituloget;
    echo $materialget;
    echo $descget;
    echo $precoget;
    echo $estoqueget;
    echo $promoget;
    echo $promoporcentagemget;
    exit;

    $sql = "update produtosandre set titulo = '$tituloget', descricao = '$desc', material ='$materialget', preco= $precoget, estoque=$estoqueget, promocao='$promoget', promoporcentagem=$promoporcentagemget where id =$id";
    pg_query($conexao, $sql);
    header('Location: adm.php');
    exit;
    
?>


