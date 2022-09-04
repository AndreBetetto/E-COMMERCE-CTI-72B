<?php
    session_start();
    include('conexao.php');
    include('backprodutos.php');
    $email = $_SESSION['email'];
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <script src="https://kit.fontawesome.com/60a756ccae.js" crossorigin="anonymous"></script>
    <link rel=stylesheet type="text/css" href="home.css">
    <link rel="stylesheet" href="nav.css">
    <title>PRODUTOS | KeyFriends</title>
</head>
<body>
    <?php include('navbar.php')?>
    
    <form action="backendprod.php" method="POST">
            <label>Busque por um produto: 
                <input type="text" name="termoProd" required value="
                    <?php if(isset($_GET['termoProd']))
                        {echo $_GET['termoProd'];}
                    ?>"> 
            </label>
            <input name="submit" type="Submit" value="buscar">
            <button onclick="location.href='produtos.php'" type="button">Limpar</button>
    </form>

    <?php
        include "backendprod.php";
        if ($rowProd == 0) {
            echo "Não foi encontrado nenhum produto !!!";
            return;
        }
        echo "<div='grid'>";
            foreach($resultado_lista as $linha)
            {
                $precoProd = NUmber_format($linha['preco'], 2, ',','.');
                echo "<div> 
                        <a href='selecao_detalhes_front.php?id=".$linha['id']."'>
                            <img src='https://via.placeholder.com/250'/>
                        </a>
                    </div>

                    <div> 
                        <div> <p>".$linha['descricao']."</p> </div>
                        <div> <p> R$ ".$precoProd."</div>";

                        if($linha['estoque']<=0){
                            echo "<div> <span> Produto esgostado</span></div>";
                        }
                        else{
                            echo "<div> <span>".$linha['estoque']." em estoque </span></div>";
                        }
                        echo "<a href='carrinho.front.php?acao=add%codproduto=".$linha['id']."'>Comprar</a>";
                    echo "</div>";
                echo "</div>";
            }
        echo "</div>";

    ?>
    <footer>

    </footer>
</body>
</html>