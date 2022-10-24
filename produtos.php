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
    <link rel="icon" href="imagens/logo.ico">
    <script src="https://code.jquery.com/jquery-1.10.2.js"></script>
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
        /*if($_POST['submit'] != null) {
            $pesquisa = $_POST['input'];
            $_SESSION['pesquisa'] = $pesquisa;
            $_SESSION['pesquisado'] = true;
        }
        echo "<br><br><br>".$_SESSION['pesquisa'];
        exit;*/
        
        include "backendprod.php";


        if ($rowProd[0] == 0) {
            echo "Não foi encontrado nenhum produto !!!";
            return;
        } elseif(isset($_GET['termoProd'])){
            $buscaProd = strtoupper($_GET["termoProd"]);
            $sqlProd = "select * from produtosandre where CONCAT(id, upper(titulo), upper(material), preco) LIKE '%$buscaProd%' order by id ";
            $sqlProdID = "select id from produtosandre where CONCAT(id, upper(titulo), upper(material), preco) LIKE '%$buscaProd%' order by id";
            $queryProd = pg_query($conexao, $sqlProd);
            echo "<div class='mae'>";
            echo "<div class='grid'>";
                
            foreach($resultado_lista as $linha)
            {
                
                $caminho = $linha['id'].  $linha['numberphoto'].'.jpg';
                $caminho2 = $linha['id']. $linha['numberphoto'].'.png';
                $caminho3 = $linha['id']. $linha['numberphoto'].'.jpeg';

                $target  = "produtosimagem/" . $caminho;
                $target2 = "produtosimagem/" . $caminho2;
                $target3 = "produtosimagem/" . $caminho3;

                if(file_exists($target)) {
                    $img = "<img src='$target' width='250' height='250'/>";
                } elseif(file_exists($target2)){
                    $img = "<img src='$target2' width='250' height='250'/>";
                } elseif(file_exists($target3)){
                    $img = "<img src='$target3' width='250' height='250'/>";
                } else {
                    $img = "<img src='produtosimagem/default.png' width='250' height='250'/>";
                } 

                $precoProd = Number_format($linha['preco'], 2, ',','.');
                echo "<div class='itens'> 
                    <a href='detalhes.php?id=".$linha['id']."'>
                        $img
                    </a>

                    <div class='desc'> 
                        <p class='item'>".$linha['titulo']."</p> 
                        <div class='estrelas'>
                            <i class='fa-solid fa-star'></i>
                            <i class='fa-solid fa-star'></i>
                            <i class='fa-solid fa-star'></i>
                            <i class='fa-solid fa-star'></i>
                            <i class='fa-solid fa-star'></i>
                        </div>
                        <p class='itemP'> R$ ".$precoProd." </p>
                    </div>";

                        if($linha['estoque']<=0){
                            echo 
                                "<div class='desc'> <p> Produto esgostado</p> </div>";

                            echo "<div class='desc'> 
                                <a class='avs' href='#'>Avise-me quando chegar</a> </div>";
                        }
                        else{
                            echo
                                "<div class='desc'> <p class='item'>".$linha['estoque']." em estoque </p> </div>";
                            echo 
                                "<div class='desc'> 
                                    <a class='btnCmp' href='addprodsemsair.php?num=1,id=".$linha['id']."'>Comprar</a> </div>";
                        }
                echo "</div>";
            }
            echo "</div>";
            echo "</div>";
        } else {
            echo "<div class='mae'>";
            echo "<div class='grid'>";
                
            foreach($resultado_lista as $linha)
            {
                
                $caminho = $linha['id'].  $linha['numberphoto'].'.jpg';
                $caminho2 = $linha['id']. $linha['numberphoto'].'.png';
                $caminho3 = $linha['id']. $linha['numberphoto'].'.jpeg';

                $target  = "produtosimagem/" . $caminho;
                $target2 = "produtosimagem/" . $caminho2;
                $target3 = "produtosimagem/" . $caminho3;

                if(file_exists($target)) {
                    $img = "<img src='$target' width='250' height='250'/>";
                } elseif(file_exists($target2)){
                    $img = "<img src='$target2' width='250' height='250'/>";
                } elseif(file_exists($target3)){
                    $img = "<img src='$target3' width='250' height='250'/>";
                } else {
                    $img = "<img src='produtosimagem/default.png' width='250' height='250'/>";
                } 

                $precoProd = Number_format($linha['preco'], 2, ',','.');
                echo "<div class='itens'> 
                    <a href='detalhes.php?id=".$linha['id']."'>
                        $img
                    </a>

                    <div class='desc'> 
                        <p class='item'>".$linha['titulo']."</p> 
                        <div class='estrelas'>
                            <i class='fa-solid fa-star'></i>
                            <i class='fa-solid fa-star'></i>
                            <i class='fa-solid fa-star'></i>
                            <i class='fa-solid fa-star'></i>
                            <i class='fa-solid fa-star'></i>
                        </div>
                        <p class='itemP'> R$ ".$precoProd." </p>
                    </div>";

                        if($linha['estoque']<=0){
                            echo 
                                "<div class='desc'> <p> Produto esgostado</p> </div>";

                            echo "<div class='desc'> 
                                <a class='avs' href='#'>Avise-me quando chegar</a> </div>";
                        }
                        else{
                            echo
                                "<div class='desc'> <p class='item'>".$linha['estoque']." em estoque </p> </div>";
                            echo 
                                "<div class='desc'> 
                                    <a class='btnCmp' href='addprodsemsair.php?num=1,id=".$linha['id']."'>Comprar</a> </div>";
                        }
                echo "</div>";
            }
            echo "</div>";
            echo "</div>";
        }

    ?>
    <footer>

    </footer>
</body>
</html>