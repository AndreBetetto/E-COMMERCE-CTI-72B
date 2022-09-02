<?php
    include('conexao.php');

    $sql="SELECT * FROM produtosandre ORDER BY id";
    
    $resultado= pg_query($conexao, $sql);
    $qtde=pg_num_rows($resultado);

    $resultado_lista = null;

    if ($qtde > 0)
    {
        $resultado_lista=pg_fetch_all($resultado);
    }
 
    pg_close($conexao);
?>