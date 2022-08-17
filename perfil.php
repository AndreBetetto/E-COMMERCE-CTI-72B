<?php
    session_start();
    include('conexao.php');
    $foto = $_SESSION['pathimagem'];
    /*//upload
    if(isset($_POST['salvar'])) {
        //imagem enviada
        $imagem = $_FILES['image'];
        $imagem = explode('.',$imagem['name']);
        echo $imagem[sizeof($imagem)-1];
        if($imagem[sizeof($imagem)-1] != 'jpg') {
            die('Coloque arquivos apenas no formato .jpg ou .png');
        } else {
            move_uploaded_file($imagem['tmp_name'], 'uploads/'.$imagem['name']);
        }
    }*/

    


        /*if($_FILES['img']['error'] == UPLOAD_ERR_OK) {
            $temp_name = $_FILES['img']['tmp_name'];
            $name = basename($_FILES['img']['name']);
            $save_path = $upload_folder.$name;
            move_uploaded_file($temp_name,$save_path);
            $uploaded = true;
        }*/

        /*if($uploaded == TRUE) {
            echo "uploaded";
            $fh = fopen($save_path,'rb');
            $fbytes = fread($fh, filesize($save_path));
            $query2 = "insert into usuarioandre (imagem) where id = $id VALLUES ($fh)";
            $query = "call salvar_foto($1,$2)";
            $res = pg_query_params($conexao, $query, 2);

        }*/
    


?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <script src="https://kit.fontawesome.com/60a756ccae.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-jcrop/0.9.15/css/jquery.Jcrop.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-jcrop/0.9.15/js/jquery.Jcrop.js"></script>
    <link rel="stylesheet" href="jquery.Jcrop.min.css" type="text/css" />
    <script src="jquery.min.js"></script>
    <script src="jquery.Jcrop.min.js"></script>
   
    <link rel=stylesheet type="text/css" href="home.css">
    <title>HOME | KeyFriends</title>
</head>
<body>
    <header>
        <nav>
            <div class="menu">
                <input type="checkbox" id="check">
                <label for="check" id="icone"><img src="iconeMenu.png"/></label>
                <div class="barra">
                    <nav class="links">
                        <a href="home.php"><div class="link">Home</div></a>
                        <a href=""><div class="link">Produtos</div></a>
                        <a href=""><div class="link">Cadastrar</div></a>
                        <a href=""><div class="link">Contato</div></a>
                    </nav>
                </div>
            </div>

            <div class="navbar">
                <div class="flexbox">
                    <div class="search">
                        <!-- <h1>Click para pesquisar</h1> -->
                        <div>
                            <input type="text" placeholder="Pesquisar..." required>
                        </div>
                    </div>
                </div>

                <div class="icons">
                    <a href="#config"> <i id="icon" class="fa-solid fa-gear fa-2x"> </i> </a>
                    <a href="#carrinho"> <i id="icon" class="fa-solid fa-cart-shopping fa-2x"> </i> </a>
                    <a href="#perfil"> <i id="icon" class="fa-solid fa-circle-user fa-2x"> </i> </a>
                </div>
            </div>
        </nav>
    </header>
    <?php
    $nome = $_SESSION['name'];
    ?>

    <form action="upload.php" method="post" enctype="multipart/form-data">
        <label>Coloque aqui uma imagem: <input type="file" name="fileToUpload" id="fileToUpload"></label>
  
  <br><br><br>
  <br>
  <input type="submit" value="Upload Image" name="submit">
    </form>
    
        <br><br><br>
    <?php
        
        $target = "uploads/" . $foto;
        if(file_exists($target)):
            $photo = $target; ?>
            
            <img src="<?php echo $target; ?>" width="100" height="100"/>
            <?php endif;
            ?>
            
        <?php if(!file_exists($target)): ?>
            <img src="fotosPadrao/default.png" width="100" height="100"/> <?php endif; ?>

            <img src="fotosPadrao/default.png" id="image" alt ="">
            
    <!-- <section>
        Lorem ipsum dolor sit amet consectetur adipisicing elit. Sint totam dolorem veritatis sed distinctio quaerat animi repudiandae quas est. Eaque corrupti quos dolor, similique error aspernatur tenetur? Doloremque, est explicabo?
        Lorem, ipsum dolor sit amet consectetur adipisicing elit. Tenetur cum earum magni eligendi quibusdam vero ducimus impedit, quas explicabo ea, adipisci quidem dolorem voluptas a iusto nostrum quos doloremque id!
        Lorem ipsum dolor sit amet consectetur adipisicing elit. Dolore, cumque fugiat. Eum delectus cum eveniet adipisci saepe possimus voluptatibus. Reiciendis quo itaque perferendis odio quis sint rerum, perspiciatis ratione dicta.
        Lorem ipsum dolor sit amet consectetur adipisicing elit. Illo commodi officiis tempore iusto, eveniet veritatis dolorem beatae reiciendis, minima earum quas a harum! Labore ducimus neque sit ex. Tempora, id?
    </section> -->
    
    <footer>

    </footer>
</body>
</html>
