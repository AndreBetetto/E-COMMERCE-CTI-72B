<?php
    session_start();
    include('conexao.php');
    $foto = $_SESSION['pathimagem'];



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

    

        <br><br><br>
    <?php
        $email = $_SESSION['email'];
        $nome = $_SESSION['name'];
        $target = "uploads/" . $foto;
        if($nome == '') : ?>
                <h2>Faça <a href="paginalogin.php">Login</a> ou <a href="cadasstro.php">Cadastre-se</a> para acessar seu perfil!</h2>
            <?php exit; endif; ?>
        <form action="upload.php" method="post" enctype="multipart/form-data">
            <label>Coloque aqui uma imagem: <input type="file" name="fileToUpload" id="fileToUpload"></label><br>
            <input type="submit" value="salvar" name="salvarS">
        </form>
        
       
        <?php if(strlen($target) > 8):
        $photo = $target;?>

            <img src="<?php echo $target; ?>" width="100" height="100"/>
            <br>
        
            <?php endif; ?>

        <?php 
        if($target == "uploads/"): ?>
            <img src="fotosPadrao/default.png" width="100" height="100"/> <?php endif; ?> <br><br>
        
            <?php if($nome != '') : ?>
        Nome: <?php echo $nome; ?> <br>
        email: <?php echo $email; ?><br><br><br>

            <label>Telefone (celular):
                <?php
                    $sqlID = "SELECT id from usuarioandre where login = '$email'";

                    $ID = pg_fetch_row(pg_query($conexao, $sqlID));
                    $idreal = $ID[0];
                    $_SESSION['id'] = $idreal;
                    $pegaNumSQL = "SELECT COUNT(*) as total FROM telefoneandre where id_user = $idreal";
                    $pegaNum = pg_fetch_row(pg_query($conexao, $pegaNumSQL));
                    
                    if(intval($pegaNum[0]) <= 0){
                        echo "Nenhum número cadastrado.";
                    }
                    if(intval($pegaNum[0]) > 0):
                        for($i=1; $i <= intval($pegaNum[0]); $i++):
                            $sqlDDD = "select ddd from telefoneandre where id_user = $idreal and qtd = $i";
                            $sqlNum = "select num from telefoneandre where id_user = $idreal and qtd = $i";
                            $mostraDDD = pg_fetch_row(pg_query($conexao, $sqlDDD));
                            $mostraNum = pg_fetch_row(pg_query($conexao, $sqlNum));?>
                            <br> Numero <?php echo $i.":".$mostraDDD[0]." - ".$mostraNum[0];?> <form action="apaganum.php" method="POST"><button type="submit" value="<?php echo $i; ?>" name="apagar" >apagar</button></form>

                     <?php  endfor; endif; ?>   
                    
                        
                </label> <br>
            <form action="" method="POST">

            <label>Adicionar número de telefone: </label> <input type="number" id="ddd" name="ddd" placeholder="ddd"> <input type="text" id="num" name="num" placeholder="numero de telefone">
            <input type="submit" value="add" name="Adicionar">

            </form>
            <?php 
                $n = strval($_POST["num"]);
                $ddd = $_POST["ddd"];
                
                if(intval($ddd) < 0 || intval($ddd) > 999 || strlen($n) < 8 || strlen($n) > 16) {
                    echo "erro, digite um numero válido.";
                    exit;
                }
                else {
                    echo $n;
                    $ddd1 = intval($ddd);
                    $verifica = "select qtd from telefoneandre where id_user = $idreal order by qtd desc";
                    $ver = pg_fetch_row(pg_query($conexao, $verifica));
                    $numVer = intval($ver[0]);
                    if($numVer > 4) {
                        echo "Numero max. de telefones cadastrados alcançado.";
                    } else {
                        $qtdFinal = $numVer++;
                        $sqlAdd = "insert into telefoneandre (id_user, num, ddd, qtd) values ($idreal, '$n', $ddd1, $numVer)";
                        pg_query($conexao, $sqlAdd);
                        header("Refresh: 0");
                    }
                    
                }
            ?>
        Telefone (celular):
        Endereços:
            <?php endif;
            ?>
            




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
