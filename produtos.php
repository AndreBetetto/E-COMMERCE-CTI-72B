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
    <title>HOME | KeyFriends</title>
</head>
<body>
    <header>
        <nav>
            <div class="menu">
                <input type="checkbox" id="check">
                <label for="check" id="icone"><img src="iconeMenu.png"/></label>
                <div class="barra">	
                    <nav class="links">
                        <a href="home.php"><div class="link">Home</div></a>
                        <a href="produtos.php"><div class="link">Produtos</div></a>
                        <a href="logout.php"><div class="link">Cadastrar</div></a>
                        <a href=""><div class="link">Contato</div></a>
                    </nav>	
                </div>
            </div>

            <div class="navbar">
                <div class="flexbox">
                    <div class="search">
                        <!-- <h1>Click para pesquisar</h1> -->
                        <div>
                            <input type="text" placeholder="Pesquisar..." required>
                        </div>
                    </div>
                </div>

                <div class="icons">
                    <a href="adm.php"> <i id="icon" class="fa-solid fa-gear fa-2x"> </i> </a>
                    <a href="#carrinho"> <i id="icon" class="fa-solid fa-cart-shopping fa-2x"> </i> </a>
                    <a href="perfil.php"> <i id="icon" class="fa-solid fa-circle-user fa-2x"> </i> </a>
                </div>
            </div>
        </nav>
    </header>
    <!--
    <?php /*
    $nome = $_SESSION['name'];
    if($nome == '') : ?>
        <h2>Bem vindo(a)! Faça <a href="paginalogin.php">Login</a> ou <a href="cadasstro.php">Cadastre-se</a></h2>
    <?php endif; ?>
    <?php if($nome != '') : ?>
    <h2>Bem vindo(a), <?php echo $_SESSION['name'];?> <br>Para sair, clique <a href="logout.php">aqui</a>.<?php endif; */?>


    -->

    <!-- <section>
        Lorem ipsum dolor sit amet consectetur adipisicing elit. Sint totam dolorem veritatis sed distinctio quaerat animi repudiandae quas est. Eaque corrupti quos dolor, similique error aspernatur tenetur? Doloremque, est explicabo?
        Lorem, ipsum dolor sit amet consectetur adipisicing elit. Tenetur cum earum magni eligendi quibusdam vero ducimus impedit, quas explicabo ea, adipisci quidem dolorem voluptas a iusto nostrum quos doloremque id!
        Lorem ipsum dolor sit amet consectetur adipisicing elit. Dolore, cumque fugiat. Eum delectus cum eveniet adipisci saepe possimus voluptatibus. Reiciendis quo itaque perferendis odio quis sint rerum, perspiciatis ratione dicta.
        Lorem ipsum dolor sit amet consectetur adipisicing elit. Illo commodi officiis tempore iusto, eveniet veritatis dolorem beatae reiciendis, minima earum quas a harum! Labore ducimus neque sit ex. Tempora, id?
    </section> -->


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