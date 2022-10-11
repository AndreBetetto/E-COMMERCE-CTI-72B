<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <script src="https://kit.fontawesome.com/60a756ccae.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="editarprod.css" />
    <title>Adicionar Produto | KeyFriends</title>
</head>
<body>
    <?php include('navMenuFooter.php'); ?> 
    <!-- <div class="titleDB"> <p>Adicione um novo produto<p> </div> -->
    <div class="detalhes">
        <div>
            <h1 class="titulo">Adicione um novo produto</h1>
        </div>
        
        <form action="addproduto.php" method="post" class="form" enctype="multipart/form-data">
            <div class="itens">
                <div class="txt_field">
                    <input type="text" name="titulo" required>
                    <span></span>
                    <label for="titulo">Titulo do produto: </label>
                </div>	

                <div class="txt_field">
                    <input type="text" name="desc" required>
                    <span></span>
                    <label for="desc">Descrição do produto: </label>
                </div>

                <div class="txt_field">
                    <input type="text" name="material" required>
                    <span></span>
                    <label for="material">Material</label>
                </div>

                <div class="txt_field">
                    <input type="number" name="preco" min="0" step="0.01" required>
                    <span></span>
                    <label for="preco">Preço</label>
                </div>

                <div class="txt_field">
                    <input type="number" name="estoque" min="0" required>
                    <span></span>
                    <label for="estoque">Estoque</label>
                </div>

                <div>
                    <input class="btnEnviar" type="submit" value="Enviar">
                </div>
            </div>
        </form>


    </div>

    <?php  if($_SESSION['erroupload'] == true) {
    $erro = $_SESSION['nomeerroupload'];
    echo "<script>alert('Erro ao fazer upload da imagem! erro: $erro')</script>";
    $_SESSION['erroupload'] = false;    
    } ?>
    
    <div class="detalhes">
        <div class="titulo">
            <h3>Insira imagem para o produto adicionado</h3>
        </div>

        <form action="uploadfotoprod.php" method="post" enctype="multipart/form-data">
            <div class="itens">
                <div class="txt_field">
                    <input  type="file" name="fileToUpload" id="fileToUpload" required>
                    <input type="hidden" value="<?php echo $id;?>" name="id" readonly>
                </div>

                <div>
                    <input class="btnEnviar" type="submit" value="Salvar" name="salvarS">  
                </div>
            </div>

        </form>
    </div>
</body>
</html>

