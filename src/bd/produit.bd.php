<?php
    /* Récupère toutes les catégories disponibles */
    function getListeProduitByCategorie($categorie) {
        $cnx = openBD(); // Connexion à la base de données
        
        
        if ($categorie == 'null') {
            $rqt = 'SELECT idProduit, nom, description, prix, stock, promotion, categorie FROM produit WHERE categorie IS NULL';
            $requete = $cnx->prepare($rqt);
        } else {
            $rqt = 'SELECT idProduit, nom, description, prix, stock, promotion, categorie FROM produit WHERE categorie = :categorie';
            $requete = $cnx->prepare($rqt);
            $requete->bindParam(':categorie', $categorie);
        }
        $requete->setFetchMode(PDO::FETCH_OBJ);
        
        $aRetouner = array();
        if ($requete->execute()) {
            $i = 0;
            while($row = $requete->fetch()) {
                $aRetouner[$i] = new Produit();
                $aRetouner[$i]->setIdProduit($row->idProduit);
                $aRetouner[$i]->setNom($row->nom);
                $aRetouner[$i]->setDescription($row->description);
                $aRetouner[$i]->setPrix($row->prix);
                $aRetouner[$i]->setStock($row->stock);
                $aRetouner[$i]->setCategorie($row->categorie);
                $aRetouner[$i]->setPromotion($row->promotion);
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

        $rqt = 'SELECT idProduit, nom, description, prix, stock, promotion, categorie FROM produit WHERE idProduit = :idProduit';
        $requete = $cnx->prepare($rqt);
        $requete->bindParam(':idProduit', $idProduit);
        $requete->setFetchMode(PDO::FETCH_OBJ);
        
        $produit = null;
        if ($requete->execute()) {
            while ($row = $requete->fetch()) {
                $produit = new Produit();
                $produit->setIdProduit($row->idProduit);
                $produit->setNom($row->nom);
                $produit->setDescription($row->description);
                $produit->setPrix($row->prix);
                $produit->setStock($row->stock);
                $produit->setCategorie($row->categorie);
                $produit->setPromotion($row->promotion);
            }
        }
        
        closeBD($cnx);
        return $produit;
    }
    
    // Récupère une liste de produit de la catégorie en excluant l'id
    function getListeProduitSimilaire($categorie, $idAExclure) {
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
        
        $rqt = 'SELECT idProduit, nom, prix, stock, promotion, categorie FROM produit '
                .'WHERE idProduit ORDER BY stock, promotion, prix';
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
                $aRetouner[$i]->setPromotion($row->promotion);
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
        
        $rqt = 'SELECT idProduit, nom, description, prix, stock, promotion, categorie FROM produit'
            .' WHERE LOWER(nom) LIKE LOWER(:search)'
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
                $aRetouner[$i]->setPrix($row->prix);
                $aRetouner[$i]->setStock($row->stock);
                $aRetouner[$i]->setCategorie($row->categorie);
                $aRetouner[$i]->setPromotion($row->promotion);
                $i++;
            }
            $requete->closeCursor();
        }
        
        closeBD($cnx);
        return $aRetouner;
    }
?>