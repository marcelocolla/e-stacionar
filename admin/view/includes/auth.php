<?php
    session_start();

    $user = $_SESSION['user'];

    if(!isset($user)) {
        header("Location: Cadastro.php");
        exit();
    }
?>
