<?php
    include '../bd/divers.bd.php';
    include '../bd/categorie.bd.php';
    
    $newCode = $_POST['newCode'];
    
    $return = '{"total" : ';
    if (isset($_POST['oldCode'])) {
        // Edition
        $return .= controlCodeForUpdate($_POST['oldCode'], $newCode);
    } else {
        // Ajout
        $return .= controlCodeForInsert($newCode);
    }
    
    $return .= '}';

    echo json_encode($return);
?>