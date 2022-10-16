<?php
     $stringdeconexao = "host=pgsql.projetoscti.com.br
                        dbname=projetoscti4
                        user=projetoscti4
                        password=cti123";

    $conexao = pg_connect($stringdeconexao) or die ('Erro, nao foi possivel acessar.');
?>
