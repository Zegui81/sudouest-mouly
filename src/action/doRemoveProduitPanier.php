<?php session_start();
    include '../bd/divers.bd.php';
    include '../bd/panier.bd.php';
    
    removeProduitPanier($_SESSION['pseudo'], $_GET['produit'], $_GET['quantite']);
    
    // Retour à la page appelante
    header('Location: '.$_SERVER['HTTP_REFERER']);
?>