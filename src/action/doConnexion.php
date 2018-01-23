<?php session_start();
    require '../bd/divers.bd.php';
    require '../bd/utilisateur.bd.php';
    $_SESSION['pseudo'] = $_POST['pseudo'];
    $_SESSION['statut'] = connexion($_POST['pseudo'], $_POST['password']);
    
    // Retour à la page appelante
    header('Location: '.$_SERVER['HTTP_REFERER']);
?>