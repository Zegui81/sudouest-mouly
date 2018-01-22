<?php
    /* Récupère toutes les catégories disponibles */
    function getListeProduitByCategorie($categorie) {
        $cnx = openBD(); // Connexion à la base de données
        
        $rqt = "SELECT idProduit, nom, description, categorie FROM produit WHERE categorie = ?";
        $requete = $cnx->prepare($rqt);
        $requete->bindValue(1, $categorie);
        $requete->setFetchMode(PDO::FETCH_OBJ);
        
        $aRetouner = array();
        if ($requete->execute()) {
            $i = 0;
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
    
    /* Récupère un produit avec son id, renvoie null si le produit n'existe pas */
    function getProduitById($idProduit) {
        $cnx = openBD(); // Connexion à la base de données
        
        $rqt = "SELECT idProduit, nom, description, prix, stock, categorie FROM produit WHERE idProduit = ?";
        $requete = $cnx->prepare($rqt);
        $requete->bindValue(1, $idProduit);
        $requete->setFetchMode(PDO::FETCH_OBJ);
        
        $produit = array();
        $i = 0;
        if ($requete->execute()) {
            while ($row = $requete->fetch()) {
                $produit[0] = $row->idProduit;
                $produit[1] = $row->nom;
                $produit[2] = $row->description;
                $produit[3] = $row->prix;
                $produit[4] = $row->stock;
                $produit[5] = $row->categorie;
                $i++;
            }
        }
        
        closeBD($cnx);
        
        // Vérification si un produit a été trouvé
        if ($i == 0) {
            // Aucun produit trouvé
            return null;
        } // Else un produit a été trouvé
        return $produit;
    }
    
    // Récupère une liste de produit de la catégorie en excluant l'id
    function getListeProduitimilaire($categorie, $idAExclure) {
        $cnx = openBD(); // Connexion à la base de données
        
        $rqt = 'SELECT idProduit, nom, prix, stock, categorie FROM produit '
                .'WHERE categorie = :categorie '
                .'AND idProduit <> :idProduit '
                .'ORDER BY stock';
        $requete = $cnx->prepare($rqt);
        $requete->bindParam(':categorie', $categorie);
        $requete->bindParam(':idProduit', $idAExclure);
        $requete->setFetchMode(PDO::FETCH_OBJ);
        
        $aRetouner = array();
        if ($requete->execute()) {
            $i = 0;
            // On prend 4 produits maximum
            while(($row = $requete->fetch()) && $i < 4) {
                $aRetouner[$i] = array();
                $aRetouner[$i][0] = $row->idProduit;
                $aRetouner[$i][1] = $row->nom;
                $aRetouner[$i][2] = $row->prix;
                $i++;
            }
            $requete->closeCursor();
        }
        
        closeBD($cnx);
        return $aRetouner;
    }
?>