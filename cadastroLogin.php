<?php

$login = $_POST['login'];
$senha = MD5($_POST['senha']);
$connect = "host=pgsql.projetoscti.com.br
            port=5432
            dbname=projetoscti4
            user=projetoscti4
            password=cti123";
$conecta = pg_connect($connect);

$query_select = "SELECT login FROM usuarios WHERE login = '$login'";
$select = pg_query($query_select,$connect);
$array = pg_fetch_array($select);
$logarray = $array['login'];

  if($login == "" || $login == null){
    echo"<script language='javascript' type='text/javascript'>
    alert('O campo login deve ser preenchido');window.location.href='
    cadastro.html';</script>";

    }else{
      if($logarray == $login){

        echo"<script language='javascript' type='text/javascript'>
        alert('Esse login já existe');window.location.href='
        cadastro.html';</script>";
        die();

      }else{
        $query = "INSERT INTO usuarios (login,senha) VALUES ('$login','$senha')";
        $insert = pg_query($query,$connect);

        if($insert){
          echo"<script language='javascript' type='text/javascript'>
          alert('Usuário cadastrado com sucesso!');window.location.
          href='login.html'</script>";
        }else{
          echo"<script language='javascript' type='text/javascript'>
          alert('Não foi possível cadastrar esse usuário');window.location
          .href='cadastro.html'</script>";
        }
      }
    }
?>