<?php
include('conexao.php');



$buscaProd = $_POST["termoProd"];
if($buscaProd != "" || $buscaProd != " ") {
    $contProd = "SELECT COUNT(*) as total FROM produtosandre";
    $rowProd = pg_fetch_row(pg_query($conexao, $contProd));
    $sql="SELECT * FROM produtosandre ORDER BY id";
    
    $resultado= pg_query($conexao, $sql);
    $qtde=pg_num_rows($resultado);
    $resultado_lista = null;
    if ($qtde > 0)
    {
        $resultado_lista=pg_fetch_all($resultado);
    }
    pg_close($conexao);
    
} else {
    $sqlProd = "select * from produtosandre where CONCAT(id, titulo, material, preco) LIKE '%$buscaProd%' ";
    $queryProd = pg_query($conexao, $sqlProd);
    $qtdeBusca=pg_num_rows($resultado);
    $resultado_lista = null;
    if ($qtdeBusca > 0)
    {
        $resultado_lista=pg_fetch_all($sqlProd);
    }
}


?>
