<?php
	/* Récupère toutes les catégories disponibles */
	function getListeCategorie() {
		$cnx = openBD(); // Connexion à la base de données
		
		$rqt = "SELECT code, nom, description FROM categorie WHERE code NOT LIKE '\_%'";
		$listecat = $cnx->prepare($rqt);
		$listecat->setFetchMode(PDO::FETCH_OBJ);
					
		$aRetouner = array();
		if ($listecat->execute()) {
			$i=0;
			while($row = $listecat->fetch()) {
			    $aRetouner[$i] = array();
				$aRetouner[$i][0] = $row->code;
				$aRetouner[$i][1] = $row->nom;
				$aRetouner[$i][2] = $row->description;
				$i++;
			}
			$listecat->closeCursor();
		}
		
		closeBD($cnx);
		return $aRetouner;
	}
	
	/* Vérifie si une catégorie existe */
	function isCategorie($aTester) {
	    $cnx = openBD(); // Connexion à la base de données
	    
	    $requete = $cnx->prepare("SELECT count(*) FROM categorie WHERE code = :code");
	    $requete->bindParam(':code', $aTester);
	    $requete->execute();
	    $donnees = $requete->fetch();
	    
	    closeBD($cnx);
	    return $donnees[0] == 1;
	}
?>