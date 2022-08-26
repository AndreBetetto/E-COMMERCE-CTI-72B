<?php
    session_start();
    include('conexao.php');
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
    <link rel="stylesheet" href="perfil.css">
    <title>PERFIL | KeyFriends</title>
</head>
<body>
    <section>
    <?php
        include('navbar.php');
        $nome = $_SESSION['name'];
        $email = $_SESSION['email'];
        $nome = $_SESSION['name'];

        $email2 = str_replace('.', '_', $email);

        $caminho = $email2.'.jpg';
        $caminho2 = $email2.'.png';
        $caminho3 = $email2.'.jpeg';

        $target = "uploads/" . $caminho;
        $target2 = "uploads/" . $caminho2;
        $target3 = "uploads/" . $caminho3;
        if($nome == '') : ?>
                <!--<h2>FaÃ§a <a href="paginalogin.php">Login</a> ou <a href="cadasstro.php">Cadastre-se</a> para acessar seu perfil!</h2>-->
            <?php 
                header('Location: paginalogin.php');
                exit(); 
            ?>    
            <?php endif; ?>
        <div class="perfil">
            <form action="upload.php" method="post" enctype="multipart/form-data">
                <label>Coloque aqui uma imagem: <input type="file" name="fileToUpload" id="fileToUpload"></label><br>
                <input type="submit" value="salvar" name="salvarS">
            </form>
            
        
            <?php if(file_exists($target)) : ?>

                <img src="<?php echo $target; ?>" width="100" height="100"/>
                <br>
            
                
                <?php elseif(file_exists($target2)) : ?>

                <img src="<?php echo $target2; ?>" width="100" height="100"/>
                <br>

        
            <?php elseif(file_exists($target3)) : ?>

            <img src="<?php echo $target3; ?>" width="100" height="100"/>
            <br>
            <?php endif; ?>   


            <?php 
            if(file_exists($target3) == false && file_exists($target) == false && file_exists($target2) == false): ?>
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
                            echo "Nenhum nÃºmero cadastrado.";
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

                <label>Adicionar nÃºmero de telefone: </label> <input type="number" id="ddd" name="ddd" placeholder="ddd"> <input type="text" id="num" name="num" placeholder="numero de telefone">
                <input type="submit" value="add" name="Adicionar">

                </form>
                <?php 
                    $n = strval($_POST["num"]);
                    $ddd = $_POST["ddd"];
                    
                    if(intval($ddd) < 0 || intval($ddd) > 999 || strlen($n) < 8 || strlen($n) > 16) {
                        echo "erro, digite um numero vÃ¡lido.";
                        exit;
                    }
                    else {
                        echo $n;
                        $ddd1 = intval($ddd);
                        $verifica = "select qtd from telefoneandre where id_user = $idreal order by qtd desc";
                        $ver = pg_fetch_row(pg_query($conexao, $verifica));
                        $numVer = intval($ver[0]);
                        if($numVer > 4) {
                            echo "Numero max. de telefones cadastrados alcanÃ§ado.";
                        } else {
                            $qtdFinal = $numVer++;
                            $sqlAdd = "insert into telefoneandre (id_user, num, ddd, qtd) values ($idreal, '$n', $ddd1, $numVer)";
                            pg_query($conexao, $sqlAdd);
                            header("Refresh: 0");
                        }
                        
                    }
                ?>
            Telefone (celular):
            EndereÃ§os:
                <?php endif;
                ?>
        </div>    
    </section>
    <footer>

    </footer>
</body>
</html>
