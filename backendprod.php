<?php
include('conexao.php');
    $array = array();
    if(isset($_POST['termoProd'])) {
        $buscaProd = $_POST["termoProd"];
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
                
                    $array[$i][0] = $mostraTitulo2Prod;
                    $array[$i][1] = $mostraMaterial2Prod;
                    $array[$i][2] = $mostraPreco2Prod;
                    $array[$i][3] = $mostraEstoque2Prod;
                    $array[$i][4] = $mostraPromocao2Prod;
                    $array[$i][5] = $mostraPromoporcentagem2Prod;
                

                echo "<tr><td>" . $idprod . "</td><td>" .$mostraTitulo2Prod[0] . "</td><td>" . $mostraMaterial2Prod[0] . "</td><td>" . $mostraPreco2Prod[0] . "</td><td>" . $mostraEstoque2Prod[0] . "</td><td>" . $mostraPromocao2Prod[0] . "</td><td>" . $mostraPromoporcentagem2Prod[0]; ?></td></tr> 
                <?php endfor; endif;
            

        if(pg_num_rows($queryProd) <= 0)  {
            echo "<tr><td colspan=4>" . "No Record Found" . "</td> </tr>";
        
        }
    } else {


    $contProd = "SELECT COUNT(*) as total FROM produtosandre";
    $rowProd = pg_fetch_row(pg_query($conexao, $contProd));
    for($i = 1001; $i <= $rowProd[0]+1000; $i++){
        $sqlIDProd = "Select id from produtosandre where id = {$i}";
        $sqlTituloProd = "Select titulo from produtosandre where id = {$i}";
        $sqlMaterialProd = "Select material from produtosandre where id = {$i}";
        $sqlPrecoProd = "Select preco from produtosandre where id = {$i}";
        
        $sqlEstoqueProd = "Select estoque from produtosandre where id = {$i}";
        $sqlPromocaoProd = "Select promocao from produtosandre where id = {$i}";
        $sqlPromoporcentagemProd = "Select promoporcentagem from produtosandre where id = {$i}";
        $contProd = "SELECT COUNT(*) as total FROM produtosandre";
        $mostraIDProd = pg_fetch_row(pg_query($conexao, $sqlIDProd));
        $mostraTituloProd = pg_fetch_row(pg_query($conexao, $sqlTituloProd));
        $mostraMaterialProd = pg_fetch_row(pg_query($conexao, $sqlMaterialProd));
        $mostraPrecoProd = pg_fetch_row(pg_query($conexao, $sqlPrecoProd));
        
        $mostraEstoqueProd = pg_fetch_row(pg_query($conexao, $sqlEstoqueProd));
        $mostraPromocaoProd = pg_fetch_row(pg_query($conexao, $sqlPromocaoProd));
        $mostraPromoporcentagemProd = pg_fetch_row(pg_query($conexao, $sqlPromoporcentagemProd));
        
        $array[$i]['titulo'] = $mostraTituloProd[0];
        $array[$i]['material'] = $mostraMaterialProd[0];
        $array[$i]['preco'] = $mostraPrecoProd[0];
        $array[$i]['estoque'] = $mostraEstoqueProd[0];
        $array[$i]['promocao'] = $mostraPromocaoProd[0];
        $array[$i]['promoporcentagem'] = $mostraPromoporcentagemProd[0];
    }
}
?>
