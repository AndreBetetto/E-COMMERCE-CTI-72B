<?php
include('conexao.php');
session_start();

    $id = $_POST['id'];
    $tituloget = $_POST['titulo'];
    $materialget = $_POST['material'];
    $descget = $_POST['desc'];
    $precoget = floatval($_POST['preco']); 
    $estoqueget = intval($_POST['estoque']);
    
    echo $id;
    echo $tituloget;
    echo $materialget;
    echo $descget;
    echo $precoget;
    echo $estoqueget;
    
    if($promoget == 'Sim') {
        $boolPromo = 'true';
    } else {
       $boolPromo = 'false';
    }

    $sql = "update produtosandre set titulo = '$tituloget', descricao = '$descget', material ='$materialget', preco= $precoget, estoque=$estoqueget where id = $id";
    pg_query($conexao, $sql);
    header('Location: admProdutos.php');
    exit;
    
?>


