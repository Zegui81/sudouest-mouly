<?php
    include '../bd/divers.bd.php';

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
?>