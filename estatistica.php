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
    <link rel=stylesheet type="text/css" href="dev.css">
    <link rel="stylesheet" href="estatistica.css">
    <link rel="icon" href="imagens/logo.ico">
    <title>Estatísticas | KeyFriends</title>
</head>
<body>
    <div id="nav-placeholder">
    </div>
    <script>
    $(function(){
    $("#nav-placeholder").load("nav.php");
    });
    </script>
    <script src="menu.js"></script>
    <main> 
        <div class="botoes">
            <p class="titulo">Acompanhe como foi nossas vendas no período de inauguração: </p>
            <div class="bot">
                <a id="btn" href="Movimento de Caixa.pdf" target="_blank">Controle de caixa </a>
                <a id="btn" href="Movimento de Estoque.pdf" target="_blank">Controle de estoque </a>
                <a id="btn" href="Resultados.pdf" target="_blank">Balanceamento de gastos</a>
            </div>
        </div>
    </main>
</body>
</html>