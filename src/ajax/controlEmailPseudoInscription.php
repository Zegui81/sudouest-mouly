<?php
    include '../bd/divers.bd.php';
    include '../bd/utilisateur.bd.php';
    
    $mail = $_POST['mail'];
    $pseudo = $_POST['pseudo'];
    
    $return = '{"mail" : ';
    $return .= existMail($mail) === 0 ? 0 : 1;
    $return .= ', "pseudo" : ';
    $return .= existPseudo($pseudo) === 0 ? 0 : 1;
    $return .= '}';

    echo json_encode($return);
?>