<?php
    include('conexao.php');
    $sqlProd = "select * from carrinhoandre where id_user =  ";
    $queryProd = pg_query($conexao, $sqlProd);
    $qtdeBusca=pg_num_rows($resultado);
    $resultado_lista = null;
    if ($qtdeBusca > 0)
    {
        $resultado_lista=pg_fetch_all($sqlProd);
    }



?>