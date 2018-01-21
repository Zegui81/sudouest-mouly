<?php
    session_start();
    require '../bd/utilisateur.bd.php';
    $_SESSION['pseudo'] = $_POST['pseudo'];
    $_SESSION['statut'] = connexion($_POST['pseudo'], $_POST['password']);
    header('Location: ../index.php');
?>