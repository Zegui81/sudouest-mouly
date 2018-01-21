<?php
    include 'divers.bd.php';    

    /* Teste si l'email passé en argument appartient à un compte */
    function existMail($mail) {
        // Connexion à la base de données
        $cnx = openBD();
            
        $requete = $cnx->prepare("SELECT * FROM utilisateur WHERE mail = :mail");
        $requete->bindValue('mail', $mail, PDO::PARAM_INT);
        $requete->execute();
        $donnees = $requete->fetch();
        
        closeBD($cnx);
        return count($donnees['mail']);
    }
    
    /* Teste si le pseudo passé en argument appartient à un compte */
    function existPseudo($pseudo) {
        // Connexion à la base de données
        $cnx = openBD();
        
        $requete = $cnx->prepare("SELECT * FROM utilisateur WHERE pseudo = :pseudo");
        $requete->bindValue('pseudo', $pseudo, PDO::PARAM_INT);
        $requete->execute();
        $donnees = $requete->fetch();
    
        closeBD($cnx);
        return count($donnees['pseudo']);
    }
    
    /* Contrôle l'existance d'un utilisateur avec son pseudo et son mdp
     * @return - le statut de l'utilisateur (0 : client, 1 admin) si l'identification est bonne,
     *         - -1 si l'utilisateur existe mais le mot de passe est incorrect
     *         - -2 si l'utilisateur n'existe pas 
     * 
     */ 
    function connexion($pseudo, $mdp) {
        // Connexion à la base de données
        $cnx = openBD();
        
        $requete = $cnx->prepare("SELECT pseudo, mdp, role FROM utilisateur WHERE pseudo = :pseudo");
        $requete->bindValue('pseudo', $pseudo, PDO::PARAM_INT);
        $requete->setFetchMode(PDO::FETCH_OBJ);
        
        $resultat = array();
        $return = -2;
        if ($requete->execute()) {
            while ($row = $requete->fetch()) {
                $resultat[0] = $row->pseudo;
                $resultat[1] = $row->mdp;
                $resultat[2] = $row->role;
            }
        }
        
        if (count($resultat) !== 0) {
            // L'utilisateur existe, on contrôle maintenant si le mot de passe correspond
            $return = -1;
            if (password_verify($mdp, $resultat[1])) {
                // Le mot passe associé à l'utilisateur est correct, on renvoie donc le statut
                $return = $resultat[2];
            }
        }
        
        return $return;
    }
    
    /* Créé un utilisateur */
    function createUtilisateur($pseudo, $mail, $mdpH, $nom, $prenom, $naissance,
        $adresse, $cp, $ville) {
            
        $cnx = openBD(); // Connexion à la base de données
            
        $stmt = $cnx->prepare("INSERT INTO utilisateur "
            ."(pseudo, mail, mdp, nom, prenom, naissance, adresse, codePostal, ville, role, supprime) "
            ."VALUES (:pseudo, :mail, :mdp, :nom, :prenom, :naissance, :adresse, :codePostal, :ville, 0, 0)");
        
        $stmt->bindParam(':pseudo', $pseudo);
        $stmt->bindParam(':mail', $mail);
        $stmt->bindParam(':mdp', $mdpH);
        $stmt->bindParam(':nom', $nom);
        $stmt->bindParam(':prenom', $prenom);
        $stmt->bindParam(':naissance', $naissance);
        $stmt->bindParam(':adresse', $adresse);
        $stmt->bindParam(':codePostal', $cp);
        $stmt->bindParam(':ville', $ville);
        $stmt->execute();
            
        closeBD($cnx);        
    }
?>