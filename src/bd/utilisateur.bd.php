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
        
        return count($donnees['pseudo']);
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
        
        header('Location: index.php');
    }
?>