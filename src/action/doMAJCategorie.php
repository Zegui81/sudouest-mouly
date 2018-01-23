<?php session_start();
    include '../bd/divers.bd.php';
    include '../bd/categorie.bd.php';

    $oldCode = $_GET['edit'];
    $newCode = $_POST['code'];
    $nom = $_POST['nom'];
    echo $_FILES['image']['tmp_name'];
    if (isset($_FILES['image']['name']) && (!empty($_FILES['image']['name']))) {
        echo move_uploaded_file($_FILES['image']['tmp_name'], "../images/categories/".$newCode) ? 'ok' : 'nok'; // MAJ Image
    }
    updateCategorie($oldCode, $newCode, $nom);
    header('Location: ../adminCategorie.php');
?>