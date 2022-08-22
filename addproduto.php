<?php
include('conexao.php');
session_start();
$email = $_SESSION['email'];
if($email != 'admin@gmail.com'){
    header('Location: logout.php');
    exit;
} else {
    $titulo = $_POST['titulo'];
    $descricao = $_POST['desc'];
    $material= $_POST['material'];
    $preco = floatval($_POST['preco']); 
    $estoque= intval($_POST['estoque']);
    $promocao = $_POST['promocao'];
    $porcentagem = intval($_POST['porcentagem']);

    if($promocao == 'sim') {
        $boolPromo = true;
    } else {
       $boolPromo = false;
    }

    echo $titulo . " - " . $descricao . " - " . $preco . " - " . $estoque . " - " . $promocao . " - " . $porcentagem;

    $sql = "insert into produtosandre (titulo, descricao, material, preco, estoque, promocao, promoporcentagem) values ('$titulo', '$descricao', '$material', $preco, $estoque, '$boolPromo', $porcentagem)";
    pg_query($conexao, $sql);
    header('Location: adm.php');
    exit;
}


?>