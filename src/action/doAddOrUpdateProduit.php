<?php session_start();
    include '../bd/divers.bd.php';
    include '../bd/produit.bd.php';
    $id = null;
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        if (isset($_GET['id'])) {
            // Mise à jour d'un produit
            $id = $_GET['id'];
            updateProduit(
                $_GET['id'],
                $_POST['nom'],
                $_POST['prix'],
                $_POST['promo'] / 100,
                $_POST['stock'],
                $_POST['categorie'],
                $_POST['description']);
        } else {
            // Ajout d'un produit
            $id = addProduit(
                $_POST['nom'],
                $_POST['prix'],
                $_POST['promo'] / 100,
                $_POST['stock'],
                $_POST['categorie'],
                $_POST['description']);
        }
    }

    if (isset($_FILES['image-produit']['name']) && (!empty($_FILES['image-produit']['name']))) {
        move_uploaded_file($_FILES['image-produit']['tmp_name'],
            '../images/produits/'.$id.'.jpg'); // MAJ Image
    }
    
    header('Location: ../adminListeProduit.php');
?>