<?php
    include '../bd/categorie.bd.php';
    
    $oldCode = $_POST['oldCode'];
    $newCode = $_POST['newCode'];
    
    $return = '{"toal" : "';
    $return .= controlCodeForUpdate($oldCode, $newCode);
    $return .= '}';

    echo json_encode($return);
?>