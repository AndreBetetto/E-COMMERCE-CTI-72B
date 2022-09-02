<?php
    include "../utils/conexao.php"; 

    $sql="SELECT * FROM produtoscrud WHERE excluido='n' ORDER BY descricao;";
    
    $resultado= pg_query($conecta, $sql);
    $qtde=pg_num_rows($resultado);

    $resultado_lista = null;

    if ($qtde > 0)
    {
        $resultado_lista=pg_fetch_all($resultado);
    }
 
    pg_close($conecta);
?>