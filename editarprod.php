<?php
include ('conexao.php');
session_start();

$idget = $_GET['id'];
$idprod = substr($idget, -4);

$id = intval($idprod);
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
    <?php include "head.php" ?>
    <link rel="stylesheet" href="editarprod.css">
    <title>Editar Produto | KeyFriends</title>
</head>
<body>
            <!--Navigation bar-->
            <div id="nav-placeholder">
            </div>
            <script>
                $(function(){
                $("#nav-placeholder").load("nav.php");
                });
            </script>
            <script src="menu.js"></script>
            <!--end of Navigation bar-->

    
    <div class="detalhes">
        <form action="sqledit.php" method="post">
            <div> 
                <h1 class="titulo"> <?php echo $titulo[0] ?></h1>
            </div>

            <div class="itens">
                <div class="txt_field">
                    <input class="alter" type="text" name="id" 
                            value="<?php echo $id; ?>" readonly>
                    <span></span>
                    <label class="campos">ID do produto: </label>
                </div>

                <div class="txt_field">
                    <input class="alter" type="text" name="titulo" 
                            value="<?php echo $titulo[0]; ?>" required>
                    <span></span>
                    <label class="campos">Titulo do produto: </label> 
                </div>
                
                <div class="txt_field">
                    <input class="alter" type="textarea" rows="5" name="desc" 
                            value="<?php echo $desc[0]; ?>" required>
                    <span></span>
                    <label class="campos">Descrição do produto:</label>
                </div>

                <div class="txt_field">
                    <input class="alter" type="number" name="custo" min="0" step="0.01" 
                            value="<?php echo $custo[0]; ?>" required>
                    <span></span>
                    <label for="preco">Preço de Custo</label> <!--aqui será preenchido com o valor de preço + adicionais-->
                </div>

                <div class="txt_field">
                    <input type="number" name="lucro" min="0" step="0.01" 
                            value="<?php echo $lucro[0]; ?>" required>
                    <span></span>
                    <label for="preco">Margem de Lucro</label>
                </div>

                <div class="txt_field">
                    <input type="number" name="icms" min="0" step="0.01"
                            value="<?php echo $icms[0]; ?>" required>
                    <span></span>
                    <label for="preco">ICMS</label>
                </div>
                
                <div class="txt_field">  
                    <input class="alter" type="number" name="preco" min="0" step="0.01" 
                        value="<?php echo $preco[0]; ?>" required> 
                    <span></span> 
                    <label class="campos">Preço final:</label>  
                </div>
                
                <div class="txt_field">  
                    <input class="alter" type="number" name="estoque" min="0" 
                            value="<?php echo $estoque[0]; ?>" required> 
                    <span></span> 
                    <label class="campos">Estoque:</label>
                </div>

                <div>
                    <input class="btnEnviar" type="submit" value="Alterar">
                </div>
            </div>
        </form>

        <?php  if($_SESSION['erroupload'] == true) {
            $erro = $_SESSION['nomeerroupload'];
            echo "<script>alert('Erro ao fazer upload da imagem! erro: $erro')</script>";
            $_SESSION['erroupload'] = false;
        } ?>
        
        <form action="uploadfotoprod.php" method="post" enctype="multipart/form-data">
            <div class="itens">
                <label class="campoImg">Alterar imagem para <?php echo $titulo[0] ?></label>
                <div class="txt_field">
                    <input class="after" type="file" name="fileToUpload" id="fileToUpload">
                    <input class="after" type="hidden" value="<?php echo $id;?>" name="id" readonly>
                    <span></span>
                </div>

                <div>
                    <input class="btnEnviar" type="submit" value="Salvar" name="salvarS">  
                </div> 
            </div>                    
        </form>

    </div>             
</body>
</html>

