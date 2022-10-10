<?php
    include ('conexao.php');
    session_start();
    $id = $_SESSION['id'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <script src="https://kit.fontawesome.com/60a756ccae.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="perfil.css">
    <title>Document</title>
</head>
<body>
    Complete as informações de entrega:
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
                        
                            <form action="finalizacaocompra_2.php" method="post">
                                <div class="txt_field">
                                    <label class="campos">Cidade: </label> 
                                    <input type="text" id="cidade" name="cidade" placeholder="Cidade" value="<?php echo $_SESSION['cidade']; ?>" readonly> 
                                    <span></span>
                                </div>

                                <div class="txt_field">
                                    <label class="campos">Bairro: </label> 
                                    <input type="text" id="bairro" name="bairro" placeholder="Bairro" value="<?php echo $_SESSION['bairro']; ?>" readonly> 
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

                            
                        </div>
                        </form>


                </div>     
</body>
</html>