<?php
    session_start();
    include ('conexao.php');
    $idget = $_GET['id'];

    $idprod = substr($idget, -4); // id do produto
    $email = $_SESSION['email'];

?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <script src="https://kit.fontawesome.com/60a756ccae.js" crossorigin="anonymous"></script>
    <link rel=stylesheet type="text/css" href="detalhes.css">
    <title>Home | KeyFriends</title>
    <link rel="icon" href="logoAzul.png">

</head>
<body>
    <div class="main">
        <?php
            include('navMenuFooter.php')
        ?>
        <?php
            $sql = "SELECT * FROM produtosandre WHERE id = $idprod";
            $result =pg_query($conexao, $sql);

            $row = pg_fetch_assoc($result);
            $idProd = $row['id'];
            $tituloProd = $row['titulo'];
            $descricaoProd = $row['descricao'];
            $material = $row['material'];
            $precoProd = $row['preco'];
            $estoque = $row['estoque'];
        ?>


        <div class="titulo">
            <h3> <?php echo $tituloProd ?></h3>
        </div>

        <div class="detalhes">

            <div class="imagem">

            <?php
            function golink($idprod, $num){
                $idprod = $idprod;
                if($num == 4){
                    $num = 1;
                } else {
                    $num++;
                }

            }
                $num = 1;

                    $caminho =  $idProd. '.jpg';
                    $caminho2 = $idProd. '.png';
                    $caminho3 = $idProd. '.jpeg';

                    $target  = "produtosimagem/" . $caminho;
                    $target2 = "produtosimagem/" . $caminho2;
                    $target3 = "produtosimagem/" . $caminho3;


                    if(file_exists($target)) {
                        $img = "<img src='$target' width='400' height='400'/>";
                    } elseif(file_exists($target2)){
                        $img = "<img src='$target2' width='400' height='400'/>";
                    } elseif(file_exists($target3)){
                        $img = "<img src='$target3' width='400' height='400'/>";
                    } else {
                        $img = "<img src='produtosimagem/default.png' width='400' height='400'/>";
                    }

                ?>

                <?php echo $img ?>

                <br>

            </div>

            <div class="itens">
                <div>
                    <label class="campos">
                        <b>ID do produto:</b> <?php echo $idProd ?>
                    </label>
                </div>

                <div>
                    <label class="campos">
                        <?php echo $tituloProd ?>
                    </label>
                </div>

                <div>
                    <label class="campos">
                        <?php echo $descricaoProd ?>
                    </label>
                </div>

                <!-- <div>
                    <label class="campos">
                        <?php //echo $material ?>
                    </label>
                </div> -->

                <div>
                    <label class="campos">
                        <?php
                            if(strval($estoque) <= 0)  {
                                echo "Produto indisponível<br>";
                                echo "<a href='#'>Avise-me quando chegar</a>";
                            }else {
                                echo $estoque." produtos em estoque";
                            }
                        ?>
                    </label>
                </div>

                <div>
                    <label class="campos">
                        <?php echo "<label class='preco'> R$ ".Number_format($precoProd, 2, ',','.')."</label>" ?>
                    </label>
                </div>

                <div class="estrelas">
                    <i class="fa-solid fa-star"></i>
                    <i class="fa-solid fa-star"></i>
                    <i class="fa-solid fa-star"></i>
                    <i class="fa-solid fa-star"></i>
                    <i class="fa-solid fa-star"></i>
                </div>

                <div class="botoes">
                    <div class="btn">
                        <a class="addCar" href='addprodcar.php?id=<?php echo $idProd?>'>
                            <i class="fa-solid fa-basket-shopping"></i> Adicionar ao carrinho
                        </a>
                    </div>

                    <div class="btn">
                        <a class="addCmp" href='addprodcar.php?id=<?php echo $idProd?>'> Comprar </a>
                    </div>
                </div>

            </div>
        </div>

    </div>
</body>
</html>
