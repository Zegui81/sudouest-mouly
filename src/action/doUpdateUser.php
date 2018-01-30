<?php session_start();
    include '../bd/divers.bd.php';
    include '../bd/utilisateur.bd.php';
    
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        echo $_POST['role'];
        updateUtilisateur(
            $_GET['pseudo'],
            $_POST['nom'],
            empty($_POST['prenom']) ? null : $_POST['prenom'],
            empty($_POST['naissance']) ? null : $_POST['naissance'],
            empty($_POST['adresse']) ? null : $_POST['adresse'],
            empty($_POST['codePostal']) ? null : $_POST['codePostal'],
            empty($_POST['ville']) ? null : $_POST['ville'],
            $_POST['role']);
    }
    header('Location: ../adminListeUser.php');
?>