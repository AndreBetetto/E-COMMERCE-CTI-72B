<?php
    session_start();
    include ('conexao.php');
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <script src="https://kit.fontawesome.com/60a756ccae.js" crossorigin="anonymous"></script>
    <link rel=stylesheet type="text/css" href="home.css">
    <title>Home | KeyFriends</title>
</head>
<body>
    <div class="main">
        <?php 
            include('navbar.php')
        ?>

        <div class="capa">
            <a name="topo"></a>
            <img id="capa" src="https://via.placeholder.com/1500x1000" alt="meramente ilustrativa">
            <p class="textos">
                A <b>KeyFriends</b> é uma empresa do segmento de decoração, sendo seu principal produto 
                chaveiros produzidos em impressora 3D. Buscamos trazer inovação para nossos clientes, com vários modelos 
                incríveis e diferentes, que podem decorar além de suas chaves, muitos outros objetos.
            </p>
        </div>
        <?php
            echo "<div class='grid'>
                <div class='gridFilho'>
                    <img src='https://via.placeholder.com/250'/>
                    <p>Lorem, ipsum dolor sit amet consectetur adipisicing elit. Excepturi velit cum ad</p>
                </div>

                <div class='gridFilho'>
                    <img src='https://via.placeholder.com/250'/>
                    <p>Lorem, ipsum dolor sit amet consectetur adipisicing elit. Excepturi velit cum ad</p>
                </div>

                <div class='gridFilho'>
                    <img src='https://via.placeholder.com/250'/>
                    <p>Lorem, ipsum dolor sit amet consectetur adipisicing elit. Excepturi velit cum ad</p>
                </div>

                <div class='gridFilho'>
                    <img src='https://via.placeholder.com/250'/>
                    <p>Lorem, ipsum dolor sit amet consectetur adipisicing elit. Excepturi velit cum ad</p>
                </div>

                <div class='gridFilho'>
                    <img src='https://via.placeholder.com/250'/>
                    <p>Lorem, ipsum dolor sit amet consectetur adipisicing elit. Excepturi velit cum ad</p>
                </div>    
            </div>";
        ?>
        <div class="verMais">
            <a id="verMais" href="produtos.php">VER MAIS PRODUTOS</a>
        </div>

        <div class="videoLegenda">
            <div class="legenda">
                <p>Conheça mais sobre o funcionamento de uma impressora 3D, e entenda o diferencial em nossos produtos</p>
            </div>

            <div class="video">
                <iframe width="560" height="315" 
                    src="https://www.youtube.com/embed/BPKnDjYu2nY" title="YouTube video player" frameborder="0" 
                        allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen>
                </iframe>
            </div>
        </div>
            
        <footer>
            <div class="all">
                <div>
                    <p id="only"> Política de privacidade</p>
                    <p id="only" >KeyFriends INC. &copy Todos os direitos reservados</p> 
                    <p id="only" >keyfriends@projetoscti.com</p>
                </div>

                <div class="integr">
                    <li id="only" >01 - Ana Clara de Lima Bonalume</li>
                    <li id="only">03 - André Luiz de Oliveira Betetto</li>
                    <li id="only">20 - Isaac Levi Farias e Silva</li>
                    <li id="only">36 - Beatriz Prado Soche </li>
                </div>

                <div>
                    <a href="#topo" class="voltar"> <i class="fa-regular fa-circle-up fa-2x"></i> 
                    </a> 
                </div>                
            </div>
            
        </footer>
    </div>
</body>
</html>