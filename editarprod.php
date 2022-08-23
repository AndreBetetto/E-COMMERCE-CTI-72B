<?php
include ('conexao.php');
session_start();

$id = intval($_POST['submit']);

$sqltitulo = "select titulo from produtosandre where id = $id";
$titulo = pg_fetch_row(pg_query($conexao, $sqltitulo));
$sqldesc = "select descricao from produtosandre where id = $id";
$desc = pg_fetch_row(pg_query($conexao, $sqldesc));
$sqlmaterial = "select material from produtosandre where id = $id";
$material = pg_fetch_row(pg_query($conexao, $sqlmaterial));
$sqlpreco = "select preco from produtosandre where id = $id";
$preco = pg_fetch_row(pg_query($conexao, $sqlpreco));
$sqlestoque = "select estoque from produtosandre where id = $id";
$estoque = pg_fetch_row(pg_query($conexao, $sqlestoque));
$sqlpromocao = "select promocao from produtosandre where id = $id";
$promocao = pg_fetch_row(pg_query($conexao, $sqlpromocao));
$sqlpromoporcentagem = "select promoporcentagem from produtosandre where id = $id";
$promoporcentagem = pg_fetch_row(pg_query($conexao, $sqlpromoporcentagem));
echo $titulo[0];
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Document</title>
</head>
<body>
    <form action="sqledit.php" method="post">
        <label>ID do produto: <input type="text" value="<?php echo $id;?>" name="id" readonly></label><br>
        <label>Titulo do produto: <input type="text" name="titulo" placeholder="Titulo do produto..." value="<?php echo $titulo[0]; ?>" required></label><br>
        <label>Descrição do produto: <input type="text" name="desc" placeholder="Descrição do produto..." value="<?php echo $desc[0]; ?>" required></label><br>
        <label>Material: <input type="text" name="material" placeholder="Material do produto..." value="<?php echo $material[0]; ?>" required></label><br>
        <label>Preço: <input type="number" name="preco" placeholder="Preço do produto..." min="0" step="0.01" value="<?php echo $preco[0]; ?>" required></label><br>
        <label>Estoque: <input type="number" name="estoque" placeholder="Quantidade de estoque do produto..." min="0" value="<?php echo $estoque[0]; ?>" required></label><br>
        <label>Está em promoção?</label><label><select name="promocao" id = "promocao"><option value="sim">Sim</option><option value="nao">Não</option></select></label><br>
        <label>Porcentagem da promoção: <input type="number" name="porcentagem" min="0" max="100" value="<?php echo $promoporcentagem[0]; ?>" required></label><br><br>
        <label><input type="submit" value="enviar"></label><br>
    </form>

    
</body>
</html>