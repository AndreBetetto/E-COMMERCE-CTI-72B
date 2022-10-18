<?php
    session_start();
    include ('conexao.php');

    $cep = strval($_POST["cep"]);
    $cep = $_SESSION['cep'];
    $cep = str_replace('-', '', $cep);

    $endereco = $_POST["endereco"];
    $bairro = $_POST["bairro"];
    $cidade = $_POST["cidade"];
    $uf = $_POST["uf"];
    $complemento = $_POST["complemento"];
    $email = $_SESSION["email"];
    $num = $_POST["num"];

    $sqlpega = "select * from usuarioandre where login = '$email'";
    $result = pg_query($conexao, $sqlpega);
    $row = pg_fetch_array($result);
    $id = $row["id"];

    $sqlverifica = "select COUNT(*) from enderecosandre where id_user = $id";
    $result = pg_query($conexao, $sqlverifica);
    $row = pg_fetch_array($result);
    $count = $row["count"];

    if($count == 0){
        $sqlinsert = "insert into enderecosandre (cep, endereco, bairro, cidade, uf, complemento, id_user, num) values ('$cep', '$endereco', '$bairro', '$cidade', '$uf', '$complemento', $id, $num)";
    } elseif($count == 1){
        $sqlinsert = "update enderecosandre set cep = '$cep', endereco = '$endereco', bairro = '$bairro', cidade = '$cidade', uf = '$uf', complemento = '$complemento', num = $num where id_user = $id";
    }
    pg_query($conexao, $sqlinsert);

    header('Location: perfil.php');
    exit;

?>
