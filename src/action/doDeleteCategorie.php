<?php session_start();
    include '../bd/divers.bd.php';
    include '../bd/categorie.bd.php';
    
    $code = $_GET['code'];
    removeCategorie($code);
    unlink('../images/categories/'.$code.'.jpg');
    header('Location: ../adminCategorie.php');
?>