<?php
    session_start();
    include('conexao.php');
    //header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
    //header("Cache-Control: post-check=0, pre-check=0", false);  
    //header("Cache-control: no-cache");
    header("Cache-Control: no-cache, must-revalidate"); // HTTP/1.1
    header("Expires: Sat, 26 Jul 1997 05:00:00 GMT");
    //header('http://projetoscti.com.br/projetoscti20/site/adm.php?nocache=987654321')
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
    <?php include('navMenuFooter.php'); ?> 

    <section>
        <div class="perfilBody">
            <?php     
                $nome = $_SESSION['name'];
                $email = $_SESSION['email'];
                $nome = $_SESSION['name'];
                $nfim = $_SESSION['numberfim'];

                $email2 = str_replace('.', '_', $email);

                $caminho = $email2.  $nfim.'.jpg';
                $caminho2 = $email2. $nfim.'.png';
                $caminho3 = $email2. $nfim.'.jpeg';

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
                            $verifica = "select count(*) from telefoneandre where id_user = $idreal";
                            $verifica2 = "select qtd from telefoneandre where id_user = $idreal order by qtd desc";

                            $ver = pg_fetch_all(pg_query($conexao, $verifica));
                            $ver2 = pg_fetch_all(pg_query($conexao, $verifica2));

                            $numVer = intval($ver[0]['count']);

                            $qtd = 1;
                            if(intval($ver2[0]['qtd']) > 2){
                                echo "Numero max. de telefones cadastrados alcançados";
                                $passou = false;
                                //mensagem erro
                            } elseif(intval($ver2[0]['qtd']) == 1) {
                                $qtd = 2;
                                $passou = true;
                                
                            } elseif(intval($ver2[0]['qtd']) == null)  {$qtd = 1; $passou = true;}
                            if($passou == true){
                                $sqlAdd = "insert into telefoneandre (id_user, ddd, num, qtd) values ($idreal, $ddd1, '$n', $qtd)";
                                pg_query($conexao, $sqlAdd);
                                $passou = false;
                            }
                            

                            /*if($numVer > 1) {
                                echo "Numero max. de telefones cadastrados alcançados";
                            } else {
                                
                                if($numVer == null) {
                                    $qtd = 1;
                                } else {
                                    if($numVer == 1) {
                                        $qtd = 2;
                                    } else {
                                        $qtd = 1;
                                    }
                                }*/
                                
                                
                                header("Refresh: 0");
                            }   
                    }
                        
                        
                    ?>
                   
                <div class="infos">   
                    <label> Adicionar endereço: </label>
                    <form action="" method="POST">
                        <input type="text" id="cep" name="cep" placeholder="00000-000">
                        <input type="submit" value="add" name="Adicionar">
                    </form>

                    <?php 
                        if(isset($_POST['cep'])){
                            $cep = $_POST['cep'];
                            $cep = str_replace("-", "", $cep);
                            $url = "https://viacep.com.br/ws/$cep/json/";
                            $ch = curl_init($url);
                            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
                            $response = curl_exec($ch);
                            curl_close($ch);
                            $data = json_decode($response, true);
                            $_SESSION['cep'] = $cep;
                            $_SESSION['rua'] = $data['logradouro'];
                            $_SESSION['bairro'] = $data['bairro'];
                            $_SESSION['cidade'] = $data['localidade'];
                            $_SESSION['estado'] = $data['uf'];

                            if($data['erro'] == true || $data['localidade'] == null) {
                                echo "CEP inválido";
                                $_SESSION['cep'] = null;
                                $_SESSION['errocep'] = true;
                            }
                            header("Refresh: 0");
                        }
                        ?>

                    <form action="" method="POST">
                        <?php
                            if($_SESSION['errocep'] == true) {
                                echo "<script> alert('CEP inválido.') </script>";
                                $_SESSION['errocep'] = false;
                            }
                        ?>
                        <label class="campos">CEP: </label> 
                            <input type="text" id="cep" name="cep" placeholder="00000-000" value="<?php echo $_SESSION['cep']; ?>">

                        <label class="campos">Endereço: </label> 
                            <input type="text" id="endereco" name="endereco" value="<?php echo $_SESSION['rua']; ?>" placeholder="Endereço" readonly > 

                        <label class="campos">Bairro: </label> 
                            <input type="text" id="bairro" name="bairro" placeholder="Bairro" value="<?php echo $_SESSION['bairro']; ?>" readonly> 

                        <label class="campos">Cidade: </label> 
                            <input type="text" id="cidade" name="cidade" placeholder="Cidade" value="<?php echo $_SESSION['cidade']; ?>" readonly> 

                        <label class="campos">UF: </label> 
                            <input type="text" id="uf" name="uf" placeholder="UF" value="<?php echo $_SESSION['estado']; ?>" readonly>  

                        <label class="campos">Número: </label> 
                            <input type="text" id="num" name="num" placeholder="Número">  

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
                        for($i = 0; $i <= 4; $i++) {
                            $sqlendereco = "select * from enderecosandre where id_user = $idreal and qtd = $i";
                            $resultado_lista=pg_fetch_array(pg_query($conexao, $sqlendereco));
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
                    $endVer = intval($ver[0]);
                    if(isset($_POST['submit'])){
                        if($endVer == 4) {
                        echo "Número máximo de endereços cadastrados";
                    }elseif($endVer < 4) {
                        $sqladdendereco = "insert into enderecosandre (id_user, cep, endereco, bairro, cidade, uf, complemento, qtd) values ($idreal, '$cep', '$endereco', '$bairro', '$cidade', '$uf', '$complemento', $endVer+1)";
                        
                        pg_query($conexao, $sqladdendereco);
                    }
                
                    }
                    endif;
                    
                   ?>
                    
            
    </section>
   
    <footer>

    </footer>
</body>

</html>