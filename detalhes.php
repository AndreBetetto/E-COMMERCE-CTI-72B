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
</head>
<body>
    <div class="main">
        <?php 
            include('navbar.php')
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
                <img src='https://via.placeholder.com/400'/>
            </div>

            <div class="itens">
                <div>
                    <label class="campos">
                        <b>ID do produto:</b> <?php echo $idProd ?>
                    </label> 
                </div>
                
                <div>
                    <label class="campos">
                        <b>Título:</b> <?php echo $tituloProd ?>
                    </label>
                </div>

                <div>
                    <label class="campos">
                        <b>Descrição:</b> <?php echo $descricaoProd ?>
                    </label>
                </div>

                <div>
                    <label class="campos">
                        <b>Material:</b> <?php echo $material ?>
                    </label>
                </div>

                <div>
                    <label class="campos">
                        <b>Estoque:</b>
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
                        <b>Preço:</b> <?php echo "R$ ".Number_format($precoProd, 2, ',','.') ?>
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
            
           


        <footer>
            <div>
                <a href="#topo" class="voltar"> <i class="fa-regular fa-circle-up fa-2x"></i> 
                </a> 
            </div>
        </footer>
    </div>
</body>
</html>