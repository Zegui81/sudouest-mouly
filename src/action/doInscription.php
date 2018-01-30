<?php session_start();
    include '../bd/divers.bd.php';
    include '../bd/utilisateur.bd.php';
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        createUtilisateur(
            $_POST['pseudo'],
            $_POST['mail'], 
            password_hash($_POST['password'], PASSWORD_DEFAULT),
            $_POST['nom'],
            empty($_POST['prenom']) ? null : $_POST['prenom'],
            empty($_POST['naissance']) ? null : $_POST['naissance'],
            empty($_POST['adresse']) ? null : $_POST['adresse'],
            empty($_POST['cp']) ? null : $_POST['cp'],
            empty($_POST['ville']) ? null : $_POST['ville']);
    }
    $_SESSION['pseudo'] = $_POST['pseudo'];
    $_SESSION['statut'] = 0;
    header('Location: ../index.php');
?>