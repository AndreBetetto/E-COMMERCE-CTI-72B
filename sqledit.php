<?php
include('conexao.php');
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
    
    if($promoget == 'Sim') {
        $boolPromo = 'true';
    } else {
       $boolPromo = 'false';
    }

    $sql = "update produtosandre set titulo = '$tituloget', descricao = '$descget', material ='$materialget', preco= $precoget, estoque=$estoqueget, promocao='$boolPromo', promoporcentagem=$promoporcentagemget where id = $id";
    pg_query($conexao, $sql);
    header('Location: adm.php');
    exit;
    
?>


