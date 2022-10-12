<?php
    include ('conexao.php');
    session_start();
    $iduser = $_SESSION['id'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <script src="https://kit.fontawesome.com/60a756ccae.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="perfil.css">
    <title>Document</title>
</head>
<body>
    Resumo do pedido:
    Itens:
    <?php
        $_SESSION['finalizou'] = false;

        $listaids = $_SESSION['carrinhoids'];
        $listaqtde = $_SESSION['carrinhoqtds'];
        $listapreco = $_SESSION['carrinhopu'];

        echo $id;
        echo $listaids;
        echo $listaqtde;
        echo $listapreco;

        $total = 0;
        $listaids = str_replace(",", "", $listaids);
        $listaqtde = str_replace(",", "", $listaqtde);

        $tamanholistapu = strlen($listapreco);
        echo "<br><br>";

        echo "Preços unitários: ";
        while ($tamanholistapu > 0) {
            $preco = substr($listapreco, 0,14);
            echo $preco . "<br>";
            $listapreco = substr($listapreco, 15);
            $tamanholistapu = strlen($listapreco);
        }
        echo "----------------------------------------------<br><br>";

        echo "lista de ids: <br>";

        while (strlen($listaids) > 0) {
            $id = substr($listaids, 0, 4);
            echo $id."<br>";
            $listaids = substr($listaids, 4);
            $total++;
        }
        echo "----------------------------------------------<br><br>";
        echo "lista de quantidades: <br>";

        while (strlen($listaqtde) > 0) {
            $qtd = substr($listaqtde, 0, 3);
            echo $qtd."<br>";
            $listaqtde = substr($listaqtde, 3);
        }
        echo "----------------------------------------------<br><br>".$total;


    ?>
    <form method="POST">
        <input type="hidden" value="submit" name="fim">
        <input type="submit" name="submit" value="Finalizar compra">
    </form>

    <?php
        $listaids = $_SESSION['carrinhoids'];
        $listaqtde = $_SESSION['carrinhoqtds'];
        $listapreco = $_SESSION['carrinhopu'];
        $listaids = str_replace(",", "", $listaids);
        $listaqtde = str_replace(",", "", $listaqtde);
        $tamanholistapu = strlen($listapreco);

        if(isset($_POST['submit'])){
            echo "teste";
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

            }
            $sqlremovecarrinho = "DELETE FROM carrinhoandre WHERE id_user = $iduser";
            pg_query($conexao, $sqlremovecarrinho);
            header('Location: home.php');
            exit;
        }
    ?>
</body>
</html>
