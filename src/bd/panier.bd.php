<?php
    include 'divers.bd.php';

    /* Ajoute ou met à jour la quantite dans le panier pour un produit à un utilisateur */
    function addProduitPanier($pseudo, $idProduit, $quantite) {
        $cnx = openBD(); // Connexion à la base de données
        
        $stmt = $cnx->prepare("REPLACE INTO panier "
            ."(utilisateur, produit, quantite) VALUES (:utilisateur, :produit, :quantite)");
        
        $stmt->bindParam(':utilisateur', $pseudo);
        $stmt->bindParam(':produit', $idProduit);
        $stmt->bindParam(':quantite', $quantite);
        
        $stmt->execute();
        
        closeBD($cnx);  
    }
    
    function getListeProduitPanierUtilisateur($pseudo) {
        $cnx = openBD(); // Connexion à la base de données
        
        $rqt = 'SELECT utilisateur, produit, quantite, nom, description, prix '
                .'FROM panier JOIN produit ON idProduit = produit '
                .'WHERE utilisateur = :pseudo';
        
        $requete = $cnx->prepare($rqt);
        $requete->bindParam(':pseudo', $pseudo);
        $requete->setFetchMode(PDO::FETCH_OBJ);
        
        $aRetouner = array();
        if ($requete->execute()) {
            $i = 0;
            while ($row = $requete->fetch()) {
                $aRetouner[$i] = array();
                $aRetouner[$i][0] = $row->produit;
                $aRetouner[$i][1] = $row->quantite;
                $aRetouner[$i][2] = $row->nom;
                $aRetouner[$i][3] = $row->description;
                $aRetouner[$i][4] = $row->prix;
                $i ++;
            }
            $requete->closeCursor();
        }
        
        closeBD($cnx);
        return $aRetouner;
    }

?>