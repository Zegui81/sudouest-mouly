<?php
    include '../bd/divers.bd.php';
    include '../bd/utilisateur.bd.php';
    
    $pseudo = $_POST['pseudo'];
    $mdp = $_POST['mdp'];
    
    $return = '{"pseudo" : "';
    $return .= $pseudo;
    $return .= '", "statut" : ';
    $return .= connexion($pseudo, $mdp);
    $return .= '}';

    echo json_encode($return);
?>