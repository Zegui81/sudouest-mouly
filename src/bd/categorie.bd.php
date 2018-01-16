<?php

	/* Récupère les informations de la BD dans le config.ini */
	function getListeCategorie() {
		$cnx = openBD(); // Connexion à la base de données
		
		$rqt = "SELECT code, nom, description FROM categorie WHERE code NOT LIKE '\_%'";
		$listecat = $cnx->prepare($rqt);
		$listecat->setFetchMode(PDO::FETCH_OBJ);
					
		$aRetouner = array(array());
		if ($listecat->execute()) {
			$i=0;
			while($row = $listecat->fetch()) {
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

?>