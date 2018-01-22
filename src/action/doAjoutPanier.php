<?php session_start();
    require '../bd/panier.bd.php';
    addProduitPanier($_SESSION['pseudo'], $_GET['produit'], $_GET['quantite']);
    header('Location: ../detailProduit.php?id=' + $_GET['produit']);
?>