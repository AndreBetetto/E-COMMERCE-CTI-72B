
<head>
    <meta charset="UTF-8">
    <script src="https://kit.fontawesome.com/60a756ccae.js" crossorigin="anonymous"></script>
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto+Slab:wght@300;400;500&display=swap" rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
    <script src="miniMenu.js"></script>
    <script src="https://code.jquery.com/jquery-1.10.2.js"></script>
    <link rel=stylesheet type="text/css" href="nav.css">
    <link rel="icon" href="imagens/logo.ico">
</head>

<nav class="nav">
    <div class="menuAbrir">
            <a href="#" class="btnAbrir" onclick="abrirMenu()">&#9776;</a> <!-- abrir -->
    </div>

    <div class="menu" id="menu">
        <div class="menuNav">
            <div class="linksMenuNav">
                <a href="#" onclick="fecharMenu()">&times; Fechar</a>
                <a href="home.php"> 
                    <i class="fa-solid fa-house"></i> Home
                </a>
                <a href="produtos.php">
                    <i class="fa-solid fa-boxes-stacked"></i> Produtos
                </a>
                <a href="cadasstro.php">
                    <i class="fa-solid fa-user-plus"></i> Cadastrar
                </a>
                <a href="estatistica.php">
                    <i class="fa-solid fa-chart-line"></i> Estatísticas
                </a>
                <a href="dev.php">
                    <i class="fa-solid fa-code"></i> Desenvolvedores
                </a>
            </div>
        </div>
    </div>
    <a id="logo" href="home.php">
        <img class="logo" src="imagens/logo.svg" alt="logo">
    </a>
   

    <!-- PESQUISA -->
    <form action="produtos.php" method="get" class="search">
        <input id="input" type="text" name="input" placeholder="Pesquisar um produto..." 
            value="<?php 
                if(isset($_GET['termoProd']))
                {echo $_GET['termoProd'];}?>">
                
        <i id="nav-lupa" class="fa-solid fa-magnifying-glass fa-2x"></i>
        <input id="submit" type="submit" value="submit" >
    </form> 
    <!-- FIM PESQUISA -->

    <div class="nav-icons"> 
        <div class="opcao">
            <span>
                <a class="btn1" id="nav-icon" href="javascript://"> <i class="fa-solid fa-gear fa-2x"></i></a>
                <ul class="menu-menu">
                    <a id="itemLink" href="admUsuarios.php"> <li id="item"> <i class="fa-solid fa-user"></i> Usuários</li> </a>
                    <a id="itemLink" href="admProdutos.php"> <li id="item"> <i class="fa-solid fa-boxes-stacked"></i> Produtos</li> </a>
                </ul>
            </span>
            
        </div>
        
        <a id="nav-icon" href="carrinho.php"><i class="fa-solid fa-cart-shopping fa-2x"></i></a>
        <a id="nav-icon" href="perfil.php"><i class="fa-solid fa-circle-user fa-2x"> </i></a>
    </div>
</nav>