<?php session_start();
    require '../bd/divers.bd.php';
    require '../bd/produit.bd.php';
    
    disableProduit($_GET['id']);
    
    // Retour à la page appelante
    header('Location: '.$_SERVER['HTTP_REFERER']);
?>