<?php
    session_start();
    session_destroy();
    header('Location: paginalogin.php');
    exit();
?>