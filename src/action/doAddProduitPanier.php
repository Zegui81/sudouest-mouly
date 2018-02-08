<?php session_start();
    include '../bd/divers.bd.php';
    include '../bd/panier.bd.php';
    removeProduitPanier($_SESSION['pseudo'], $_GET['produit'], $_GET['quantite']);
    addProduitPanier($_SESSION['pseudo'], $_GET['produit'], $_GET['quantite']);
    header('Location: ../detailProduit.php?id='.$_GET['produit']);
?>