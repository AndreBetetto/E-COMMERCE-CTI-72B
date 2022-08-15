<?php
    session_start();
    include('conexao.php');
    $email = $_SESSION['email'];
    if($email != 'admin@gmail.com')
    {
        header('Location: home.php');
        exit();
    }
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <script src="https://kit.fontawesome.com/60a756ccae.js" crossorigin="anonymous"></script>
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
    <div class=""> </div>
    <div class="titleDB"> oi adm!!! <br><br>USUARIOS: </div>
    <div class="userDB">
<!-- --------------------------------------- BUSCA EM DB --------------------------------------- -->

    <form action="" method="GET">
            <label>Busque um usuario: <input type="text" name="termo" required value="<?php if(isset($_GET['termo'])){echo $_GET['termo'];}?>"> </label>
            <input name="submit" type="Submit" value="buscar">
            <button onclick="location.href='adm.php'" type="button">Limpar</button>
        </form>

<!-- ------------------------------------------------------------------------------------------- -->

    <?php/*
            $sqlLogin = "Select login from usuarioandre where id = 26";
            $mostraLogin = pg_fetch_row(pg_query($sqlLogin));
            echo $mostraLogin[0];
            exit;*/
            ?>
    <table border="2">
        <tr>
            <th>Id</th>
            <th>Nome</th>
            <th>Email</th>
	    <th>Senha</th>
        </tr>
            <?php
            if(isset($_GET['termo'])) {
                $busca = $_GET["termo"];
                $sql = "select * from usuarioandre where CONCAT(id, nome, login) LIKE '%$busca%' ";
                $sqlID2 = "select ID from usuarioandre where CONCAT(id, nome, login) LIKE '%$busca%' ";
                $query = pg_query($conexao, $sql);

                if(pg_num_rows($query) > 0) {
                    for($i = 0; $i <= pg_num_rows($query); $i++) {
                        $id = pg_fetch_row(pg_query($conexao, $sqlID2))[$i];
                        $sqlNome2 = "select nome from usuarioandre where id = {$id}";
                        $sqlLogin2 = "select login from usuarioandre where id = {$id}";
                        $sqlSenha2 = "select senha from usuarioandre where id = {$id}";
                        $mostraNome2 = pg_fetch_row(pg_query($conexao, $sqlNome2));
                        $mostraLogin2 = pg_fetch_row(pg_query($conexao, $sqlLogin2));
                        $mostraSenha2 = pg_fetch_row(pg_query($conexao, $sqlSenha2));

                        echo "<tr><td>" . $id[0] . "</td><td>" . $mostraNome2[0] . "</td><td>" . $mostraLogin2[0] . "</td><td>" . $mostraSenha2[0] . "</td></tr>";
                    }

                } else {
                    echo "<tr><td colspan=4>" . "No Record Found" . "</td> </tr>";
                
                }
            } else {

		$cont = "SELECT COUNT(*) as total FROM usuarioandre";
                $row = pg_fetch_row(pg_query($conexao, $cont));
                for($i = 2; $i <= $row[0]+1; $i++){
                    $sqlID = "Select id from usuarioandre where id = {$i}";
                    $sqlNome = "Select nome from usuarioandre where id = {$i}";
                    $sqlLogin = "Select login from usuarioandre where id = {$i}";
                    $sqlSenha = "Select senha from usuarioandre where id = {$i}";
                    $mostraID = pg_fetch_row(pg_query($conexao, $sqlID));
                    $mostraNome = pg_fetch_row(pg_query($conexao, $sqlNome));
                    $mostraLogin = pg_fetch_row(pg_query($conexao, $sqlLogin));
                    $mostraSenha = pg_fetch_row(pg_query($conexao, $sqlSenha));
                    echo "<tr><td>" . $mostraID[0] . "</td><td>" . $mostraNome[0] . "</td><td>" . $mostraLogin[0] . "</td><td>" . $mostraSenha[0] . "</td></tr>";
                } 
            }
            echo "</table>";
            $res = pg_query($conexao, $sql); 
            ?>
    </table>

        <form action="apagarConta.php" method="POST">
            <label>Digite o ID da conta que será apagada: <input type="number" name="id" min="3"></label>
            <input name="submit" type="Submit" value="apagar">
        </form>

    </div>
    
    
        <!--
    <section>
        Lorem ipsum dolor sit amet consectetur adipisicing elit. Sint totam dolorem veritatis sed distinctio quaerat animi repudiandae quas est. Eaque corrupti quos dolor, similique error aspernatur tenetur? Doloremque, est explicabo?
        Lorem, ipsum dolor sit amet consectetur adipisicing elit. Tenetur cum earum magni eligendi quibusdam vero ducimus impedit, quas explicabo ea, adipisci quidem dolorem voluptas a iusto nostrum quos doloremque id!
        Lorem ipsum dolor sit amet consectetur adipisicing elit. Dolore, cumque fugiat. Eum delectus cum eveniet adipisci saepe possimus voluptatibus. Reiciendis quo itaque perferendis odio quis sint rerum, perspiciatis ratione dicta.
        Lorem ipsum dolor sit amet consectetur adipisicing elit. Illo commodi officiis tempore iusto, eveniet veritatis dolorem beatae reiciendis, minima earum quas a harum! Labore ducimus neque sit ex. Tempora, id?
    </section> -->
    
    <footer>

    </footer>
</body>
</html>