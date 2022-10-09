<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <link rel=stylesheet type="text/css" href="carrinho.css">
    <title>Carrinho | KeyFriends</title>
</head>
<body>
<?php
    include('conexao.php');
    include('navMenuFooter.php');
    session_start();
    $email = $_SESSION['email'];

    $sql = "select * from usuarioandre where login = '$email'";
    $dados = pg_fetch_assoc(pg_query($conexao, $sql)); //id[0] é o id do usuario
    $id = intval($dados['id']);
    $_SESSION['id'] = $id;

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
    <div class="titleDB"> <p>Meu carrinho<p> </div>
    <?php 
    for($i = 0; $i < $contagem[0]; $i++)
    {
        $sqlCarrinho = "select * from carrinhoandre where id_user = $id order by id_produto";
        $queryCarrinho = pg_query($conexao, $sqlCarrinho);
        $carrinho = pg_fetch_assoc($queryCarrinho, $i);
        $carrinhoID = intval($carrinho['id_produto']);

        $contador = "select count(*) from carrinhoandre where id_produto = $carrinhoID";
        $numcont = pg_fetch_row(pg_query($conexao, $contador));
        if($numcont == 0) {
            echo "Nenhum produto no carrinho";
        }
        $sqlpega = "select * from produtosandre where id = $carrinhoID order by id";
        $sqlmostra = pg_fetch_assoc(pg_query($conexao, $sqlpega));
    
        $precoTot = $sqlmostra['preco']* $carrinho['qtd'];

        $caminho = $sqlmostra['id'].  $sqlmostra['numberphoto'].'.jpg'; 
        $caminho2 = $sqlmostra['id']. $sqlmostra['numberphoto'].'.png';
        $caminho3 = $sqlmostra['id']. $sqlmostra['numberphoto'].'.jpeg';

        $target  = "produtosimagem/" . $caminho;
        $target2 = "produtosimagem/" . $caminho2;
        $target3 = "produtosimagem/" . $caminho3;

        if(file_exists($target)) {
            $img = "<img src='$target' width='250' height='250'/>";
        } elseif(file_exists($target2)){
             $img = "<img src='$target2' width='250' height='250'/>";
        } elseif(file_exists($target3)){
            $img = "<img src='$target3' width='250' height='250'/>";
        } else {
            $img = "<img src='produtosimagem/default.png' width='250' height='250'/>";
        } 

        

    echo "
    <main class='carrinho'>
        <section class='prod'>
            <div class='itens'>
                <div class='imgTitulo'>". $img ."
                    
                    <div class='titulo'> 
                        <label id='title'>". $sqlmostra['titulo'] ."</label>
                        <div class='alter'>
                                <form method='post' action='menosprodcar.php'>
                                    <button class='alterProds' type='submit' name='submit' id='".$carrinhoID."-submit' value ='".$carrinhoID."'> 
                                        <i class='fa-solid fa-minus'></i>
                                    </button>
                                </form>
                                <label class='qtde'>". $carrinho['qtd'] ."  </label>
                                <form method='post' action='maisprodcar.php'> 
                                    <button class='alterProds' type='submit' name='submit' id='".$carrinhoID."-submit' value ='".$carrinhoID."'> 
                                        <i class='fa-solid fa-plus'></i>
                                    </button>
                                </form> 
                        </div> 
                    </div>
                </div>

                <div class='preco'>
                    <label>Preço unitário</label>
                    <div class='val'>
                        <label> R$ ". Number_format($sqlmostra['preco'] * $carrinho['qtd'], 2, ',','.') ."</label>
                    </div>
                </div>
            </div>
            
        </section>";
    } 
        ?>
        
    
        <section class='list'>
            <div class="resumo">
                <span class="subtitulo">Resumo da compra</span>
                <div class="menuResumo"> 
                    <div class="menuItens">
                    <?php
                    $cont = "select count(*) from carrinhoandre where id_user = $id";
                    $contagem = pg_fetch_row(pg_query($conexao, $cont));    
                    

                    for($i = 0; $i < $contagem[0]; $i++)
                    {
                        $sqlCarrinho = "select * from carrinhoandre where id_user = $id order by id_produto";
        $queryCarrinho = pg_query($conexao, $sqlCarrinho);
        $carrinho = pg_fetch_assoc($queryCarrinho, $i);
        $carrinhoID = intval($carrinho['id_produto']);

        $contador = "select count(*) from carrinhoandre where id_produto = $carrinhoID";
        $numcont = pg_fetch_row(pg_query($conexao, $contador));
        if($numcont == 0) {
            echo "Nenhum produto no carrinho";
        }
        $sqlpega = "select * from produtosandre where id = $carrinhoID order by id";
        $sqlmostra = pg_fetch_assoc(pg_query($conexao, $sqlpega));
        $valortotal = $valortotal + ($sqlmostra['preco'] * $carrinho['qtd']);
                        echo "
                        <div class='menuConteudo'>
                            <span>".  $sqlmostra['titulo'].", ".$carrinho['qtd']." quantidadess."."</span>
                            <span> R$ ". Number_format($sqlmostra['preco'] * $carrinho['qtd'], 2, ',','.')  ."</span>
                        </div>
                        </div>";
                    }

                        

                        /*<div class="menuConteudo">
                            <span>Chaveiro 2</span>
                            <span>R$ 6,40</span>
                        </div>

                        <div class="menuConteudo">
                            <span>Chaveiro 1</span>
                            <span>R$ 3,40</span>
                        </div>

                        <div class="menuConteudo">
                            <span>Chaveiro 1</span>
                            <span>R$ 3,40</span>
                        </div>

                        <div class="menuConteudo">
                            <span>Chaveiro 1</span>
                            <span>R$ 3,40</span>
                        </div>*/
                    
                    /*
                    
                    */
                    echo "<div class='menuTotal'> 
                        <span>Total</span>
                        <span>R$ ".  $valortotal * $carrinho['qtd']. "</span>
                    </div>
                </div>
                <a class='addCmp' href='addprodcar.php?id=".$idProd."'> Finalizar compra </a>  
            </div>
        </section>";
        ?>
    </main>

        <br> <br> <br> <br> 
    <table class="table">
        <tr>
            <th>Produto</th>
            <th>Preço unitário</th>
            <th>Quantidade</th>
            <th>Preço total</th>
        </tr>

        <?php
            $valortotal = 0;
        for($i = 0; $i < $contagem[0]; $i++)
        {
            $sqlCarrinho = "select * from carrinhoandre where id_user = $id order by id_produto";
            $queryCarrinho = pg_query($conexao, $sqlCarrinho);
            $carrinho = pg_fetch_assoc($queryCarrinho, $i);
            $carrinhoID = intval($carrinho['id_produto']);

            $contador = "select count(*) from carrinhoandre where id_produto = $carrinhoID";
            $numcont = pg_fetch_row(pg_query($conexao, $contador));
            if($numcont == 0) {
                echo "Nenhum produto no carrinho";
            }
            $sqlpega = "select * from produtosandre where id = $carrinhoID order by id";
            $sqlmostra = pg_fetch_assoc(pg_query($conexao, $sqlpega));
        
            $precoTot = $sqlmostra['preco']* $carrinho['qtd'];
            echo "<tr>
                <td>" . $sqlmostra['titulo'] . "</td>

                <td> R$ ". Number_format($sqlmostra['preco'],2, ',', '.')."</td>
                
                <td>" ." 
                    <div class='alter'>
                        <form method='post' action='menosprodcar.php'>".
                            "<button class='alterProds' type='submit' name='submit' id='".$carrinhoID."-submit' value ='".$carrinhoID."'> 
                                <i class='fa-solid fa-minus'></i>".
                            "</button>
                        </form>". 

                        $carrinho['qtd'] . 
                        
                        "<form method='post' action='maisprodcar.php'> 
                            <button class='alterProds' type='submit' name='submit' id='".$carrinhoID."-submit' value ='".$carrinhoID."'> 
                                <i class='fa-solid fa-plus'></i>".
                            "</button>
                        </form> 
                    </div> 
                </td>
                <td> R$ ". Number_format($precoTot, 2, ',','.') ."</td>
            </tr>";
            $valortotal = $valortotal + ($sqlmostra['preco'] * $carrinho['qtd']);
        }
        echo "<tr><td colspan='4'> Preço total da compra: R$ ". Number_format($valortotal, 2, ',','.') ."</td></tr>";
        ?> 
    </table>

    
</body>
</html>