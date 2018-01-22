<?php session_start();
    if (session_destroy()) {
        session_unset($_SESSION["pseudo"]);
        session_unset($_SESSION["statut"]);
    }
    header('Location: ../index.php');
?>