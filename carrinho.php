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
    <div class="carrinho">
        <div class="itens">
            <div>
                <label>Chaveiro</label>
                <div class='alter'>
                        <form method='post' action='menosprodcar.php'>
                            <button class='alterProds' type='submit' name='submit' id='1' value ='1'> 
                                <i class='fa-solid fa-minus'></i>
                            </button>
                        </form>

                        5
                        
                        <form method='post' action='maisprodcar.php'> 
                            <button class='alterProds' type='submit' name='submit' id='1' value ='1'> 
                                <i class='fa-solid fa-plus'></i>
                            </button>
                        </form> 
                    </div> 
            </div>

            <div class="preco">
                <label>Preço unitário </label>
                <div>
                    <label> R$ 3,40</label>
                </div>
            </div>
        </div>

        <div class="resumo">

        </div>
    </div>

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

    <div class="btn">
        <a class="addCmp" href='addprodcar.php?id=<?php echo $idProd?>'> Continuar compra </a>  
    </div>
</body>
</html>