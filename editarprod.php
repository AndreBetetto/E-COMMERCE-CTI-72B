<?php
include ('conexao.php');
session_start();

$id = intval($_POST['submit']);
$_SESSION['idtemp'] = $id;
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
// echo $titulo[0];
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="editarprod.css">
    <title>Editar Produto | KeyFriends</title>
</head>
<body>
    <?php 
        include('navbar.php')
    ?>

    <form action="sqledit.php" method="post">
        <div class="detalhes">
            <div class="titulo"> 
                <h3> <?php echo $titulo[0] ?></h3>
            </div>

            <div class="itens">
                <div class="txt_field">
                    <input class="alter" type="text" value="<?php echo $id;?>" name="id" readonly>
                    <span></span>
                    <label class="campos">ID do produto: </label>
                </div>

                <div class="txt_field">
                    <input class="alter" type="text" name="titulo" placeholder="Titulo do produto..." 
                            value="<?php echo $titulo[0]; ?>" required>
                    <span></span>
                    <label class="campos">Titulo do produto: </label> 
                </div>
                
                <div class="txt_field">
                    <input class="alter" type="textarea" rows="5" name="desc" placeholder="Descrição do produto..." 
                            value="<?php echo $desc[0]; ?>" required>
                    <span></span>
                    <label class="campos">Descrição do produto:</label>
                </div>
                
                <div class="txt_field">
                    <input class="alter" type="text" name="material" placeholder="Material do produto..."
                            value="<?php echo $material[0]; ?>" required>
                        <span></span>
                    <label class="campos">Material: </label>
                </div>
                
                <div class="txt_field">  
                    <input class="alter" type="number" name="preco" placeholder="Preço do produto..." min="0" step="0.01" 
                        value="<?php echo $preco[0]; ?>" required> 
                    <span></span> 
                    <label class="campos">Preço:</label>  
                </div>
                
                <div class="txt_field">  
                    <input class="alter" type="number" name="estoque" placeholder="Quantidade de estoque do produto..." min="0" 
                            value="<?php echo $estoque[0]; ?>" required> 
                    <span></span> 
                    <label class="campos">Estoque:</label>
                </div>

    

            <div>
                <input class="btnEnviar" type="submit" value="Alterar">
            </div>
        </div>
    </form>
    <br><br><br><br> <!-- POR FAVOR TIRAR ESSES Brs DEPOIS, MUITO ARIGATO, ass.: André. -->

                <div class="txt_field">  
                    <form action="uploadfotoprod.php" method="post" enctype="multipart/form-data">
                    <label>Insira uma imagem do produto: <input  type="file" name="fileToUpload" id="fileToUpload"> </label>
                    <input type="submit" value="Salvar" name="salvarS">
                    <br><br><br><br>
                    </form>
                    
                </div>
            </div>
</body>
</html>

