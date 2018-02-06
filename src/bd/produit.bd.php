<?php
    /* Récupère toutes les produits actifs disponibles dans la catégorie */
    function getListeProduitActifByCategorie($categorie) {
        $cnx = openBD(); // Connexion à la base de données
        
        if ($categorie == 'null') {
            $rqt = 'SELECT idProduit, nom, description, prix, stock, promotion, categorie FROM produit WHERE categorie IS NULL AND etat = 1';
            $requete = $cnx->prepare($rqt);
        } else {
            $rqt = 'SELECT idProduit, nom, description, prix, stock, promotion, categorie FROM produit WHERE categorie = :categorie AND etat = 1';
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
    
    /* Récupère toutes les produits actifs disponibles dans la catégorie */
    function getListeProduitAdminByCategorie($categorie) {
        $cnx = openBD(); // Connexion à la base de données
        
        if ($categorie == 'null') {
            $rqt = 'SELECT idProduit, nom, description, prix, stock, promotion, categorie, etat FROM produit WHERE categorie IS NULL';
            $requete = $cnx->prepare($rqt);
        } else {
            $rqt = 'SELECT idProduit, nom, description, prix, stock, promotion, categorie, etat FROM produit WHERE categorie = :categorie';
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
                $aRetouner[$i]->setEtat($row->etat);
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
                .'AND etat = 1 '
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
                .'WHERE etat = 1 ORDER BY stock, promotion, prix';
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
            .' WHERE etat = 1 AND (LOWER(nom) LIKE LOWER(:search)'
            .' OR LOWER(description) LIKE LOWER(:searchDescription))';
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
    
    /* Ajoute un produit */
    function addProduit($nom, $prix, $promo, $stock, $categorie, $description) {
        $cnx = openBD(); // Connexion à la base de données
        
        $stmt = $cnx->prepare('INSERT INTO produit '
            .'(nom, prix, promotion, stock, description, categorie, etat) '
            .'VALUES (:nom, :prix, :promo, :stock, :description, :categorie, 1)');
        
        $stmt->bindParam(':nom', $nom);
        $stmt->bindParam(':prix', $prix);
        $stmt->bindParam(':promo', $promo);
        $stmt->bindParam(':stock', $stock);
        $stmt->bindParam(':description', $description);
        $stmt->bindParam(':categorie', $categorie);
        $stmt->execute();
        
        $newId = $cnx->lastInsertId();
        closeBD($cnx);  
        return $newId;
    }
    
    /* Met à jour un produit */
    function updateProduit($idProduit, $nom, $prix, $promo, $stock, $categorie, $description) {
        $cnx = openBD(); // Connexion à la base de données
        
        $stmt = $cnx->prepare('UPDATE produit SET '
            .'nom = :nom, prix = :prix, promotion = :promo, stock = :stock, '
            .'description = :description, categorie = :categorie '
            .'WHERE idProduit = :idProduit');
        
        $stmt->bindParam(':idProduit', $idProduit);
        $stmt->bindParam(':nom', $nom);
        $stmt->bindParam(':prix', $prix);
        $stmt->bindParam(':promo', $promo);
        $stmt->bindParam(':stock', $stock);
        $stmt->bindParam(':description', $description);
        $stmt->bindParam(':categorie', $categorie);
        $stmt->execute();

        closeBD($cnx);  
    }
    
    /* Active le produit */
    function enableProduit($idProduit) {
        $cnx = openBD(); // Connexion à la base de données
        
        $stmt = $cnx->prepare('UPDATE produit SET etat = 1 WHERE idProduit = :produit');
        $stmt->bindParam(':produit', $idProduit);
        $stmt->execute();
        
        closeBD($cnx);
    }
    
    /* Désactive le produit */
    function disableProduit($idProduit) {
        $cnx = openBD(); // Connexion à la base de données
        
        $stmt = $cnx->prepare('UPDATE produit SET etat = 0 WHERE idProduit = :produit');
        $stmt->bindParam(':produit', $idProduit);
        $stmt->execute();
        
        closeBD($cnx);
    }
?>