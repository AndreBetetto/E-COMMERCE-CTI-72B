<?php
    session_start();
    include('conexao.php');
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <script src="https://kit.fontawesome.com/60a756ccae.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="perfil.css">
    <title>Perfil do usuário | KeyFriends</title>
</head>
<body>
    <?php 
        include('navbar.php');
    ?>
    <section>
        <div class="perfilBody">
            <?php     
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
                if($nome == '') : 
            ?>
        </div>
        <?php 
            header('Location: paginalogin.php');
            exit(); 
        ?>    
        <?php endif; ?>

        <div class="titleDB"> <p>Meu perfil<p> </div>

        <div class="perfil">
            <form action="upload.php" method="post" enctype="multipart/form-data">
                <label class="campos">Insira uma imagem de perfil: 
                    <input class="save" type="file" name="fileToUpload" id="fileToUpload">
                    <input class="save" type="submit" value="Salvar" name="salvarS">
                </label>
            </form>
                
                <?php if(file_exists($target)) : ?>

                    <img src="<?php echo $target; ?>" width="100" height="100"/>
                    
                    <?php elseif(file_exists($target2)) : ?>

                    <img src="<?php echo $target2; ?>" width="100" height="100"/>
            
                <?php elseif(file_exists($target3)) : ?>

                    <img src="<?php echo $target3; ?>" width="100" height="100"/>
                <?php endif; ?>   

                <div class="infosPerfil">
                    <?php 
                    echo "<div class='imagem'>";
                        if(file_exists($target3) == false && file_exists($target) == false && file_exists($target2) == false): ?>
                          <img src="imagens/default.png" width="100" height="100"/> <?php endif; ?>
                    </div>

                    <div class="infos">
                        <?php if($nome != '') : ?>
                            <label class="campos"> 
                                <b>Nome:</b> <?php echo $nome; ?> 
                            </label>
                            
                            <label class="campos"> 
                                <b>Email:</b> <?php echo $email; ?> 
                            <label>
                            
                            <label class="campos">
                                <b>Telefone (celular): </b>
                                <?php
                                    $sqlID = "SELECT id from usuarioandre where login = '$email'";

                                    $ID = pg_fetch_row(pg_query($conexao, $sqlID));
                                    $idreal = $ID[0];
                                    $_SESSION['id'] = $idreal;
                                    $pegaNumSQL = "SELECT COUNT(*) as total FROM telefoneandre where id_user = $idreal";
                                    $pegaNum = pg_fetch_row(pg_query($conexao, $pegaNumSQL));
                                
                                    if(intval($pegaNum[0]) <= 0){
                                        echo "Nenhum número cadastrado";
                                    }
                                    if(intval($pegaNum[0]) > 0):
                                        for($i=1; $i <= intval($pegaNum[0]); $i++):
                                            $sqlDDD = "select ddd from telefoneandre where id_user = $idreal and qtd = $i";
                                            $sqlNum = "select num from telefoneandre where id_user = $idreal and qtd = $i";
                                            $mostraDDD = pg_fetch_row(pg_query($conexao, $sqlDDD));
                                            $mostraNum = pg_fetch_row(pg_query($conexao, $sqlNum));?>
                                            <label> Número 
                                                <?php echo $i.":  ".$mostraDDD[0]." ".$mostraNum[0];?> 
                                            </label>
                                                <form action="apaganum.php" method="POST">
                                                    <button type="submit" value="<?php echo $i; ?>" name="apagar" >
                                                        <i class="fa-solid fa-trash-can fa-1x"> </i>
                                                    </button>
                                                </form>
                                        <?php  endfor; endif; ?>                               
                            </label> 
                    </div>
                </div>

                    <form action="" method="POST">

                        <label>Adicionar número de telefone: </label> 
                            <input type="number" id="ddd" name="ddd" placeholder="ddd"> 
                            <input type="text" id="num" name="num" placeholder="numero de telefone">
                        
                        <button type="submit" value="add" name="adicionar">
                            <i class="fa fa-light fa-phone-plus"></i>
                        </button>
                    </form>
                    
                    <?php 
                    if(isset($_POST['num']) && isset($_POST['ddd'])){
                        $n = $_POST['num'];
                        $ddd = $_POST['ddd'];
                        //$n = strval($_POST["num"]);
                        //$ddd = $_POST["ddd"];
                        if(intval($ddd) < 0 || intval($ddd) > 999 || strlen($n) < 8 || strlen($n) > 16) {
                            echo "erro, digite um numero válido";
                            exit;
                        }
                        else {
                            echo $n;
                            $ddd1 = intval($ddd);
                            $verifica = "select qtd from telefoneandre where id_user = $idreal order by qtd desc";
                            $ver = pg_fetch_row(pg_query($conexao, $verifica));
                            $numVer = intval($ver[0]);
                            if($numVer > 4) {
                                echo "Numero max. de telefones cadastrados alcançados";
                            } else {
                                $qtdFinal = $numVer++;
                                $sqlAdd = "insert into telefoneandre (id_user, num, ddd, qtd) values ($idreal, '$n', $ddd1, $numVer)";
                                pg_query($conexao, $sqlAdd);
                                header("Refresh: 0");
                            }   
                    }
                        
                        }
                    ?>
                   
                <div class="infos">   
                    <label> Adicionar endereço: </label>
                    <form action="" method="POST">
                        <label class="campos">CEP: </label> 
                            <input type="text" id="cep" name="cep" placeholder="00000-000">

                        <label class="campos">Endereço: </label> 
                            <input type="text" id="endereco" name="endereco" placeholder="Endereço"> 

                        <label class="campos">Bairro: </label> 
                            <input type="text" id="bairro" name="bairro" placeholder="Bairro"> 

                        <label class="campos">Cidade: </label> 
                            <input type="text" id="cidade" name="cidade" placeholder="Cidade"> 

                        <label class="campos">UF: </label> 
                            <input type="text" id="uf" name="uf" placeholder="UF"> 

                        <label class="campos">Complemento: </label> 
                            <input type="text" id="complemento" name="complemento" placeholder="Apartamento, casa, condomínio, sala, etc"> 
                        
                        <input type="submit" value="add" name="Adicionar">
                    </form>
                </div>

                <?php 
                    $sqlend = "select qtd from enderecosandre where id_user = $idreal";
                    $numrowend = pg_fetch_row(pg_query($conexao, $sqlend));
                    if($numrowend <= 0) {
                        echo "Nenhum endereço cadastrado";
                    } else {
                        for($i = 0; $i <= $numrowend[0]; $i++) {
                            $sqlendereco = "select * from enderecosandre where id_user = $idreal and qtd = $i";
                            $resultado_lista=pg_fetch_all($conexao, $resultado );
                            echo "Endereço ".$i.": ".$resultado_lista['cep'].", ".$resultado_lista['endereco'].", ".$resultado_lista['bairro']." ".$resultado_lista['cidade']." ".$resultado_lista['uf']." ".$resultado_lista['complemento']."<br>";
                        }
                    } 
                ?>

                <?php
                    $cep = $_POST["cep"];
                    $endereco = $_POST["endereco"];
                    $bairro = $_POST["bairro"];
                    $cidade = $_POST["cidade"];
                    $uf = $_POST["uf"];
                    $complemento = $_POST["complemento"];
                    $verifica = "select qtd from enderecosandre where id_user = $idreal order by qtd desc";
                    $ver = pg_fetch_row(pg_query($conexao, $verifica));
                    $numVer = intval($ver[0]);
                    if($numVer > 4) {
                        echo "Número máximo de endereços cadastrados alcançado";
                    } else {
                        $qtdFinal = $numVer++;
                        $sqlAdd = "insert into enderecosandre (id_user, cep, endereco, bairro, cidade, uf, complemento, qtd) values ($idreal, '$cep', '$endereco', '$bairro', '$cidade', '$uf', '$complemento', $qtdFinal)";
                        pg_query($conexao, $sqlAdd);
                        if(isset($_POST['']))
                        header("Refresh: 0");
                    }

                endif;?>

            
    </section>
   
    <footer>

    </footer>
</body>

</html>