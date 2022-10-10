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
            <input type="text" name="nome" placeholder="Nome impresso no cartão">
            <input type="number" id="numerocartao" name="numerocartao" placeholder="Número do cartão">
            <input type="number" id="cvv" name="cvv" placeholder="Código do cartão (3 dígitos)">
            <select name="parcelas" id="parcelas">
                <option value="1">1x</option>
                <option value="2">2x</option>
                <option value="3">3x</option>
                <option value="4">4x</option>
                <option value="5">5x</option>
                <option value="6">6x</option>
            </select>
            <input type="submit" value="Finalizar compra">
        </form>
</body>
</html>