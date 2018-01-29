<?php
    /* Récupère toutes les catégories disponibles */
    function getListeProduitByCategorie($categorie) {
        $cnx = openBD(); // Connexion à la base de données
        
        $rqt = "SELECT idProduit, nom, description, prix, categorie FROM produit WHERE categorie = ?";
        $requete = $cnx->prepare($rqt);
        $requete->bindValue(1, $categorie);
        $requete->setFetchMode(PDO::FETCH_OBJ);
        
        $aRetouner = array();
        if ($requete->execute()) {
            $i = 0;
            while($row = $requete->fetch()) {
                $aRetouner[$i] = new Produit();
                $aRetouner[$i]->setIdProduit($row->idProduit);
                $aRetouner[$i]->setNom($row->nom);
                $aRetouner[$i]->setPrix($row->prix);
                $aRetouner[$i]->setDescription($row->description);
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

        $rqt = "SELECT idProduit, nom, description, prix, stock, promotion, categorie FROM produit WHERE idProduit = ?";
        $requete = $cnx->prepare($rqt);
        $requete->bindValue(1, $idProduit);
        $requete->setFetchMode(PDO::FETCH_OBJ);
        
        $produit = new Produit();
        $i = 0;
        if ($requete->execute()) {
            while ($row = $requete->fetch()) {
                $produit->setIdProduit($row->idProduit);
                $produit->setNom($row->nom);
                $produit->setDescription($row->description);
                $produit->setPrix($row->prix);
                $produit->setStock($row->stock);
                $produit->setCategorie($row->categorie);
                $produit->setPromotion($row->promotion);
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
        
        $rqt = 'SELECT idProduit, nom, prix, stock, promotion, categorie FROM produit '
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
                $aRetouner[$i] = new Produit();
                $aRetouner[$i]->setIdProduit($row->idProduit);
                $aRetouner[$i]->setNom($row->nom);
                $aRetouner[$i]->setPrix($row->prix);
                $aRetouner[$i]->setPromotion($row->promotion);
                $i++;
            }
            $requete->closeCursor();
        }
        
        closeBD($cnx);
        return $aRetouner;
    }
    
    // Récupère les produits phares
    function getListeProduitPhare() {
        $cnx = openBD(); // Connexion à la base de données
        
        $rqt = 'SELECT idProduit, nom, prix, stock, categorie FROM produit '
                .'WHERE idProduit ORDER BY prix';
        $requete = $cnx->prepare($rqt);
        $requete->setFetchMode(PDO::FETCH_OBJ);
        
        $aRetouner = array();
        if ($requete->execute()) {
            $i = 0;
            // On prend 4 produits maximum
            while(($row = $requete->fetch()) && $i < 4) {
                $aRetouner[$i] = new Produit();
                $aRetouner[$i]->setIdProduit($row->idProduit);
                $aRetouner[$i]->setNom($row->nom);
                $aRetouner[$i]->setPrix($row->prix);
                $i++;
            }
            $requete->closeCursor();
        }
        
        closeBD($cnx);
        return $aRetouner;
    }
    
    /* Recherche les produits selon la chaine aChercher */
    function getListeProduitBySearch($aChercher) {
        $cnx = openBD(); // Connexion à la base de données
        
        $rqt = 'SELECT idProduit, nom, description FROM produit WHERE LOWER(nom) LIKE LOWER(:search)'
            .' OR LOWER(description) LIKE LOWER(:searchDescription)';
        $requete = $cnx->prepare($rqt);
        $requete->bindValue(':search', '%'.$aChercher.'%');
        $requete->bindValue(':searchDescription', '% '.$aChercher.'%');
        $requete->setFetchMode(PDO::FETCH_OBJ);
        
        $aRetouner = array();
        if ($requete->execute()) {
            $i = 0;
            // On prend 4 produits maximum
            while ($row = $requete->fetch()) {
                $aRetouner[$i] = new Produit();
                $aRetouner[$i]->setIdProduit($row->idProduit);
                $aRetouner[$i]->setNom($row->nom);
                $aRetouner[$i]->setDescription($row->description);
                $i ++;
            }
            $requete->closeCursor();
        }
        
        closeBD($cnx);
        return $aRetouner;
    }
?>