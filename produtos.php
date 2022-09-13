<?php
    session_start();
    include('conexao.php');
    include('backprodutos.php');
    $email = $_SESSION['email'];
    $id = $_SESSION['id'];
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <script src="https://kit.fontawesome.com/60a756ccae.js" crossorigin="anonymous"></script>
    <link rel=stylesheet type="text/css" href="produtos.css">
    <!-- <link rel=stylesheet type="text/css" href="nav.css"> -->
    <title>Produtos | KeyFriends</title>
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
        if ($rowProd[0] == 0) {
            echo "Não foi encontrado nenhum produto !!!";
            return;
        }
            echo "<div class='mae'>";
            echo "<div class='grid'>";
                foreach($resultado_lista as $linha)
                {
                    $precoProd = Number_format($linha['preco'], 2, ',','.');
                    echo "<div class='itens'> 
                        <a href='detalhes.php?id=".$linha['id']."'>
                            <img src='https://via.placeholder.com/250'/>
                        </a>

                        <div class='desc'> 
                            <p>".$linha['titulo']."</p> 
                            <p> R$ ".$precoProd."
                        </div>";

                            if($linha['estoque']<=0){
                                echo 
                                    "<div class='desc'> <span> Produto esgostado</span> </div>";

                                echo "<div class='desc'> 
                                    <a class='avs' href='#'>Avise-me quando chegar</a> </div>";
                            }
                            else{
                                echo
                                 "<div class='desc'> <span>".$linha['estoque']." em estoque </span> </div>";
                                echo 
                                    "<div class='desc'> 
                                        <a class='btnCmp' href='addprodcar.php?id=".$linha['id']."'>Comprar</a> </div>";
                            }
                    echo "</div>";
                }
            echo "</div>";
            echo "</div>";

    ?>
    <footer>

    </footer>
</body>
</html>