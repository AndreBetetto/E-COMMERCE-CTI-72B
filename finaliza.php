<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <script src="https://kit.fontawesome.com/60a756ccae.js" crossorigin="anonymous"></script>
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto+Slab:wght@300;400;500&display=swap" rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
    <script src="miniMenu.js"></script>
    <script src="https://code.jquery.com/jquery-1.10.2.js"></script>
    <link rel=stylesheet type="text/css" href="nav.css">
    <link rel=stylesheet type="text/css" href="fim.css">
    <title>Finalização | KeyFriends</title>
</head>
<body>
    <div id="nav-placeholder">
    </div>
        <script>
        $(function(){
        $("#nav-placeholder").load("nav.html");
        });
        </script>
    <main>
    <div class="tela">
        <div class="text">
            <i class="fa-regular fa-circle-check fa-10x"></i>
            <span id="titulo">Compra finalizada com sucesso</span>
            <span id="sub">KeyFriends agradece sua compra, volte sempre!</span>
            <a class='volta' href='home.php'> Início </a>  
        </div>
    </div>
</body>
</html>