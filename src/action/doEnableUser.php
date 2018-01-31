<?php session_start();
    require '../bd/divers.bd.php';
    require '../bd/utilisateur.bd.php';
    
    enableUser($_GET['pseudo']);
    
    // Retour à la page appelante
    header('Location: '.$_SERVER['HTTP_REFERER']);
?>