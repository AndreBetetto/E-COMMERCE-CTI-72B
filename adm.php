<?php
    session_start();
    include('conexao.php');
    $email = $_SESSION['email'];
    if($email != 'admin@gmail.com')
    {
        header('Location: home.php');
        exit();
    }
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <script src="https://kit.fontawesome.com/60a756ccae.js" crossorigin="anonymous"></script>
    <link rel=stylesheet type="text/css" href="home.css">
    <link rel=stylesheet type="text/css" href="adm.css">
    <title>ADMIN | KeyFriends</title>
</head>
<body>
    <?php include('navbar.php')?>
    <div class="busca"> 
        <div class="titleDB"> <p>Olá, administrador.<p> </div>
        <div class="userDB">
    <!-- --------------------------------------- BUSCA EM DB --------------------------------------- -->
        <form action="" method="GET" class="busca-form">
        <p id="titulo">Busque um usuário:</p> <input type="text" name="termo" required value="<?php if(isset($_GET['termo'])){echo $_GET['termo'];}?>"> 
                <input name="submit" type="Submit" value="buscar">
                <button onclick="location.href='adm.php'" type="button">Limpar</button>
        </form>
        </div>
    </div>
<!-- ------------------------------------------------------------------------------------------- -->

    <?php /*
            $sqlLogin = "Select login from usuarioandre where id = 26";
            $mostraLogin = pg_fetch_row(pg_query($sqlLogin));
            echo $mostraLogin[0];
            exit;*/
            ?>
    <table class="table">
        <tr>
            <th>Id</th>
            <th>Nome</th>
            <th>Email</th>
	        <th>Data de Login</th>
            <th>imagem</th>
        </tr>
            <?php
            if(isset($_GET['termo'])) {
                $busca = $_GET["termo"];
                $sql = "select * from usuarioandre where CONCAT(id, nome, login) LIKE '%$busca%' ";
                $sqlID2 = "select ID from usuarioandre where CONCAT(id, nome, login) LIKE '%$busca%' ";
                $query = pg_query($conexao, $sql);

                if(pg_num_rows($query) > 0) {
                    for($i = 0; $i <= pg_num_rows($query); $i++) {
                        $sqlquery = pg_query($conexao, $sqlID2);
                        $idPG = pg_fetch_row($sqlquery, $i);
                        $id = intval($idPG[$i]);
                        $sqlNome2 = "select nome from usuarioandre where id = {$id}";
                        $sqlLogin2 = "select login from usuarioandre where id = {$id}";
                        $sqlHora2 = "select hora from usuarioandre where id = {$id}";
                        $mostraNome2 = pg_fetch_row(pg_query($conexao, $sqlNome2));
                        $mostraLogin2 = pg_fetch_row(pg_query($conexao, $sqlLogin2));
                        $mostraHora2 = pg_fetch_row(pg_query($conexao, $sqlHora2));

                        $email = $mostraLogin2[0];
                        $email2 = str_replace('.', '_', $email);
                        $caminho = $email2.'.jpg';
                        $caminho2 = $email2.'.png';
                        $caminho3 = $email2.'.jpeg';
                        $target = "uploads/" . $caminho;
                        $target2 = "uploads/" . $caminho2;
                        $target3 = "uploads/" . $caminho3;

                        if(file_exists($target)){
                            $img = "<img src='$target' class='img-perfil-adm'/>";
                        } elseif(file_exists($target2)) {
                            $img = "<img src='$target2' class='img-perfil-adm'/>";
                        } elseif(file_exists($target3)) {
                            $img = "<img src='$target3' class='img-perfil-adm'/>";
                        } else {
                            $img = "<img src='fotosPadrao/default.png' />";
                        }
                        echo "<tr><td>" . $idPG[$i] . "</td><td>" . $mostraNome2[0] . "</td><td>" . $mostraLogin2[0] . "</td><td>" . $mostraHora2[0] . "</td><td>".$img."</td></tr>";
                     }

                } else {
                    echo "<tr><td colspan=4>" . "No Record Found" . "</td> </tr>";
                
                }
            } else {
                
		        $cont = "SELECT COUNT(*) as total FROM usuarioandre";
                $row = pg_fetch_row(pg_query($conexao, $cont));
                for($i = 2; $i <= $row[0]+1; $i++){
                    $sqlID = "Select id from usuarioandre where id = {$i}";
                    
                        

                        $sqlNome = "Select nome from usuarioandre where id = {$i}";
                        $sqlLogin = "Select login from usuarioandre where id = {$i}";
                        $sqlHora = "Select hora from usuarioandre where id = {$i}";
                        $mostraID = pg_fetch_row(pg_query($conexao, $sqlID));
                        $mostraNome = pg_fetch_row(pg_query($conexao, $sqlNome));
                        $mostraLogin = pg_fetch_row(pg_query($conexao, $sqlLogin));
                        $mostraHora = pg_fetch_row(pg_query($conexao, $sqlHora));

                        $email = $mostraLogin[0];
                        $email2 = str_replace('.', '_', $email);
                        $caminho = $email2.'.jpg';
                        $caminho2 = $email2.'.png';
                        $caminho3 = $email2.'.jpeg';
                        $target = "uploads/" . $caminho;
                        $target2 = "uploads/" . $caminho2;
                        $target3 = "uploads/" . $caminho3;

                        if(file_exists($target)){
                            $img = "<img src='$target' class='img-perfil-adm'/>";
                        } elseif(file_exists($target2)) {
                            $img = "<img src='$target2' class='img-perfil-adm'/>";
                        } elseif(file_exists($target3)) {
                            $img = "<img src='$target3' class='img-perfil-adm'/>";
                        } else {
                            $img = "<img src='fotosPadrao/default.png' class='img-perfil-adm'/>";
                            
                            /*$img = "<img src="."fotosPadrao/default.png"."width="."100"."height="."100"."/>";*/
                        }

                        echo "<tr><td>" . $mostraID[0] . "</td><td>" . $mostraNome[0] . "</td><td>" . $mostraLogin[0] . "</td><td>" . $mostraHora[0] . "</td><td>". $img."</td></tr>";
               
                    }
                         } 
            
            echo "</table>";
             
            ?>
    </table>

        <form action="apagarConta.php" method="POST" class="form">
        <p id="titulo">Digite o ID da conta que será apagada: <input type="number" name="id" min="3"></p>
            <input name="submit" type="Submit" value="apagar">
        </form>

    </div>

    <br><br><br><br>

<!-- ----------------------------------------------- PRODUTOS ------------------------------------>

    <form action="" method="GET" class="form">
    <p id="titulo">Busque por um produto: <input type="text" name="termoProd" required value="<?php if(isset($_GET['termoProd'])){echo $_GET['termoProd'];}?>"> </p>
            <input name="submit" type="Submit" value="buscar">
            <button onclick="location.href='adm.php'" type="button">Limpar</button>
        </form>

        <table border="2" class="table">
        <tr>
            <th>Id</th>
            <th>Titulo</th>
            <th>Material</th>
            <th>Preço</th>
            <th>Estoque</th>
            <th>Promoção</th>
            <th>Porcentagem Promo </th>
            <th>Editar</th>            
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

                        echo "<tr><td>" . $idprod . "</td><td>" .$mostraTitulo2Prod[0] . "</td><td>" . $mostraMaterial2Prod[0] . "</td><td>" . $mostraPreco2Prod[0] . "</td><td>" . $mostraEstoque2Prod[0] . "</td><td>" . $mostraPromocao2Prod[0] . "</td><td>" . $mostraPromoporcentagem2Prod[0]; ?>  
                            </td><td> <form action="editarprod.php" method="post"> 
                            <button input type="submit" name="submit" id="<?php echo $idprod;?>-submit" value ="<?php echo $idprod;?>"><i class="fa-solid fa-pen-to-square"></i></button></form></td></tr>; 
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


                    echo "<tr><td>" . $mostraIDProd[0] . "</td><td>" . $mostraTituloProd[0] . "</td><td>" . $mostraMaterialProd[0] . "</td><td>" . $mostraPrecoProd[0] . "</td><td>" . $mostraEstoqueProd[0] . "</td><td>" . $mostraPromocaoProd[0] . "</td><td>" . $mostraPromoporcentagemProd[0]; ?>  </td><td> <form action="editarprod.php" method="post"> <button type="submit" name="submit" id="<?php echo $mostraIDProd[0];?>-submit" value ="<?php echo $mostraIDProd[0];?>"><i class="fa-solid fa-pen-to-square"></i></button></form></td></tr>;
                    <?php endfor; ?> <?php
                } 
            
            echo "</table>";
            ?>
    </table>

    <form action="addproduto.php" method="post" class="form">
    <p id="titulo">Titulo do produto: 
            <input type="text" name="titulo" placeholder="Titulo do produto..." required>
    </p>	

        <p id="titulo">Descrição do produto: 
            <input type="text" name="desc" placeholder="Descrição do produto..." required>
        </p>

        <p id="titulo">Material: 
            <input type="text" name="material" placeholder="Material do produto..." required>
        </p>

        <p id="titulo">Preço: 
            <input type="number" name="preco" placeholder="Preço do produto..." min="0" step="0.01" required>
        </p>

        <p id="titulo">Estoque: 
            <input type="number" name="estoque" placeholder="Quantidade de estoque do produto..." min="0" required>
        </p>

        <p id="titulo">Está em promoção?</label>
            <p id="titulo">
                <select name="promocao" id = "promocao">
                    <option value="sim">Sim</option>
                    <option value="nao">Não</option>
                </select>
            </p>

        <p id="titulo">Porcentagem da promoção: 
            <input type="number" name="porcentagem" min="0" max="100" required>
        </p>

        <p id="titulo">
            <input type="submit" value="enviar">
        </p>
    </form>
    
    
    <footer>

    </footer>
</body>
</html>