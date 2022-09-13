<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <link rel=stylesheet type="text/css" href="adm.css">
    <title>Carrinho</title>
</head>
<body>
<?php
    include('conexao.php');
    include('navbar.php');
    session_start();
    $email = $_SESSION['email'];

    $sql = "select * from usuarioandre where login = '$email'";
    $dados = pg_fetch_assoc(pg_query($conexao, $sql)); //id[0] é o id do usuario
    $id = intval($dados['id']);

    if($email == null) {
        header('location: cadasstro.php');
        exit;
    }

    $sqlProd = "select * from carrinhoandre where id_user = $id";
    $queryProd = pg_query($conexao, $sqlProd);
    //$qtdeBusca=pg_fetch_all($resultado);
    $resultado_lista = null;


        $cont = "select count(*) from carrinhoandre where id_user = $id";
        $contagem = pg_fetch_row(pg_query($conexao, $cont));
        ?>
        <br><br><br><br><br>
        <table class="table">
        <tr>
            <th>Titulo</th>
            <th>Quantidade</th>
            <th>Preço</th>
            <th>mini desc</th>
	        <th>remover produto</th>
        </tr>

        
        <?php

        


        for($i = 0; $i < $contagem[0]; $i++)
        {
            $sqlCarrinho = "select * from carrinhoandre where id_user = $id order by id_produto";
            $queryCarrinho = pg_query($conexao, $sqlCarrinho);
            $carrinho = pg_fetch_assoc($queryCarrinho, $i);
            $carrinhoID = intval($carrinho['id_produto']);


            $sqlpega = "select * from produtosandre where id = $carrinhoID order by id";
            $sqlmostra = pg_fetch_assoc(pg_query($conexao, $sqlpega));
            //$resultado_lista=pg_fetch_row($sqlProd);

            //$titulo = $qtdeBusca[$i]['titulo'];
            //$qtd = $qtdeBusca[$i]['quantidade'];
            //$preco = $qtdeBusca[$i]['preco'];

            //$mini_desc = $qtdeBusca[$i]['descricao'];
            //$teste = "remover";
            //$idProd = $resultado_lista['id_prod'];
            //$sqlProd = "select * from produtosandre where id_user = $id";
            //$queryProd = pg_query($conexao, $sqlProd);
            //$resultado_lista[$i]['produto'] = pg_fetch_assoc($queryProd);

            //echo "<tr><td>" . $titulo . "</td><td>" . $qtd . "</td><td>" . $preco . "</td><td>" . $mini_desc . "</td><td>". $teste ."</td></tr>";
            echo "<tr><td>" . $sqlmostra['titulo'] . "</td><td>" . $carrinho['qtd'] . "</td><td>R$ " . Number_format($sqlmostra['preco'], 2, ',','.') . "</td><td>" . substr($sqlmostra['descricao'], 0, 18) . "...</td><td>". " <form method='post' action='menosprodcar.php'>".
            "<button type='submit' name='submit' id='".$carrinhoID."-submit' value ='".$carrinhoID."'> <i class='fa-solid fa-pen-to-square'></i>".
            "</button></form>". 

            "<form method='post' action='maisprodcar.php'> <button type='submit' name='submit' id='".$carrinhoID."-submit' value ='".$carrinhoID."'> <i class='fa-solid fa-pen-to-square'></i>".
            "</button></form>" ."</td></tr>";
        }
        
        
        






        ?>
</body>
</html>
