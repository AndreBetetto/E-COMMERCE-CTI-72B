<?php
    session_start();
    include('conexao.php');
    $email = $_SESSION['email'];
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <script src="https://kit.fontawesome.com/60a756ccae.js" crossorigin="anonymous"></script>
    <link rel=stylesheet type="text/css" href="home.css">
    <title>PRODUTOS | KeyFriends</title>
</head>
<body>
    <?php include('navbar.php')?>
    
    <form action="" method="GET">
            <label>Busque por um produto: <input type="text" name="termoProd" required value="<?php if(isset($_GET['termoProd'])){echo $_GET['termoProd'];}?>"> </label>
            <input name="submit" type="Submit" value="buscar">
            <button onclick="location.href='produtos.php'" type="button">Limpar</button>
        </form>

        <table border="2">
        <tr>
            <th>Id</th>
            <th>Titulo</th>
            <th>Material</th>
            <th>Preço</th>
            <th>Estoque</th>
            <th>Promoção</th>
            <th>Porcentagem Promo </th> 
        </tr>
    <?php
    
            if(isset($_GET['termoProd'])) {
                $buscaProd = $_GET["termoProd"];
                $sqlProd = "select * from produtosandre where CONCAT(id, titulo, material, preco) LIKE '%$buscaProd%' ";
                $sqlProdID = "select id from produtosandre where CONCAT(id, titulo, material, preco) LIKE '%$buscaProd%' ";
                $queryProd = pg_query($conexao, $sqlProd);

                if(pg_num_rows($queryProd) > 0):
                    for($i = 1000; $i <= pg_num_rows($queryProd)+999; $i++):
                        $idprodPG = pg_fetch_row(pg_query($conexao, $sqlProdID), $i-1000);
                        $idprod = intval($idprodPG[0]);
                        $sqlTitulo2Prod = "select titulo from produtosandre where id = {$idprod}";
                        $sqlMaterial2Prod = "select material from produtosandre where id = {$idprod}";
                        $sqlPreco2Prod = "select preco from produtosandre where id = {$idprod}";

                        $sqlEstoque2Prod = "Select estoque from produtosandre where id = {$idprod}";
                        $sqlPromocao2Prod = "Select promocao from produtosandre where id = {$idprod}";
                        $sqlPromoporcentagem2Prod = "Select promoporcentagem from produtosandre where id = {$idprod}";

                        $mostraTitulo2Prod = pg_fetch_row(pg_query($conexao, $sqlTitulo2Prod));
                        $mostraMaterial2Prod = pg_fetch_row(pg_query($conexao, $sqlMaterial2Prod));
                        $mostraPreco2Prod = pg_fetch_row(pg_query($conexao, $sqlPreco2Prod));

                        $mostraEstoque2Prod = pg_fetch_row(pg_query($conexao, $sqlEstoque2Prod));
                        $mostraPromocao2Prod = pg_fetch_row(pg_query($conexao, $sqlPromocao2Prod));
                        $mostraPromoporcentagem2Prod = pg_fetch_row(pg_query($conexao, $sqlPromoporcentagem2Prod));

                        echo "<tr><td>" . $idprod . "</td><td>" .$mostraTitulo2Prod[0] . "</td><td>" . $mostraMaterial2Prod[0] . "</td><td>" . $mostraPreco2Prod[0] . "</td><td>" . $mostraEstoque2Prod[0] . "</td><td>" . $mostraPromocao2Prod[0] . "</td><td>" . $mostraPromoporcentagem2Prod[0]; ?></td></tr> 
                        <?php endfor; endif;
                    

                if(pg_num_rows($queryProd) <= 0)  {
                    echo "<tr><td colspan=4>" . "No Record Found" . "</td> </tr>";
                
                }
            } else {

		$contProd = "SELECT COUNT(*) as total FROM produtosandre";
                $rowProd = pg_fetch_row(pg_query($conexao, $contProd));
                for($i = 1001; $i <= $rowProd[0]+1000; $i++):
                    $sqlIDProd = "Select id from produtosandre where id = {$i}";
                    $sqlTituloProd = "Select titulo from produtosandre where id = {$i}";
                    $sqlMaterialProd = "Select material from produtosandre where id = {$i}";
                    $sqlPrecoProd = "Select preco from produtosandre where id = {$i}";

                    $sqlEstoqueProd = "Select estoque from produtosandre where id = {$i}";
                    $sqlPromocaoProd = "Select promocao from produtosandre where id = {$i}";
                    $sqlPromoporcentagemProd = "Select promoporcentagem from produtosandre where id = {$i}";

                    $mostraIDProd = pg_fetch_row(pg_query($conexao, $sqlIDProd));
                    $mostraTituloProd = pg_fetch_row(pg_query($conexao, $sqlTituloProd));
                    $mostraMaterialProd = pg_fetch_row(pg_query($conexao, $sqlMaterialProd));
                    $mostraPrecoProd = pg_fetch_row(pg_query($conexao, $sqlPrecoProd));

                    $mostraEstoqueProd = pg_fetch_row(pg_query($conexao, $sqlEstoqueProd));
                    $mostraPromocaoProd = pg_fetch_row(pg_query($conexao, $sqlPromocaoProd));
                    $mostraPromoporcentagemProd = pg_fetch_row(pg_query($conexao, $sqlPromoporcentagemProd));


                    echo "<tr><td>" . $mostraIDProd[0] . "</td><td>" . $mostraTituloProd[0] . "</td><td>" . $mostraMaterialProd[0] . "</td><td>" . $mostraPrecoProd[0] . "</td><td>" . $mostraEstoqueProd[0] . "</td><td>" . $mostraPromocaoProd[0] . "</td><td>" . $mostraPromoporcentagemProd[0]; ?>  </td><td></tr>
                    <?php endfor; ?> <?php
                } 
            
            echo "</table>";
            ?>
    </table>
    <footer>

    </footer>
</body>
</html>