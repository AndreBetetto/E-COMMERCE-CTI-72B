<?php
    session_start();
    include('conexao.php');
    $user = $_POST["email"];
    $senha  = $_POST["password"];

    if(empty($user) || empty($senha))
    {
        header('Location: cadasstro.php');
        exit();
    }

    $usuario = pg_escape_string($conexao, $user);
    $password = pg_escape_string($conexao, $senha);

    $query = "select nome from usuarioandre where login = '{$usuario}' and senha = md5('{$senha}')";

    $nome_bd = pg_fetch_row(pg_query($query));

    $sql = "SELECT COUNT(*) as total FROM usuarioandre WHERE login = '$user'";

    $row = pg_fetch_row(pg_query($sql));


    if($row[0] == 1){

        $_SESSION['name'] = $nome_bd[0];
        header('Location: home.php');
        exit();
    } else {
        $_SESSION['erro_login'] = true;
        header('Location: paginalogin.php');
        exit();
    }
?>


