<?php
session_start();
include('conexao.php');

$nome = pg_escape_string($conexao, trim($_POST['name']));
$email = pg_escape_string($conexao, trim($_POST['email']));
$senha = pg_escape_string($conexao, trim(md5($_POST['password'])));
$coonfirma = pg_escape_string($conexao, trim(md5($_POST['cpassword'])));
$cpf = pg_escape_string($conexao, trim($_POST['cpf']));
$telefone = pg_escape_string($conexao, trim($_POST['telefone']));

if(strlen($telefone) > 11){
    $_SESSION['erro_cadastro'] = true;
    exit;
}

$sql = "SELECT COUNT(*) as total FROM usuarioandre WHERE login = '$email'";

$row = pg_fetch_row(pg_query($sql));

if($row[0] == 1){
    $_SESSION['user_existe'] = true;
    header('Location: cadasstro.php');

    /*aparecer erro que usuario ja existe*/
    $_SESSION['erro_cadastro'] = true;
    exit;

} else {
    if($senha == $coonfirma)
    {
        $sqlcpf = "select count(*) as total from usuariosandre where cpf = $cpf";
        $rowcpf = pg_fetch_row(pg_query($sqlcpf));
        if($rowcpf[0] != 0)
        {
            $_SESSION['erro_cadastro'] = true;
            exit;
        }
        $sql = "INSERT INTO usuarioandre (login, senha, nome, hora, cpf, telefone) VALUES ('$email', '$senha', '$nome', current_timestamp, '$cpf', '$telefone')";
        pg_query($conexao, $sql);
        header('Location: paginalogin.php');
        exit;
    }
    else
        $_SESSION['erro_senha'] = true;

}


pg_close($conexao);

header('Location: cadasstro.php');
exit;
?>
