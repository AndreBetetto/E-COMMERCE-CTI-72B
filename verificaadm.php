<?php
    session_start();
    $email = $_SESSION['email'];
    if($email != 'admin@gmail.com')
    {
        header('Location: home.php');
        exit();
    }

?>