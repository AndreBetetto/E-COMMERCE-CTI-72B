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
    <link rel="icon" href="imagens/logo.ico">
    <title>Devs | KeyFriends</title>
</head>
<body>
    <div id="nav-placeholder">
    </div>
    <script>
    $(function(){
    $("#nav-placeholder").load("nav.html");
    });
    </script>
    <script src="menu.js"></script>
    <main>
        <div class="desc">
            <h3 class="titulo1">
                Sobre nós
            </h3>
            <div class="text">
                <p>
                    A <b>KeyFriends</b> é uma empresa formada por um grupo de 5 alunos do curso Técnico de Informática. Nossa principal ideia foi trazer para o dia a dia
                    de nossos clientes, um objeto diferenciado e muito criativo, e principalmente, produzido através de uma das maiores tecnologias oferecidas pelo
                    mercado atual, que é a impressora 3D. Esse equipamento nos permite criar diversos objetos e ferramentas adequando-se à necessidades variadas.
                </p>

                <p>
                    Tivemos a oportunidade de conhecer de pertinho esse equipamento, e ver detalhadamente o seu funcionamento. Usamos produtos da mais alta qualidade para 
                    essa produção. A matéria prima de nossos chaveiros é os chamados filamentos de PLA, a qual consiste em um ermoplástico biodegradável de origem natural e de fontes 
                    renováveis, como amido de milho ou cana-de-açúcar. Esse tipo de filamento, está sendo um dos mais escolhidos atualmente para essas produções, devido sua facilidade
                    de impressão, alta dureza, resistência e claro um melhor acabamento no item final.
                </p>

                <p>
                    Nós sócios, pensamos prioritariamente na versatilidade que esse artigo apresenta na hora de pensar com o que presentar algúem especial. Buscamos 
                    atingir a diversos públicos-alvo, com opções de temas variados, para que assim, nossos clientes encontrem aquilo que esperava. Além de apenas um
                    presente, os produtos <b>KeyFriends</b> são uma maneira de carregar consigo um momento ou uma pessoa importante, com um toque de carinho próprio. 
                </p>
            </div>
        </div>

        <h3 class="titulo2">
                Desenvolvedores
            </h3>
        <div class="devsgerais">
            <div class="devs">
                <img src="imagens/ana.jpg">
                <div class="nomedevs">
                    <p> 01 - Ana Clara de Lima Bonalume </p>
                    <p> <i class="fa-solid fa-envelope"></i> a.bonalume@unesp.br</p>
                </div>
            </div>
            
            <div class="devs">
                <img src="imagens/andre.jpg">
                <div class="nomedevs">
                    <p> 03 - André Luiz de Oliveira Betetto </p>
                    <p> <i class="fa-solid fa-envelope"></i> andre.betetto@unesp.br</p>
                </div>
            </div>

            
        </div>

        <div class="devsgerais">
            <div class="devs">
                <img src="imagens/isaac.JPG">
                <div class="nomedevs">
                    <p> 20 - Isaac Levi Farias e Silva </p>
                    <p> <i class="fa-solid fa-envelope"></i> isaac.levi@unesp.br </p>
                </div>
            </div>

            <div class="devs">
                <img src="imagens/lou.jpg">
                <div class="nomedevs">
                    <p> 25 - Louise Vicentino de Moraes </p>
                    <p> <i class="fa-solid fa-envelope"></i> louise.moraes@unesp.br</p> 
                </div>
            </div>
        </div>

        <div class="devsgerais">
            <div class="devs">
                <img src="imagens/bia.jpg">
                <div class="nomedevs">
                    <p> 36 - Beatriz Prado Soche </p>
                    <p> <i class="fa-solid fa-envelope"></i> beatriz.p.soche@unesp.br </p> 
                </div>
            </div> 
        </div>
    </main>
</body>
</html>