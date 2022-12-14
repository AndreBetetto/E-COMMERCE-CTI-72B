<!DOCTYPE html>
<html lang="pt-br">
<head>
    <?php include "head.php" ?>
    <link rel=stylesheet type="text/css" href="carrinho.css">
    <title>Carrinho | KeyFriends</title>
</head>
<body>
    <!--Navigation bar-->
    <div id="nav-placeholder">
    </div>
    <script>
        $(function(){
        $("#nav-placeholder").load("nav.php");
        });
    </script>
    <script src="menu.js"></script>
    <!--end of Navigation bar-->
<?php
    include('conexao.php');
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
        if($contagem[0] == 0) {
            echo
            "<div class='vazio'>
                <span class='text'>Seu carrinho está vazio!!</span>
                <i class='fa-solid fa-face-frown fa-5x'></i>
                <a id='buton' href='produtos.php'> Confira nossos produtos </a>
            </div>";
        }
        else {
            echo "
            <div class='titleDB'> <p>Meu carrinho<p> </div>
            <div class='carrinho'>";

            echo "<div class='prod'>";
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
                        $img = "<img id='img' src='$target' width='150' height='150'/>";
                    } elseif(file_exists($target2)){
                        $img = "<img id='img' src='$target2' width='150' height='150'/>";
                    } elseif(file_exists($target3)){
                        $img = "<img id='img' src='$target3' width='150' height='150'/>";
                    } else {
                        $img = "<img id='img' src='produtosimagem/default.png' width='150' height='150'/>";
                    }

                    echo "

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
                                    <label> R$ ". Number_format($sqlmostra['preco'], 2, ',','.') ."</label>
                                </div>
                            </div>
                        </div>
                    ";
                }

                echo "</div>";?>

                    <div class='list'>
                        <span class="subtitulo">Resumo da compra</span>
                        <div class="resumo">
                            <div class="menuResumo">
                                <div class="menuItens">
                                    <?php
                                    if($_SESSION['estoqueerro'] == true){
                                        echo "<script>alert('Estoque insuficiente!')</script>";
                                        $_SESSION['estoqueerro'] = false;
                                    }
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
                                                    <span>".  $sqlmostra['titulo']."</span>
                                                    <span> R$ ". Number_format($sqlmostra['preco'] * $carrinho['qtd'], 2, ',','.')  ."</span>
                                                </div>";
                                            $tempid = strval($carrinhoID);
                                            $carrinhoid = $carrinhoid . $tempid . ",";

                                            $tempqtd = strval($carrinho['qtd']);
                                            if($tempqtd <10) {
                                                $tempqtd = "0" . $tempqtd;
                                            }
                                            if($tempqtd <100) {
                                                $tempqtd = "0" . $tempqtd;
                                            }

                                            $carrinhoqtd = $carrinhoqtd . $tempqtd . ",";

                                            $temppu = strval($sqlmostra['preco']);
                                            $temppu =  number_format($temppu, 2, ',','');

                                            if($temppu <10){
                                                $temppu = "0" . $temppu;
                                            }
                                            if($temppu <100){
                                                $temppu = "0" . $temppu;
                                            }
                                            if($temppu < 1000){
                                                $temppu = "0" . $temppu;
                                            }
                                            if($temppu < 10000){
                                                $temppu = "0" . $temppu;
                                            }
                                            if($temppu < 100000){
                                                $temppu = "0" . $temppu;
                                            }
                                            if($temppu < 1000000){
                                                $temppu = "0" . $temppu;
                                            }
                                            if($temppu < 10000000){
                                                $temppu = "0" . $temppu;
                                            }
                                            if($temppu < 100000000){
                                                $temppu = "0" . $temppu;
                                            }
                                            if($temppu < 1000000000){
                                                $temppu = "0" . $temppu;
                                            }
                                            $carrinhopu = $carrinhopu . $temppu . "#";
                                        } }
                                        $_SESSION['carrinhoids'] = $carrinhoid;
                                        $_SESSION['carrinhoqtds'] = $carrinhoqtd;
                                        $_SESSION['carrinhopu'] = $carrinhopu;
                                    ?>
                                </div>

                                <?php
                                if($contagem[0] != 0){

                                echo
                                    "<div class='menuTotal'>
                                            <span>Total</span>
                                            <span>R$ ".  $valortotal."</span>
                                    </div>"; }?>


                            </div>
                        </div>

                        <div class="btns">
                            <?php
                                if($contagem[0] != 0):?>
                            <a class='addCmp' href='finaliza.php'> Finalizar compra </a>
                            <a class='contC' href='produtos.php'> Continuar comprando </a>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
</body>
</html>