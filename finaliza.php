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
    <link rel="icon" href="imagens/logo.ico">
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
        <?php
    include ('conexao.php');
    session_start();
    $iduser = $_SESSION['id'];
    $email = $_SESSION['email'];
?>

<?php
        $_SESSION['finalizou'] = false;

        $listaids = $_SESSION['carrinhoids'];
        $listaqtde = $_SESSION['carrinhoqtds'];
        $listapreco = $_SESSION['carrinhopu'];

        $total = 0;
        $listaids = str_replace(",", "", $listaids);
        $listaqtde = str_replace(",", "", $listaqtde);

        $tamanholistapu = strlen($listapreco);
      

       
        while ($tamanholistapu > 0) {
            $preco = substr($listapreco, 0,14);
          
            $listapreco = substr($listapreco, 15);
            $tamanholistapu = strlen($listapreco);
        }



        while (strlen($listaids) > 0) {
            $id = substr($listaids, 0, 4);
   
            $listaids = substr($listaids, 4);
            $total++;
        }



        while (strlen($listaqtde) > 0) {
            $qtd = substr($listaqtde, 0, 3);
       
            $listaqtde = substr($listaqtde, 3);
        }
      


    ?>

    <?php
        $listaids = $_SESSION['carrinhoids'];
        $listaqtde = $_SESSION['carrinhoqtds'];
        $listapreco = $_SESSION['carrinhopu'];
        $listaids = str_replace(",", "", $listaids);
        $listaqtde = str_replace(",", "", $listaqtde);
        $tamanholistapu = strlen($listapreco);


        
        $to = "andre.betetto@unesp.br";
         $subject = "This is subject";
         
         $message = "<b>This is HTML message.</b>";
         $message .= "<h1>This is headline.</h1>";
         
         $header = "From:abc@somedomain.com \r\n";
         $header .= "MIME-Version: 1.0\r\n";
         $header .= "Content-type: text/html\r\n";
         
         $retval = mail($to,$subject,$message,$header);
         
         if( $retval == true ) {
            echo "<br><br>Message sent successfully...";
         }else {
            echo "<br><br>Message could not be sent...";
         }
      

           
            $_SESSION['finalizou'] = true;
            for($i = 0; $i < $total; $i++)
            {
                $id = intval(substr($listaids, 0, 4));
                $qtd = intval(substr($listaqtde, 0, 3));
                $preco = substr($listapreco, 0, 9);
                $preco = str_replace(",", ".", $preco);
                $preco = floatval($preco);

                $sqlprod = "select * from produtosandre where id = $id";
                $result = pg_query($conexao, $sqlprod);
                $row = pg_fetch_array($result);
                $nome = $row['titulo'];

                $listaids = substr($listaids, 4);
                $listaqtde = substr($listaqtde, 3);
                $listapreco = substr($listapreco, 7);
                $sql = "INSERT INTO vendasandre (id_user, id_prod, qtd, preco, nomeprod) VALUES ($iduser, $id, $qtd, $preco, '$nome')";
                $result = pg_query($conexao, $sql);
                $sqlremove = "update produtosandre set estoque = estoque - $qtd where id = $id";
                pg_query($conexao, $sqlremove);

            }
            $sqlremovecarrinho = "DELETE FROM carrinhoandre WHERE id_user = $iduser";
            pg_query($conexao, $sqlremovecarrinho);
        
    ?>


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