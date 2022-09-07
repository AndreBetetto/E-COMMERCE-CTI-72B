<?php
    session_start();

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
    <?php 
        include('navbar.php')
    ?>

    <div>
        <a name="topo">este é o topo</a>
        <img id="capa" src="https://via.placeholder.com/1520x400" alt="meramente ilustrativa">
        <p class="textos">
            A <b>KeyFriends</b> é uma empresa do segmento de chaveiros decorativos, sendo seu principal produto, 
            chaveiros produzidos em impressora 3D. Buscamos trazer inovação para nossos clientes, com vários modelos 
            incríveis e atrativos para decorar sua chave.
        </p>
    </div>

    <section class="grid">
        <div>
            <img src="https://via.placeholder.com/250" alt="Produto 1">
            <p> Esse é um produto da marca e bla bla bla bla bla Lorem, ipsum dolor sit amet consectetur adipisicing elit.</p>
        </div>

        <div>
            <img src="https://via.placeholder.com/250" alt="Produto 1">
            <p> Esse é um produto da marca e bla bla bla bla bla Lorem, ipsum dolor sit amet consectetur adipisicing elit.</p>
        </div>

        <div>
            <img src="https://via.placeholder.com/250" alt="Produto 1">
            <p> Esse é um produto da marca e bla bla bla bla bla Lorem, ipsum dolor sit amet consectetur adipisicing elit.</p>
        </div>

        <div>
            <img src="https://via.placeholder.com/250" alt="Produto 1">
            <p> Esse é um produto da marca e bla bla bla bla bla Lorem, ipsum dolor sit amet consectetur adipisicing elit.</p>
        </div>

        <div>
            <img src="https://via.placeholder.com/250" alt="Produto 1">
            <p> Esse é um produto da marca e bla bla bla bla bla Lorem, ipsum dolor sit amet consectetur adipisicing elit.</p>
        </div>

        <div class="verMais">
             <a href="produtos.php"> Ver mais produtos</a> 
        </div>
    </section>

    <?php
        include ('backendprod.php');
        if ($rowProd == 0) {
            echo "Não foi encontrado nenhum produto !!!";
            return;
        }
        echo "<div class='grid'>";
            for($i=1; $i<=5; $i++)
            {
                foreach($resultado_lista as $linha)
                {
                    $precoProd = NUmber_format($linha['preco'], 2, ',','.');
                    echo "<div class='itens'> 
                        <a href='selecao_detalhes_front.php?id=".$linha['id']."'>
                            <img src='https://via.placeholder.com/250'/>
                        </a>

                        <div> <p>".$linha['titulo']."</p> </div>
                        <div> <p> R$ ".$precoProd."</div>";

                        if($linha['estoque']<=0){
                            echo "<div> <span> Produto esgostado</span></div>";
                            echo "<a href='#'>Avise-me quando chegar</a>";
                        }
                        else{
                            echo "<div> <span>".$linha['estoque']." em estoque </span></div>";
                            echo "<a href='addprodcar.php?id=add%codproduto=".$linha['id']."'>Comprar</a>";
                        }
                    echo "</div>";
                }
            }
        echo "</div>";
    ?>

        
    <footer>
        <div>
             <a href="#topo"> volte ao topo </a> 
             <i class="fa-regular fa-circle-up fa-2x"></i> 
        </div>
    </footer>
</body>
</html>