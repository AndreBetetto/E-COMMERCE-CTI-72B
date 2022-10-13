<?php
    session_start();
    include('conexao.php');
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
    <div class="main">
    <?php include('navMenuFooter.php'); ?>
        <section>
            <div class="perfilBody">
                <?php
                    $nome = $_SESSION['name'];
                    $email = $_SESSION['email'];
                    $nome = $_SESSION['name'];
                    $cpf = $_SESSION['cpf'];
                    $tel = $_SESSION['telefone'];



                    $sql = "SELECT * FROM usuarioandre WHERE login = '$email'";
                    $result = pg_query($conexao, $sql);
                    $row = pg_fetch_assoc($result);
                    $nfim = $row['numberphoto'];

                    $_SESSION['numberfim'] = $nfim;
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
        <div class="fullPerfil">
            <div class="detalhes">
                <div class="titulo">
                    <h3> Meu perfil</h3>
                </div>

                <div class="itemPerfil">
                    <div class='imagem'>
                        <?php if(file_exists($target)) : ?>
                            <img src="<?php echo $target; ?>" width="200" height="200"/>

                        <?php elseif(file_exists($target2)) : ?>
                            <img src="<?php echo $target2; ?>" width="200" height="200"/>

                        <?php elseif(file_exists($target3)) : ?>
                            <img src="<?php echo $target3; ?>" width="200" height="200"/>

                        <?php elseif(file_exists($target3) == false && file_exists($target) == false && file_exists($target2) == false): ?>
                            <img src="imagens/default.png" width="200" height="200"/>
                        <?php endif ?>
                    </div>

                    <div class="infos">
                        <div class="txt_field">
                            <label class="campos">Nome</label>
                            <span></span>
                            <?php if($nome != '') : ?>
                            <?php echo "<label class='inputs'>".$nome."</label>"; ?>
                        </div>

                        <div class="txt_field">
                            <label class="campos">CPF</label>
                            <span></span>
                            <?php echo "<label class='inputs'>".$cpf."</label>"; ?>
                        </div>

                        <div class="txt_field">
                            <label class="campos">Email</label>
                            <span></span>
                            <?php echo "<label class='inputs'>".$email."</label>"; ?>
                        </div>

                        <div class="txt_field">
                            <label class="campos">Telefone (celular)</label>
                            <span></span>
                            <?php echo "<label class='inputs'>".$tel."</label>"; ?>
                        </div>
                    </div>
                </div>

                <form action="upload.php" method="post" enctype="multipart/form-data">
                        <div class="itens">
                            <div class="txt_field">
                                <label class="campos">Imagem do perfil</label>
                                <input class="after" type="file" name="fileToUpload" id="fileToUpload">
                                <span></span>
                            </div>

                            <div>
                                <input class="btnEnviar" type="submit" value="Salvar" name="salvarS">
                            </div>
                        </div>
                </form>
            </div>

            <div class="detalhes">
                <div class="titulo">
                    <h3>Dados Pessoais</h3>
                </div>

                <div class="linha">
                    <div class="titulo">
                        <h5>Endereço</h5>
                    </div>
                    <div class="itemEnder">

                        <div class="infos">
                            <div class="txt_field">
                                <label for="cep" class="campos">Insira o CEP</label>

                                <form action="" method="POST">
                                    <?php
                                        if($_SESSION['errocep'] == true) {
                                            echo "<script> alert('CEP inválido.') </script>";
                                            $_SESSION['errocep'] = false;
                                        }
                                    ?>
                                    <input type="text" id="cep" name="cep" placeholder="00000-000" value="<?php echo $_SESSION['cep']; ?>">
                                    <input type="hidden" value="submit" name="pesquisa">
                                    <span></span>
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
                                        } ?>
                            </div>

                            <form action="addendereco.php" method="post">
                                <div class="txt_field">
                                    <label class="campos">Cidade: </label>
                                    <input type="text" id="cidade" name="cidade" placeholder="Cidade" value="<?php echo $_SESSION['cidade']; ?>" readonly>
                                    <span></span>
                                </div>

                                <div class="txt_field">
                                    <label class="campos">UF: </label>
                                    <input type="text" id="uf" name="uf" placeholder="UF" value="<?php echo $_SESSION['estado']; ?>" readonly>
                                    <span></span>
                                </div>
                        </div>

                        <div class="infos">
                            <div class="txt_field">
                                <label class="campos">Bairro: </label>
                                <input type="text" id="bairro" name="bairro" placeholder="Bairro" value="<?php echo $_SESSION['bairro']; ?>" readonly>
                                <span></span>
                            </div>

                            <div class="txt_field">
                                <label class="campos">Endereço</label>
                                <input type="text" id="endereco" name="endereco" value="<?php echo $_SESSION['rua']; ?>" placeholder="Endereço" readonly >
                                <span></span>
                            </div>

                            <div class="txt_field">
                                <label class="campos">Número: </label>
                                <input type="text" id="num" name="num" placeholder="Número">
                                <span></span>
                            </div>

                            <div class="txt_field">
                                <label class="campos">Complemento: </label>
                                <input type="text" id="complemento" name="complemento" placeholder="Apartamento, casa, condomínio, sala, etc">
                                <span></span>
                            </div>
                            <input type="hidden" value="<?php echo $cep; ?>" name="cep" id="cep">



                        </div>

                        </div class="txt_field">
                                <input class="btnEnviar" type="submit" value="Salvar" name="add">
                            </div>
                        </form>

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



                    endif;

                    ?>
                </div>

        </div>
        </section>
    </div>
    <footer>

    </footer>
</body>

</html>
