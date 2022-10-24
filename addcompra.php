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
            <!--end of Navigation bar--></div>
            <br><br><br><br><br><br><br>
            <form action="vendarapida.php" method="post">
                <input type="text" id="nome" name="nome">
                <input type="number" id="saida" name="saida">
                <select name="tipo" id="tipo">
                    <option value="1">CTI</option>
                    <option value="1022">Coracao</option>
                    <option value="1021">Html</option>
                    <option value="1024">Patinha</option>
                    <option value="1026">Controle</option>
                    <option value="1025">Minnie</option>
                    <option value="7">Raio</option>
                    <option value="8">CSS</option>
                    <option value="9">Engrenagem</option>
                    <option value="10">Haltere</option>
                </select>
                <input type="submit" id="salvar" name="pagar">
            </form>
            <br><br><br><br><br><br><br>

<?php
            $sqlcount =  "select count(*) from vendarapidaandre";
    $cont = pg_fetch_row(pg_query($conexao, $sqlcount));
    $sqlquery = "select * from vendarapidaandre";
    $query = pg_query($conexao, $sqlquery);
    ?>
    <table class="table">
        <tr>
            <th>Data</th>
            <th>Nome</th>
	        <th>saida</th>
            <th>saldo</th>
        </tr><?php
    for($i = 0; $i<$cont[0]; $i++){
        $mostra = pg_fetch_array($query, $i);
        echo "<tr>
            <td>".$mostra['data']."</td>".
            "<td>".$mostra['descricao']."</td>".
            "<td>".$mostra['saida']."</td>".
        "</tr>";
    }

?>

</div>
</body>
</html>