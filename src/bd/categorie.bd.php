<?php
	/* Récupère toutes les catégories disponibles */
	function getListeCategorie() {
		$cnx = openBD(); // Connexion à la base de données
		
		$rqt = "SELECT code, nom FROM categorie WHERE code NOT LIKE '\_%'";
		$listecat = $cnx->prepare($rqt);
		$listecat->setFetchMode(PDO::FETCH_OBJ);
					
		$aRetouner = array();
		if ($listecat->execute()) {
			$i=0;
			while($row = $listecat->fetch()) {
			    $aRetouner[$i] = new Categorie();
				$aRetouner[$i]->setCode($row->code);
				$aRetouner[$i]->setNom($row->nom);
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
	
	/* Contrôle si l'insertion d'un code d'une catégorie est possible */
	function controlCodeForInsert($nouveau) {
	    $cnx = openBD(); // Connexion à la base de données
	    
	    $requete = $cnx->prepare("SELECT count(*) FROM categorie WHERE code = :nouveau");
	    $requete->bindParam(':nouveau', $nouveau);
	    $requete->execute();
	    $donnees = $requete->fetch();
	    
	    closeBD($cnx);
	    return $donnees[0];
	}
	
	/* Contrôle si la modification du code d'une catégorie est possible */
	function controlCodeForUpdate($ancien, $nouveau) {
	    $cnx = openBD(); // Connexion à la base de données
	    
	    $requete = $cnx->prepare("SELECT COUNT(*) AS total FROM categorie WHERE code <> :ancien AND code = :nouveau");
	    $requete->bindParam(':ancien', $ancien);
	    $requete->bindParam(':nouveau', $nouveau);
	    $requete->execute();
	    $donnees = $requete->fetch();
	    
	    closeBD($cnx);
	    return $donnees['total'];
	}
	
	/* Ajoute une catégorie */
	function addCategorie($code, $nom) {
	    $cnx = openBD(); // Connexion à la base de données
	    
	    $stmt = $cnx->prepare("INSERT INTO categorie (code, nom) VALUES (:code, :nom)");
	    $stmt->bindParam(':code', $code);
	    $stmt->bindParam(':nom', $nom);
	    $stmt->execute();
	    
	    closeBD($cnx);  
	}
	
	/* Met à jour une catégorie */
	function updateCategorie($oldCode, $newCode, $nom) {
	    $cnx = openBD(); // Connexion à la base de données
	    
	    $stmt = $cnx->prepare("UPDATE categorie SET code = :newCode, nom = :nom "
	        ."WHERE code = :oldCode");
	    $stmt->bindParam(':oldCode', $oldCode);
	    $stmt->bindParam(':newCode', $newCode);
	    $stmt->bindParam(':nom', $nom);
	    $stmt->execute();
	    
	    closeBD($cnx);  
	}
	
	/* Supprime une catégorie en entrainant ses produits associés */
	function removeCategorie($code) {
	    $cnx = openBD(); // Connexion à la base de données
	    
	    $stmt = $cnx->prepare("DELETE FROM categorie WHERE code = :code");
	    $stmt->bindParam(':code', $code);
	    $stmt->execute();
	    
	    closeBD($cnx);  
	}
?>