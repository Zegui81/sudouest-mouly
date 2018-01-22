<?php
    include 'divers.bd.php';

    /* Ajoute ou met à jour la quantite dans le panier pour un produit à un utilisateur */
    function addProduitPanier($pseudo, $idProduit, $quantite) {
        $cnx = openBD(); // Connexion à la base de données
        
        $stmt = $cnx->prepare("INSERT INTO panier "
            ."(utilisateur, produit, quantite) VALUES (:utilisateur, :produit, :quantite)");
        
        $stmt->bindParam(':utilisateur', $pseudo);
        $stmt->bindParam(':produit', $idProduit);
        $stmt->bindParam(':quantite', $quantite);
        
        $stmt->execute();
        
        closeBD($cnx);  
        
    }

?>