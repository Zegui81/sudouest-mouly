<?php
    require 'bd/utilisateur.bd.php';
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        createUtilisateur(
            $_POST['pseudo'],
            $_POST['mail'], 
            password_hash($_POST['password'], PASSWORD_DEFAULT),
            $_POST['nom'],
            $_POST['prenom'],
            $_POST['naissence'],
            $_POST['adresse'], 
            $_POST['cp'],  
            $_POST['ville']);
    }
    
    //header('Location: index.php');
?>