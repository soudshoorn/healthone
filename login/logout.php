<?php 
    session_start();

    unset($_SESSION['user']);
    unset($_SESSION['admin']);
    unset($_SESSION['username']);
    header("Location: /healthone/index.php");
?>