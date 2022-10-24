<?php
    session_start();
    include('conexao.php');
    $nome = $_POST['nome'];
    $qtd = $_POST['saida'];
    $tipo = $_POST['tipo'];

    $sqltipo = "update produtosandre set estoque = estoque - $qtd where id = $tipo";
    pg_query($conexao,  $sqltipo);

    $sqlinsert = "insert into vendarapidaandre (descricao, data, saida) values ('$nome', current_date, $qtd)";
    pg_query($conexao, $sqlinsert);
    header('Location: addcompra.php');
    exit;
    ?>