<?php
    session_start();
    include('conexao.php');
    $email = $_SESSION['email'];
    if($email != 'admin@gmail.com')
    {
        header('Location: home.php');
        $_SESSION['naoAutorizado'] = true;
        exit();
    }
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <script src="https://kit.fontawesome.com/60a756ccae.js" crossorigin="anonymous"></script>
    <link rel=stylesheet type="text/css" href="adm.css">
    <title>Área do administrador | KeyFriends</title>
    <link rel="icon" href="logoAzul.png">
</head>
<body>
<?php include('navMenuFooter.php'); ?> 
    <div class="busca"> 
        <div class="titleDB"> <p>Seja bem vindo(a), administrador.<p> </div>
        <div class="userDB">
    <!-- --------------------------------------- BUSCA EM DB --------------------------------------- -->
        <div class="titleDB"> <p>Tabela de usuários:<p> </div>

        <form action="" method="GET" class="busca-form">
            <p id="titulo">Busque um usuário:
                <input id="inputs" type="text" name="termo" required 
                    value="<?php 
                            if(isset($_GET['termo']))
                                {echo $_GET['termo'];}
                        ?>" > 
                <!-- <input name="submit" type="Submit"> -->
                <button id="btnB" name="submit" type="Submit"> <i class="fa-solid fa-magnifying-glass fa-2x"></i> </button>
                <button id="btnL" onclick="location.href='adm.php'" type="button"> <i class="fa fa-duotone fa-circle-xmark fa-2x"></i> </button>
            </p> 
        </form>
        </div>
    </div>
<!-- ------------------------------------------------------------------------------------------- -->
    <table class="table">
        <tr>
            <th>Id</th>
            <th>Nome</th>
            <th>Email</th>
	        <th>Data de Login</th>
            <th>Imagem</th>
        </tr>
            <?php
            if(isset($_GET['termo'])) {
                $busca = strtoupper($_GET["termo"]);
                $sql = "select * from usuarioandre where CONCAT(id, upper(nome), upper(login)) LIKE '%$busca%' order by id";
                $sqlID2 = "select ID from usuarioandre where CONCAT(id, upper(nome), upper(login)) LIKE '%$busca%' order by id";
                $query = pg_query($conexao, $sql);

                if(pg_num_rows($query) > 0) {
                    for($i = 0; $i < pg_num_rows($query); $i++) {

                        $mostrabusca = pg_fetch_array($query, $i);

                        $email = $mostrabusca['login'];
                        $email2 = str_replace('.', '_', $email);
                        $caminho = $email2.$mostrabusca['numberphoto'].'.jpg';
                        $caminho2 = $email2.$mostrabusca['numberphoto'].'.png';
                        $caminho3 = $email2.$mostrabusca['numberphoto'].'.jpeg';
                        $target = "uploads/" . $caminho;
                        $target2 = "uploads/" . $caminho2;
                        $target3 = "uploads/" . $caminho3;

                        if(file_exists($target)){
                            $img = "<img src='$target' class='img-perfil-adm'/>";
                        } elseif(file_exists($target2)) {
                            $img = "<img src='$target2' class='img-perfil-adm'/>";
                        } elseif(file_exists($target3)) {
                            $img = "<img src='$target3' class='img-perfil-adm'/>";
                        } else {
                            $img = "<img src='imagens/default.png' class='img-perfil-adm' />";
                        }

                        if($mostrabusca['hora'] == null) {
                            $mostrabusca['hora'] = 'Usuário antigo.';
                        }

                        echo "<tr>
                            <td>" . $mostrabusca['id'] . "</td>
                            <td>" . $mostrabusca['nome'] . "</td>
                            <td>" . $mostrabusca['login'] . "</td>
                            <td>" . substr($mostrabusca['hora'], 0, 16)  . "</td>
                            <td>".$img."</td>
                        </tr>";
                    }

                } else {
                    echo "<tr><td colspan=5>" . "No Record Found" . "</td> </tr>";
                }
            } else {
                
		        $cont = "SELECT COUNT(*) as total FROM usuarioandre";
                $row = pg_fetch_row(pg_query($conexao, $cont));
                for($i = 0; $i < $row[0]; $i++){
                    $sqlusuarios = "select * from usuarioandre order by id";
                    $rusuarios = pg_query($conexao, $sqlusuarios);
                    $mostra = pg_fetch_array($rusuarios, $i);
                    $sqlID = "Select id from usuarioandre where id = {$i}";
                
                    $numberfim = $mostra['numberphoto'];
                    $email = $mostra['login'];
                    $email21 = str_replace('.', '_', $email);
                    $caminho = $email21.$numberfim.'.jpg';
                    $caminho2 = $email21.$numberfim.'.png';
                    $caminho3 = $email21.$numberfim.'.jpeg';
                    $target = "uploads/" . $caminho;
                    $target2 = "uploads/" . $caminho2;
                    $target3 = "uploads/" . $caminho3;

                        if(file_exists($target)){
                            $img = "<img src='$target' class='img-perfil-adm'/>";
                        } elseif(file_exists($target2)) {
                            $img = "<img src='$target2' class='img-perfil-adm'/>";
                        } elseif(file_exists($target3)) {
                            $img = "<img src='$target3' class='img-perfil-adm'/>";
                        } else {
                            $img = "<img src='imagens/default.png' class='img-perfil-adm'/>";                            
                        }

                        if($mostra['hora'] == null) {
                            $mostra['hora'] = 'Usuário antigo.';
                        }
                        echo "<tr>
                            <td>" . $mostra['id'] . "</td>
                            <td>" . $mostra['nome'] . "</td>
                            <td>" . $mostra['login'] . "</td>
                            <td>" . substr($mostra['hora'],0, 16) . "</td>
                            <td>". $img."</td>
                        </tr>";
                    //}
                        
                    }
                         } 
            
            echo "</table>";
             
            ?>
    </table>

        <form action="apagarConta.php" method="POST" class="form">
            <p id="titulo">Digite o ID da conta que será apagada: 
                <input id="inputs" type="number" name="id" min="3">
                <button id="btnExcluir"> <i class="fa-solid fa-trash-can fa-2x"> </i> </button>
            </p>
        </form>

    </div>


</body>
</html>
    