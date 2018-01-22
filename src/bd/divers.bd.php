<?php
    /* Récupère les informations de connexion dans le config.ini */
    function getConfigBD($argument_config) {
        $tabConfig = parse_ini_file("config.ini");
        return $tabConfig[$argument_config];
    }
    
    /* Connexion à la BD avec PDO */
    function openBD() {
        $cnx = new PDO(getConfigBD("info_bd"), getConfigBD("utilisateur"), getConfigBD("mdp"));
        return $cnx;
    }
    
    /* Fermeture de la connexion de la base de données */
    function closeBD($cnx) {
        $cnx = null;
    }
    
    /* Renvoie la description affichée sur l'écran d'accueil */
    function getDescriptionAccueil() {
        $cnx = openBD(); // Connexion à la base de données
        
        $rqt = "SELECT code, description FROM categorie WHERE code LIKE '\_accueil'";
        $description = $cnx->prepare($rqt);
        $description->setFetchMode(PDO::FETCH_OBJ);
        
        $aRetouner = "";
        if ($description->execute()) {
            $row = $description->fetch();
            $aRetouner = $row->description;
            $description->closeCursor();
        }
        closeBD($cnx);
        return $aRetouner;
    }
?>