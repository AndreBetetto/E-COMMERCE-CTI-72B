<?php
    session_start();
    if(!$_SESSION['name']){
        header('Location: paginalogin.php')
        exit();
    }
?>