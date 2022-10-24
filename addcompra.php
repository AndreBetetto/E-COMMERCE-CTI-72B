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
<?php include "head.php" ?>
    <link rel=stylesheet type="text/css" href="adm.css">
    <title>Área do administrador | KeyFriends</title>

</head>
<body>
<div id="nav-placeholder">
            </div>
            <script>
                $(function(){
                $("#nav-placeholder").load("nav.php");
                });
            </script>
            <script src="menu.js"></script>
            <!--end of Navigation bar-->
            <form action="vendarapida.php" method="post">
                <input type="text" id="nome" name="nome">
                <input type="number" id="saida" name="saida">
                <select name="tipo" id="tipo">
                <option value="1">CTI</option>
                <option value="2">Coracao</option>
                <option value="3">Html</option>
                <option value="4">Patinha</option>
                <option value="5">Controle</option>
                <option value="6">Minnie</option>
                <option value="7">Raio</option>
                <option value="8">CSS</option>
                <option value="9">Engrenagem</option>
                <option value="10">Haltere</option>
            </select>
            <input type="submit" id="salvar" name="pagar">
            </form>
</div>
</body>
</html>