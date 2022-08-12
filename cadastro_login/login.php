<?php
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

    $query = "select id, login from usuarioandre where login = '{$usuario}' and senha = md5('{$senha}')";
    $result = pg_query($conexao, $query);

    $row = pg_num_rows($result);

    if($row == 1){
        $_SESSION['usuario'] = $usuario;
        header('Location: home.php');
        exit();
    } else {
        header('Location: paginalogin.php');
        exit();
    }
?>


