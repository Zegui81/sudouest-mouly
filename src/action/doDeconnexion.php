<?php session_start();
    if (session_destroy()) {
        session_unset($_SESSION["pseudo"]);
        session_unset($_SESSION["statut"]);
    }
    // Retour à la page appelante
    header('Location: '.$_SERVER['HTTP_REFERER']);
?>