<?php session_start();
    include '../bd/divers.bd.php';
    include '../bd/categorie.bd.php';
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $code = $_POST['code'];
        $nom = $_POST['nom'];
        $nomImage = 'image-new';
        addCategorie($code, $nom);
        if (isset($_FILES[$nomImage]['name']) && (!empty($_FILES[$nomImage]['name']))) {
            move_uploaded_file($_FILES[$nomImage]['tmp_name'], 
                '../images/categories/'.$code.'.jpg'); // MAJ Image
        }
    }
    header('Location: ../adminCategorie.php');
?>