<?php
    include 'bd/divers.bd.php';

    /* Récupère toutes les catégories disponibles */
    function getListeProduitByCategorie($categorie) {
        $cnx = openBD(); // Connexion à la base de données
        
        $rqt = "SELECT idProduit, nom, description, categorie FROM produit WHERE categorie = ?";
        $requete = $cnx->prepare($rqt);
        $requete->bindValue(1, $categorie);
        $requete->setFetchMode(PDO::FETCH_OBJ);
        
        $aRetouner = array();
        if ($requete->execute()) {
            $i=0;
            while($row = $requete->fetch()) {
                $aRetouner[$i] = array();
                $aRetouner[$i][0] = $row->idProduit;
                $aRetouner[$i][1] = $row->nom;
                $aRetouner[$i][2] = $row->description;
                $i++;
            }
            $requete->closeCursor();
        }

        closeBD($cnx);
        return $aRetouner;
    }

?>