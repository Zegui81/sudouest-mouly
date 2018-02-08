<?php session_start();
    include '../bd/divers.bd.php';
    include '../bd/panier.bd.php';
    
    // TODO Gérer les commandes
    removeAllProduitPanier($_SESSION['pseudo']);
    
    header('Location: ../index.php');
?>