<?php
    /* Teste si l'email passé en argument appartient à un compte */
    function existMail($mail) {
        $cnx = openBD(); // Connexion à la base de données
            
        $requete = $cnx->prepare("SELECT * FROM utilisateur WHERE mail = :mail");
        $requete->bindValue('mail', $mail, PDO::PARAM_INT);
        $requete->execute();
        $donnees = $requete->fetch();
        
        closeBD($cnx);
        return count($donnees['mail']);
    }
    
    /* Teste si le pseudo passé en argument appartient à un compte */
    function existPseudo($pseudo) {
        $cnx = openBD(); // Connexion à la base de données
        
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
        $cnx = openBD(); // Connexion à la base de données
        
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
    
    /* Permet d'obtenir la liste des utilisateurs */
    function getListeUtilisateur() {
        $cnx = openBD(); // Connexion à la base de données
        
        $requete = $cnx->prepare("SELECT pseudo, mail, role FROM utilisateur");
        $requete->setFetchMode(PDO::FETCH_OBJ);
        
        $aRetouner = array();
        if ($requete->execute()) {
            $i = 0;
            while($row = $requete->fetch()) {
                $aRetouner[$i] = new Utilisateur();
                $aRetouner[$i]->setPseudo($row->pseudo);
                $aRetouner[$i]->setMail($row->mail);
                $aRetouner[$i]->setRole($row->role);
                $i++;
            }
            $requete->closeCursor();
        }
        $requete->execute();
        
        closeBD($cnx);     
        return $aRetouner;
    }
    
    /* Recherche un utilisateur grâce à son pseudo */
    function getUtilisateurByPseudo($pseudo) {
        $cnx = openBD(); // Connexion à la base de données
        
        $rqt = "SELECT * FROM utilisateur WHERE pseudo = :pseudo";
        $requete = $cnx->prepare($rqt);
        $requete->bindParam(':pseudo', $pseudo);
        $requete->setFetchMode(PDO::FETCH_OBJ);
        
        $user = new Utilisateur();
        $i = 0;
        if ($requete->execute()) {
            while ($row = $requete->fetch()) {
                $user->setPseudo($row->pseudo);
                $user->setMail($row->mail);
                $user->setNom($row->nom);
                $user->setPrenom($row->prenom);
                $user->setNaissance($row->naissance);
                $user->setAdresse($row->adresse);
                $user->setCodePostal($row->codePostal);
                $user->setVille($row->ville);
                $user->setRole($row->role);
                $user->setSupprime($row->supprime);
                $i++;
            }
        }
        closeBD($cnx);
        return $user;
    }
?>