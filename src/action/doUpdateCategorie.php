<?php session_start();
    include '../bd/divers.bd.php';
    include '../bd/categorie.bd.php';
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $oldCode = $_GET['edit'];
        $newCode = $_POST['code'];
        $nom = $_POST['nom'];
        $nomImage = 'image-'.$oldCode;
        updateCategorie($oldCode, $newCode, $nom);
        if (isset($_FILES[$nomImage]['name']) && (!empty($_FILES[$nomImage]['name']))) {
            unlink('../images/categories/'.$oldCode.'.jpg');
            move_uploaded_file($_FILES[$nomImage]['tmp_name'], 
                '../images/categories/'.$newCode.'.jpg'); // MAJ Image
        } else {
            // Aucune image passée, modification du nom de l'image
            rename('../images/categories/'.$oldCode.'.jpg', '../images/categories/'.$newCode.'.jpg');
        }
    }
    header('Location: ../adminCategorie.php');
?>