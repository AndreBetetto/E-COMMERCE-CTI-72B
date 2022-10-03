<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <meta charset="UTF-8">
        <script src="https://kit.fontawesome.com/60a756ccae.js" crossorigin="anonymous"></script>
        <link rel=stylesheet type="text/css" href="navMenuFooter.css">
    </head>
    <body>
    <header>
        <nav >
            <div class="menu">
                <input type="checkbox" id="check">
                <label for="check" id="icone"><i id="iconMenu" class="fa-solid fa-bars fa-2x"></i></label>
                <div class="barra">	
                    <nav class="links">
                        <a href="home.php"><div class="link">HOME</div></a>
                        <a href="produtos.php"><div class="link">PRODUTOS</div></a>
                        <a href="logout.php"><div class="link">CADASTRAR</div></a>
                        <a href="#"><div class="link">ESTATÍSTICAS</div></a>
                        <a href="#"><div class="link">DESENVOLVEDORES</div></a>

                    </nav>	
                </div>
            </div>

            <div class="navbar">
                <div class="flexbox">
                    <div class="search">
                        <!-- <h1>Click para pesquisar</h1> -->
                        <div>
                            <input type="text" placeholder="Pesquisar produto..." required>
                        </div>
                    </div>
                </div>

                <div class="icons">
                    <a href="adm.php"> <i id="icon" class="fa-solid fa-gear fa-2x"> </i> </a>
                    <a href="carrinho.php"> <i id="icon" class="fa-solid fa-cart-shopping fa-2x"> </i> </a>
                    <a href="perfil.php"> <i id="icon" class="fa-solid fa-circle-user fa-2x"> </i> </a>
                </div>
            </div>
        </nav>
    </header>
        

    </body> 
</html>
