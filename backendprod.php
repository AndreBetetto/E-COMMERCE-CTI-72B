<?php
include('conexao.php');
session_start();

//$buscaProd != "" || $buscaProd != " "



if($_SESSION['pesquisado'] == true) {
    $buscaProd = $_SESSION['pesquisa'];
    $contProd = "SELECT COUNT(*) as total FROM produtosandre where CONCAT(id, titulo, material) LIKE '%$buscaProd%'";
    $rowProd = pg_fetch_row(pg_query($conexao, $contProd));
    //$sql="SELECT * FROM produtosandre where CONCAT(id, titulo, material) LIKE '%$buscaProd%' ORDER BY id";
    $sql3="SELECT * FROM produtosandre where CONCAT(id, titulo) LIKE '%andre%' ORDER BY id";

    $resultado = pg_query($conexao, $sql3);
    $qtde=pg_num_rows($resultado);
    $resultado_lista5 = null;
    if ($qtde > 0)
    {
        $resultado_lista=pg_fetch_all($resultado);
    }
    pg_close($conexao);
    
} elseif($_SESSION['pesquisado'] == false) {

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
    /*
    $sqlProd = "select * from produtosandre where CONCAT(id, titulo, material, preco) LIKE '%$buscaProd%' order by id";
    $queryProd = pg_query($conexao, $sqlProd);
    $qtdeBusca=pg_num_rows($resultado);
    $resultado_lista = null;
    if ($qtdeBusca > 0)
    {
        $resultado_lista=pg_fetch_all($sqlProd);
    }*/
}
$_SESSION['buscabool'] = false;

?>
