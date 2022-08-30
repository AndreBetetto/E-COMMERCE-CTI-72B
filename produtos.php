<?php
    session_start();
    include('conexao.php');
    include('backprodutos.php');
    $email = $_SESSION['email'];
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <script src="https://kit.fontawesome.com/60a756ccae.js" crossorigin="anonymous"></script>
    <link rel=stylesheet type="text/css" href="home.css">
    <title>PRODUTOS | KeyFriends</title>
</head>
<body>
    <?php include('navbar.php')?>
    
    <form action="backendprod.php" method="POST">
            <label>Busque por um produto: <input type="text" name="termoProd" required value="<?php if(isset($_GET['termoProd'])){echo $_GET['termoProd'];}?>"> </label>
            <input name="submit" type="Submit" value="buscar">
            <button onclick="location.href='produtos.php'" type="button">Limpar</button>
        </form>

        <table border="2">
        <tr>
            <th>Id</th>
            <th>Titulo</th>
            <th>Material</th>
            <th>Preço</th>
            <th>Estoque</th>
            <th>Promoção</th>
            <th>Porcentagem Promo </th> 
            
        </tr>
    
    </table>
    <?php echo $array[1003]['titulo']; ?>
    <footer>

    </footer>
</body>
</html>