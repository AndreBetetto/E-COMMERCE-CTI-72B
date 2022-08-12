<?php
    session_start();
    if(!$_SESSION['usuario']){
        header('Location: paginalogin.php');
        exit();
    }
?>