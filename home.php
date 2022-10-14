<?php
    session_start();
    include ('conexao.php');
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <script src="https://kit.fontawesome.com/60a756ccae.js" crossorigin="anonymous"></script>
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto+Slab:wght@300;400;500&display=swap" rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
    <script src="miniMenu.js"></script>
    <link rel=stylesheet type="text/css" href="home.css">
    <link rel=stylesheet type="text/css" href="nav.css">
    <script src="https://code.jquery.com/jquery-1.10.2.js"></script>
    <title>Home | KeyFriends</title>
    <link rel="icon" href="logoAzul.png">
</head>
    <body>
        <a id="top"></a>
        <div class="main">
            <div class="nav-sticky">
                <!--Navigation bar-->
                <div id="nav-placeholder">

                </div>

                <script>
                    $(function(){
                    $("#nav-placeholder").load("nav.html");
                    });
                </script>
                <!--end of Navigation bar-->
            </div>

            <?php
                if($_SESSION['naoAutorizado'] == true){
                    echo "<script> alert('Apenas administradores tem acesso a essa página!') </script>";
                    $_SESSION['naoAutorizado'] = false;
                }
            ?>

            <div class="container-top">
                <img id="img-grande" class="container-img" src="imagens/img-grande.png" alt="Fundo">
                <div class="txt-centro"><p>Do Futuro</p> <p>para o seu bolso.</p></div>
                        <div class="descricao-img-grande"> 
                            <p class="txt-descricao-img-grande">Já pensou ter sempre com você um produto feito por meio de impressão 3D?
                                Essas máquinas têm ganho cada vez mais destaque nos últimos anos, e revolucionando a forma como produzimos uma enorme variedade de itens.
                                Com os produtos KeyFriends, você pode ter não só um chaveiro, mas também uma lembrança! Sendo uma ótima opção para presentear alguém especial.
                                Isto é KeyFriends: Chaveiros modernos e estilosos feitos com alta tecnologia.
                            </p> 
                        </div>
                </div>
            </div>

            <div class="mae">
                <div class="texto" id="txt1">
                    <p>Confira alguns de nossos produtos:</p>
                </div>
                <div class="mae-imagens" >
                    <div class="imgs-home" id="img-home-1">
                        <img src="imagens/img1.jpg" alt="chaveiro">
                        <div class="txt-imgs-home"><p>Chaveiro de Gladiador</p></div>
                    </div>
                    <div class="imgs-home" id="maisvendido">
                        <img src="imagens/img2.jpg" alt="chaveiro2">
                        <div class="txt-imgs-home"><p>Chaveiro Chocolatinho!</p></div>
                    </div>
                    <div class="imgs-home" id="img-home-3">
                        <img src="imagens/img3.jpg" alt="chaveiro3">
                        <div class="txt-imgs-home"><p>Chaveiro S2 Amor</p></div>
                    </div>
                    <div class="imgs-home" id="maisvendido">
                        <img src="imagens/img2.jpg" alt="chaveiro2">
                        <div class="txt-imgs-home"><p>Chaveiro Chocolatinho!</p></div>
                    </div>
                </div>
                <a href="produtos.php" class="texto" id="txt2">
                    <p>Veja todos os produtos:</p>
                    <i class="fa fa-light fa-circle-plus"></i>
                </a>    
                <div class="divider"></div>
                <div class="mae-video">
                    <div class="txt-video">
                        <p>Dê uma olhada em como produzimos nossos chaveiros:</p>
                    </div>
                    <div class="video">
                    <iframe width="560" height="315" src="https://www.youtube.com/embed/fNcBXWirC8s" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                    </div>
                </div>
                <div class="divider"></div>
                <div class="fim"></div>
                
                </div>
                <div class="footer">
                    <img class="logoFooter" src="imagens/logo.svg" alt="logo">
                    <p id="txt-footer">&copy; 2022 KeyFriends - Todos os direitos reseverdos</p>
                    <div class="integrantesTodos">
                        <p id="title-footer">Desenvolvedores</p>
                        <p id="integrantes">01 - Ana Bonalume</p>
                        <p id="integrantes">03 - André Betetto</p>
                        <p id="integrantes">20 - Isaac Levi</p>
                        <p id="integrantes">25 - Louise Vicentino</p>
                        <p id="integrantes">36 - Beatriz Prado</p>
                    </div>
                    <a class="icon" href="#top"><i id="arrow" class="fa-regular fa-circle-up"></i></a>
            </div>    
            <script src="menu.js"></script>
        </div>
    </body>
</html>

