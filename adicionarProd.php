<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <script src="https://kit.fontawesome.com/60a756ccae.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="add.css" />
    <title>Adicionar Produto | KeyFriends</title>
</head>
<body>
    <?php include('navbar.php')?>
    <!-- <div class="titleDB"> <p>Adicione um novo produto<p> </div> -->
    <div class="center">
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
            <?php  if($_SESSION['erroupload'] == true) {
        $erro = $_SESSION['nomeerroupload'];
        echo "<script>alert('Erro ao fazer upload da imagem! erro: $erro')</script>";
        $_SESSION['erroupload'] = false;
        
    } ?>
            </div>
            
                
                    
                    <label>Insira uma imagem do produto: <input  type="file" name="fileToUpload" id="fileToUpload" required> </label>
                    <label for="fotonum">Escolha o numero da foto: </label>
                    <input type="hidden" value="<?php echo $id;?>" name="id" readonly>
<select name="fotonum" id="fotonum">
  <option value="1">foto 1</option>
  <option value="2">foto 2</option>
  <option value="3">foto 3</option>
  <option value="4">foto 4</option>
</select>
                    
                    <br><br><br><br>
                    
                
        </form>
        </div>
        <br><br><br><br> <!-- POR FAVOR TIRAR ESSES Brs DEPOIS, MUITO ARIGATO, ass.: André. -->
    
</body>
</html>

