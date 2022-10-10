<?php
    include ('conexao.php');
    session_start();
    $id = $_SESSION['id'];
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
    Complete as informações do pagamento:
        blablabla
        <form action="finalizacaocompra_3.php" method="POST">
            <input type="hidden" value="submit" name="pagamento">
            <input type="submit" value="Finalizar compra">
        </form>
</body>
</html>