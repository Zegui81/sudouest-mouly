<?php
    /* Ajoute ou met à jour la quantite dans le panier pour un produit à un utilisateur */
    function addProduitPanier($pseudo, $idProduit, $quantite) {
        $cnx = openBD(); // Connexion à la base de données
        
        $stmt = $cnx->prepare('REPLACE INTO panier '
            .'(utilisateur, produit, quantite) VALUES (:utilisateur, :produit, :quantite)');
        $stmt->bindParam(':utilisateur', $pseudo);
        $stmt->bindParam(':produit', $idProduit);
        $stmt->bindParam(':quantite', $quantite);
        $stmt->execute();
        
        // On décrémente le compteur de la quantité du produit
        $stmt = $cnx->prepare('UPDATE produit SET stock = stock - :quantite WHERE idProduit = :idProduit');
        $stmt->bindParam(':quantite', $quantite);
        $stmt->bindParam(':idProduit', $idProduit);
        $stmt->execute();
        
        closeBD($cnx);  
    }
    
    function getListeProduitPanierUtilisateur($pseudo) {
        $cnx = openBD(); // Connexion à la base de données
        
        $rqt = 'SELECT utilisateur, produit, quantite, nom, description, prix, promotion '
                .'FROM panier JOIN produit ON idProduit = produit '
                .'WHERE utilisateur = :pseudo';
        
        $requete = $cnx->prepare($rqt);
        $requete->bindParam(':pseudo', $pseudo);
        $requete->setFetchMode(PDO::FETCH_OBJ);
        
        $aRetouner = array();
        if ($requete->execute()) {
            $i = 0;
            while ($row = $requete->fetch()) {
                $aRetouner[$i] = new Panier();
                $aRetouner[$i]->setUtilisateur($pseudo);
                $aRetouner[$i]->setProduit($row->produit);
                $aRetouner[$i]->setQuantite($row->quantite);
                $aRetouner[$i]->setNom($row->nom);
                $aRetouner[$i]->setDescription($row->description);
                $aRetouner[$i]->setPrix($row->prix);
                $aRetouner[$i]->setPromotion($row->promotion);
                $i ++;
            }
            $requete->closeCursor();
        }
        
        closeBD($cnx);
        return $aRetouner;
    }
    
    function getNbArticleForUser($pseudo) {
        $cnx = openBD(); // Connexion à la base de données
        
        $requete = $cnx->prepare('SELECT count(*) FROM panier WHERE utilisateur = :pseudo');
        $requete->bindParam(':pseudo', $pseudo);
        $requete->execute();
        $donnees = $requete->fetch();

        closeBD($cnx);
        return $donnees[0];
    }
    
    /* Permet de retirer un article du panier */
    function removeProduitPanier($pseudo, $idProduit, $quantite) {
        $cnx = openBD(); // Connexion à la base de données
        
        $stmt = $cnx->prepare('DELETE FROM panier WHERE utilisateur = :utilisateur AND produit = :produit ');
        $stmt->bindParam(':utilisateur', $pseudo);
        $stmt->bindParam(':produit', $idProduit);
        $stmt->execute();
        
        // On réincrémente le compteur de la quantité du produit
        $stmt = $cnx->prepare('UPDATE produit SET stock = stock + :quantite WHERE idProduit = :idProduit');
        $stmt->bindParam(':quantite', $quantite);
        $stmt->bindParam(':idProduit', $idProduit);
        $stmt->execute();
        
        closeBD($cnx);  
    }
?>