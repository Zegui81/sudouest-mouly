<!DOCTYPE HTML>
<HTML>
	
	<?php
	
	function getConfigBD($argument_config) 
	{
		$tabConfig = parse_ini_file("config.ini");		
		return $tabConfig[$argument_config];
	}

	/* Connexion à la BD avec PDO */
	function openBD()
	{
		$cnx = new PDO(getConfigBD("info_bd"),getConfigBD("utilisateur"),getConfigBD("mdp"));		
		return $cnx;
	}
	
	/* Fermeture de la connexion à la bse de données */
	function closeBD($cnx)
	{
		$cnx = null;
	}
	
	/* =========================================================================
				Fonctions connexion
	========================================================================= */
	
	/* Récupère le status d'un utilisateur (admin/client) */
	function recup_status($pseudo) {
		// Connexion à la base de données
		$cnx = openBD();
	
		$requete = $cnx->prepare("SELECT status FROM utilisateur WHERE pseudo = :pseudo"); 
		$requete->bindValue('pseudo', $pseudo);
		$requete->execute();
		$ligne = $requete->fetch(PDO::FETCH_ASSOC);
		$status = $ligne['status'];
		return $status;
	}
	
	function recup_mdp($pseudo) {
		// Connexion à la base de données
		$cnx = openBD();
		
		$requete = $cnx->prepare("SELECT mdp FROM utilisateurs WHERE pseudo = :pseudo"); 
		$requete->bindValue('pseudo', $pseudo);
		$requete->execute();
		$resultat = $requete->fetch(PDO::FETCH_ASSOC);
		$mdp = $resultat['mdp'];
		return $mdp;
	}
	
	
	/* =========================================================================
				Fonctions d'administration des produits
	========================================================================= */
	
	/* Permet de modifier un produit */
	function modif_produit($categorie, $nom, $prix, $promotion, $description, $id)
	{
		// Connexion à la base de données
		$cnx = openBD();
		
		$stmt = $cnx->prepare("UPDATE produits SET nomProduit = ?,prixProduit = ?, promotion = ?, descriptionProduit = ?, idCategorie = ? WHERE idProduit = ?");
		$stmt->bindParam(1, $nom);
		$stmt->bindParam(2, $prix);
		$stmt->bindParam(3, $promotion);
		$stmt->bindParam(4, $description);
		$stmt->bindParam(5, $categorie);
		$stmt->bindParam(6, $id);
		
		if ($stmt->execute()){
			return true;
		} else {
			return false;
		}	
	}
	
	/* Permet de modifie la description d'une image pour un produit */
	function modif_description_image_produit($descriptionPhoto, $id)
	{
		// Connexion à la base de données
		$cnx = openBD();
		
		$stmt = $cnx->prepare("UPDATE photos SET descriptionPhoto = ? WHERE idProduit = ?");
		$stmt->bindParam(1, $descriptionPhoto);
		$stmt->bindParam(2, $id);
		
		if ($stmt->execute()){
			return true;
		} else {
			return false;
		}
	}
	
	/* Permet de modifier l'image d'un produit */
	function modif_image_produit($id,$image)
	{
		// Connexion à la base de données
		$cnx = openBD();
		
		$stmt = $cnx->prepare("UPDATE photos SET adresse = ? WHERE idProduit = ?");
		$stmt->bindParam(1, $image);
		$stmt->bindParam(2, $id);
		
		if ($stmt->execute()){
			return true;
		} else {
			return false;
		}	
	}
	
	/* Permet d'ajouter un produit */
	function ajout_produit($categorie, $nom, $prix, $promotion, $description)
	{
		// Connexion à la base de données
		$cnx = openBD();
		
		$stmt = $cnx->prepare("INSERT INTO produits (idCategorie, nomProduit, prixProduit, promotion, descriptionProduit) VALUES (?,?,?,?,?)");
		$stmt->bindParam(1, $categorie);
		$stmt->bindParam(2, $nom);
		$stmt->bindParam(3, $prix);
		$stmt->bindParam(4, $promotion);
		$stmt->bindParam(5, $description);
		
		if ($stmt->execute()){
			
			$idProduit = 0;
		
			$requete = $cnx->prepare("SELECT idProduit FROM produits WHERE nomProduit = ? AND descriptionProduit = ?"); 
			$requete->bindParam(1, $nom);
			$requete->bindParam(2, $description);
			$requete->execute();			
			$donnees = $requete->fetch();		
			
			return $donnees['idProduit'];
		} else {
			return -1;
		}
	}
	
	/* Permet d'ajouter une image pour un produit dans la base de données */
	function ajout_image_produit($id, $image, $descriptionPhoto)
	{
		// Connexion à la base de données
		$cnx = openBD();
		
		$stmt = $cnx->prepare("INSERT INTO photos (adresse, descriptionPhoto, idProduit) VALUES (?,?,?)");
		$stmt->bindParam(1, $image);
		$stmt->bindParam(2, $descriptionPhoto);
		$stmt->bindParam(3, $id);
		
		if ($stmt->execute()){
			return true;
		}else {
			return false;
		}
	}
	
	/* Permet de supprimer les photos du produit */
	function supprimer_photos_produit($id)
	{
		// Connexion à la base de données
		$cnx = openBD();
		
		$stmt = $cnx->prepare("DELETE FROM photos WHERE idProduit = ?");
		$stmt->bindParam(1, $id);
		
		if ($stmt->execute()){
			return true;
		} else {
			return false;
		}		
	}
	
	/* Permet de retirer un produiut du pnaier de l'utilisateur avant de supprimer ce produit de sa catégorie */
	function supprimer_produit_des_paniers($id)
	{
		// Connexion à la base de données
		$cnx = openBD();
		
		$stmt = $cnx->prepare("DELETE FROM panier WHERE idProduit = ?");
		$stmt->bindParam(1, $id);
		
		if ($stmt->execute()){
			return true;
		} else {
			return false;
		}		
	}
	
	/* Permet de supprimer un produit */
	function supprimer_produit($id)
	{
		// Connexion à la base de données
		$cnx = openBD();
		
		$stmt = $cnx->prepare("DELETE FROM produits WHERE idProduit = ?");
		$stmt->bindParam(1, $id);
		
		if ($stmt->execute()){
			return true;
		} else {
			return false;
		}		
	}
		
	/* =========================================================================
				Fonctions d'administration des catégories
	========================================================================= */
	
	/* Retourne la liste des catégories */
	function recup_liste_categories(){
		
		$cnx = openBD();
		
		// Une requête pour récupérer les catégories
		$rqtdep = "SELECT idcategorie, nomCategorie, descriptionCategorie, adressePhoto
		           FROM categories ORDER BY nomCategorie";
		$listecat = $cnx->prepare($rqtdep);
		$listecat->setFetchMode(PDO::FETCH_OBJ);
		
		$i=0;	// compteur utilisé dans le tableau
		
		$tab = array(array());
		
		if ($listecat->execute()){
			// Récupération et affichage de la liste des photos
			while($row = $listecat->fetch())
			{
				$tab[$i][0] = $row->idcategorie;
				$tab[$i][1] = $row->nomCategorie;
				$tab[$i][2] = $row->descriptionCategorie;
				$tab[$i][3] = $row->adressePhoto;
				$i++;
			}
				$listecat->closeCursor();
		}
		$listecat->closeCursor();
		return $tab;
	}
	
	/* Permet de modifier une catégorie */
	function modif_categorie($id,$nom,$description)
	{
		// Connexion à la base de données
		$cnx = openBD();
		
		$stmt = $cnx->prepare("UPDATE categories SET nomCategorie = ?, descriptionCategorie = ? WHERE idcategorie = ?");
		$stmt->bindParam(1, $nom);
		$stmt->bindParam(2, $description);
		$stmt->bindParam(3, $id);
		
		if ($stmt->execute()){
			return true;
		} else {
			return false;
		}	
	}
	
	/* Permet de modifier l'image d'une catégorie */
	function modif_image_categorie($id,$image)
	{
		// Connexion à la base de données
		$cnx = openBD();
		
		$stmt = $cnx->prepare("UPDATE categories SET adressePhoto = ? WHERE idcategorie = ?");
		$stmt->bindParam(1, $image);
		$stmt->bindParam(2, $id);
		
		if ($stmt->execute()){
			return true;
		} else {
			return false;
		}	
	}
	
	/* Permet d'ajouter une catégorie */
	function ajout_categorie($nom, $description, $adresse)
	{
		// Connexion à la base de données
		$cnx = openBD();
		
		$stmt = $cnx->prepare("INSERT INTO categories (nomCategorie,descriptionCategorie,adressePhoto) VALUES (?,?,?)");
		$stmt->bindParam(1, $nom);
		$stmt->bindParam(2, $description);
		$stmt->bindParam(3, $adresse);
		
		if ($stmt->execute()){
			return true;
		} else {
			return false;
		}
	}
	
	/* Permet de supprimer tout les produits d'une catégorie avant de supprimer la catégorie */
	function supprimer_produit_categorie($id)
	{
		// Connexion à la base de données
		$cnx = openBD();
		
		$stmt = $cnx->prepare("DELETE FROM produits WHERE idcategorie = ?");
		$stmt->bindParam(1, $id);
		
		if ($stmt->execute()){
			return true;
		} else {
			return false;
		}	
	}
	
	/* Permet de supprimer une catégorie */
	function supprimer_categorie($id)
	{
		// Connexion à la base de données
		$cnx = openBD();
		
		$stmt = $cnx->prepare("DELETE FROM categories WHERE idcategorie = ?");
		$stmt->bindParam(1, $id);
		
		if ($stmt->execute()){
			return true;
		} else {
			return false;
		}		
	}
	
	/* =========================================================================
				Fonctions d'administration des utilisateurs
	========================================================================= */
	
	/* Fonction de récupération des utilisateurs */
	function recup_liste_utilisateurs(){
		
		$cnx = openBD();
		
		// Une requête pour récupérer les catégories
		$rqtdep = "SELECT pseudo, prenom, nom, courriel, date, adresse, status
		           FROM utilisateurs ORDER BY pseudo";
		$listecat = $cnx->prepare($rqtdep);
		$listecat->setFetchMode(PDO::FETCH_OBJ);
		
		$i=0;	// compteur utilisé dans le tableau
		
		$tab = array(array());
		
		if ($listecat->execute()){
			// Récupération et affichage de la liste des photos
			while($row = $listecat->fetch())
			{
				$tab[$i][0] = $row->pseudo;
				$tab[$i][1] = $row->prenom;
				$tab[$i][2] = $row->nom;
				$tab[$i][3] = $row->courriel;
				$tab[$i][4] = $row->date;
				$tab[$i][5] = $row->adresse;
				$tab[$i][6] = $row->status;
				$i++;
			}
				$listecat->closeCursor();
		}
		$listecat->closeCursor();
		return $tab;
	}
	
	/* Permet de supprimer un utilisateur */
	function supprimer_utilisateur($pseudo)
	{
		// Connexion à la base de données
		$cnx = openBD();
		
		$stmt = $cnx->prepare("DELETE FROM utilisateurs WHERE pseudo = ?");
		$stmt->bindParam(1, $pseudo);
		
		if ($stmt->execute()){
			return true;
		} else {
			return false;
		}		
	}
	
	/* Permet de supprimer le panier d'un utilisateur */
	function supprimer_panier_utilisateur($pseudo)
	{
		// Connexion à la base de données
		$cnx = openBD();
		
		$stmt = $cnx->prepare("DELETE FROM panier WHERE utilisateur = ?");
		$stmt->bindParam(1, $pseudo);
		
		if ($stmt->execute()){
			return true;
		} else {
			return false;
		}		
	}
	
	/* Permet de modifier le status d'un utilisateur */
	function modif_status_utilisateur($pseudo, $status)
	{
		// Connexion à la base de données
		$cnx = openBD();
		
		$stmt = $cnx->prepare("UPDATE utilisateurs SET status = ? WHERE pseudo = ?");
		$stmt->bindParam(1, $status);
		$stmt->bindParam(2, $pseudo);
		
		if ($stmt->execute()){
			return true;
		} else {
			return false;
		}	
	}
	
	/* =========================================================================
				Fonctions relative au panier
	========================================================================= */
	
	/* Permet de récupérer le contenu du panier pour un utilisateur */
	function recup_contenu_panier($pseudo) {
		// Connexion à la base de données
		$cnx = openBD();
		
		$rqt = "SELECT panier.idPanier, panier.idProduit, panier.nomProduit, quantite, prixProduit, promotion, nomCategorie
		           FROM panier
				   JOIN produits
				   ON produits.idProduit = panier.idProduit
				   JOIN categories
				   ON produits.idcategorie = categories.idCategorie
				   WHERE utilisateur = ?";
		$liste = $cnx->prepare($rqt);
		$liste->bindParam(1, $pseudo);
		$liste->setFetchMode(PDO::FETCH_OBJ);
		
		$i=0;	// compteur utilisé dans le tableau
		
		$tab = array(array());
		
		if ($liste->execute()){
			// Récupération et affichage de la liste des photos
			while($row = $liste->fetch())
			{
				$tab[$i][0] = $row->idPanier;
				$tab[$i][1] = $row->idProduit;
				$tab[$i][2] = $row->nomProduit;
				$tab[$i][3] = $row->quantite;
				$tab[$i][4] = $row->prixProduit;
				$tab[$i][5] = $row->promotion;
				$tab[$i][6] = $row->nomCategorie;
				$i++;
			}
				$liste->closeCursor();
		}
		$liste->closeCursor();
		return $tab;
	}
	
	/* Permet d'ajouter le produit dans le panier de l'utilisateur */
	function ajout_produit_Panier($pseudo, $id, $nom)
	{
		// Connexion à la base de données
		$cnx = openBD();
		
		$stmt = $cnx->prepare("INSERT INTO panier (idProduit,nomProduit,quantite,utilisateur) VALUES (?,?,1,?)");
		$stmt->bindParam(1, $id);
		$stmt->bindParam(2, $nom);
		$stmt->bindParam(3, $pseudo);
		
		if ($stmt->execute()){
			return true;
		} else {
			return false;
		}		
	}
	
	/* Permet de supprimer le produit du panier de l'utilisateur */
	function supprimer_produit_Panier($pseudo, $id)
	{
		// Connexion à la base de données
		$cnx = openBD();
		
		$stmt = $cnx->prepare("DELETE FROM panier WHERE idProduit = ? AND utilisateur = ?");
		$stmt->bindParam(1, $id);
		$stmt->bindParam(2, $pseudo);
		
		if ($stmt->execute()){
			return true;
		} else {
			return false;
		}		
	}
	
	/* Permet de savoir si l'utilisateur veut ajouter un produit déjà présent dans son panier */
	function estPresentPanier($id, $pseudo)
	{
			// Connexion à la base de données
			$cnx = openBD();
			
			$nbproduit = 0;
		
			$requete = $cnx->prepare("SELECT * FROM panier WHERE utilisateur = ? AND idProduit = ?"); 
			$requete->bindParam(1, $pseudo);
			$requete->bindParam(2, $id);
			$requete->execute();			
			$donnees = $requete->fetch();		
			
			return count($donnees['idProduit']);
	}
	
	/* Permet de récupérer la quantité d'un produit présent dans le panier de l'utilisateur */
	function recup_quantite_panier($pseudo, $id)
	{
		// Connexion à la base de données
		$cnx = openBD();
	
		$requete = $cnx->prepare("SELECT quantite FROM panier WHERE utilisateur = ? AND idProduit = ?"); 
		$requete->bindParam(1, $pseudo);
		$requete->bindParam(2, $id);
		$requete->execute();			
		$donnees = $requete->fetch();		
		
		return $donnees['quantite'];
	}
	
	/* Permet de modifier la quantité d'un produit dans le panier de l'utilisateur */
	function ajout_quantite_Panier($pseudo, $id, $quantite)
	{
		// Connexion à la base de données
		$cnx = openBD();
		
		$stmt = $cnx->prepare("UPDATE panier SET quantite = ? WHERE idProduit = ? AND utilisateur = ?");
		$stmt->bindParam(1, $quantite);
		$stmt->bindParam(2, $id);
		$stmt->bindParam(3, $pseudo);
		
		if ($stmt->execute()){
			return true;
		} else {
			return false;
		}	
	}
	
	/* =========================================================================
				Fonctions Inscription d'un nouvel utilisateur
	========================================================================= */
	
		/* Vérification de la disponibilité du pseudo */
		function verif_pseudo($pseudo)
		{		
			// Connexion à la base de données
			$cnx = openBD();
			
			$nbpseudo = 0;
		
			$requete = $cnx->prepare("SELECT * FROM utilisateurs WHERE pseudo = :pseudo"); 
			$requete->bindValue('pseudo', $pseudo, PDO::PARAM_INT);
			$requete->execute();			
			$donnees = $requete->fetch();		
			
			return count($donnees['pseudo']);
		}
		
		/* Ajout de l'utilisateur dans la base de données */
		function ajout_utilisateur($pseudo,$mdpH,$prenom,$nom,$courriel,$date, $adresse, $status){
			
			// Connexion à la base de données
			$cnx = openBD();
			
			$stmt = $cnx->prepare("INSERT INTO utilisateurs (pseudo, mdp, prenom, nom, courriel, date, adresse, status) VALUES (?,?,?,?,?,?,?,?)");
			$stmt->bindParam(1, $pseudo);
			$stmt->bindParam(2, $mdpH); 	// Ajouter champs adresse
			$stmt->bindParam(3, $prenom);
			$stmt->bindParam(4, $nom);
			$stmt->bindParam(5, $courriel);
			$stmt->bindParam(6, $date);
			$stmt->bindParam(7, $adresse);
			$stmt->bindParam(8, $status);
			
			if ($stmt->execute()){
				return true;
			} else {
				return false;
			}
		}
		
	/* =========================================================================
					Fonctions de récupération des données
	========================================================================= */		
		
	function liste_categorie()
	{
		// Connexion à la base de données
		$cnx = openBD();
		
		// Une requête pour récupérer les catégories
		$rqtdep = "SELECT idCategorie, nomCategorie, adressePhoto
		           FROM categories";
		$listecat = $cnx->prepare($rqtdep);
		$listecat->setFetchMode(PDO::FETCH_OBJ);
		
		$i=0;	// compteur utilisé dans le tableau
		
		$tab = array(array());
		
		if ($listecat->execute()){
			// Récupération et affichage de la liste des photos
			while($row = $listecat->fetch())
			{
				$tab[$i][0] = $row->idCategorie;
				$tab[$i][1] = $row->nomCategorie;
				$tab[$i][2] = $row->adressePhoto;
				$i++;
			}
				$listecat->closeCursor();
		}
		$listecat->closeCursor();
		return $tab;
	}
	
	/* Fonction de récupération des informations d'un seul produit */
	function recup_info_produit($produit)
	{
		// Connexion à la base de données
		$cnx = openBD();
		
		// Une requête pour récupérer les villes de la BD
		$rqtdep = "SELECT idProduit, nomProduit, prixProduit, promotion, descriptionProduit, idCategorie
		           FROM produits WHERE idProduit = ?";
		$listecat = $cnx->prepare($rqtdep);
		$listecat->setFetchMode(PDO::FETCH_OBJ);
		
		$tab = array();
		
		if ($listecat->execute(array($produit))){
			// Récupération et affichage de la liste des photos
			while($row = $listecat->fetch())
			{
				$tab[0] = $row->idProduit;
				$tab[1] = $row->nomProduit;
				$tab[2] = $row->prixProduit;
				$tab[3] = $row->promotion;
				$tab[4] = $row->descriptionProduit;
				$tab[5] = $row->idCategorie;
			}
				$listecat->closeCursor();
		}
		$listecat->closeCursor();
		return $tab;
	}
	
	/* Permet de récupérer la liste des produits de la même catégorie */
	function recup_produits_meme_categorie($idCategorie, $idProduit)
	{
		// Connexion à la base de données
		$cnx = openBD();
		
		// Une requête pour récupérer les villes de la BD
		$rqtdep = "SELECT produits.idProduit, nomProduit, prixProduit, promotion, adresse, descriptionPhoto
				   FROM produits
				   JOIN photos
				   ON produits.idProduit = photos.idProduit
				   WHERE idcategorie = ?
				   AND produits.idProduit != ?";
		$requete = $cnx->prepare($rqtdep);
		$requete->bindValue(1, $idCategorie);
		$requete->bindValue(2, $idProduit);
		$requete->setFetchMode(PDO::FETCH_OBJ);
		
		$tab = array(array());
		$i = 0;
		
		if ($requete->execute()){
			// Récupération et affichage de la liste des photos
			while($row = $requete->fetch())
			{
				$tab[$i][0] = $row->idProduit;
				$tab[$i][1] = $row->nomProduit;
				$tab[$i][2] = $row->prixProduit;
				$tab[$i][3] = $row->promotion;
				$tab[$i][4] = $row->adresse;
				$tab[$i][5] = $row->descriptionPhoto;
				$i++;
			}
				$requete->closeCursor();
		}
		$requete->closeCursor();
		return $tab;
	}
	
	/* Permet de récupérer la liste des produits en promotion */
	function recup_produits_promotion()
	{
		// Connexion à la base de données
		$cnx = openBD();
		
		// Une requête pour récupérer les villes de la BD
		$rqtdep = "SELECT produits.idProduit, nomProduit, prixProduit, promotion, adresse, descriptionPhoto
				   FROM produits
				   JOIN photos
				   ON produits.idProduit = photos.idProduit
				   WHERE promotion <> 1";
		$listecat = $cnx->prepare($rqtdep);
		$listecat->setFetchMode(PDO::FETCH_OBJ);
		
		$tab = array(array());
		$i = 0;
		
		if ($listecat->execute()){
			// Récupération et affichage de la liste des photos
			while($row = $listecat->fetch())
			{
				$tab[$i][0] = $row->idProduit;
				$tab[$i][1] = $row->nomProduit;
				$tab[$i][2] = $row->prixProduit;
				$tab[$i][3] = $row->promotion;
				$tab[$i][4] = $row->adresse;
				$tab[$i][5] = $row->descriptionPhoto;
				$i++;
			}
				$listecat->closeCursor();
		}
		$listecat->closeCursor();
		return $tab;
	}
	
	/* Fonction de récupération des photos d'un produit */
	function recup_photos_produit($idProduit)
	{
		// Connexion à la base de données
		$cnx = openBD();
		
		// Une requête pour récupérer les villes de la BD
		$rqtdep = "SELECT idPhoto, adresse, descriptionPhoto, idProduit
		           FROM photos WHERE idProduit = ?";
		$listecat = $cnx->prepare($rqtdep);
		$listecat->setFetchMode(PDO::FETCH_OBJ);
		
		$tab = array();
		
		$i = 0;
		
		if ($listecat->execute(array($idProduit))){
			// Récupération et affichage de la liste des photos
			while($row = $listecat->fetch())
			{
				$tab[$i][0] = $row->idPhoto;
				$tab[$i][1] = $row->adresse;
				$tab[$i][2] = $row->descriptionPhoto;
				
				$i++;
			}
				$listecat->closeCursor();
		}
		$listecat->closeCursor();
		return $tab;
	}
	
	/* Fonction de récupération des informations d'une catégorie */
	function recup_info_categorie($categorie)
	{
		// Connexion à la base de données
		$cnx = openBD();
		
		// Une requête pour récupérer les villes de la BD
		$rqtdep = "SELECT nomCategorie, descriptionCategorie, adressePhoto
		           FROM categories WHERE idCategorie = ?";
		$listecat = $cnx->prepare($rqtdep);
		$listecat->setFetchMode(PDO::FETCH_OBJ);
		
		$tab = array();
		
		if ($listecat->execute(array($categorie))){
			// Récupération et affichage de la liste des photos
			while($row = $listecat->fetch())
			{
				$tab[0] = $row->nomCategorie;
				$tab[1] = $row->descriptionCategorie;
				$tab[2] = $row->adressePhoto;
			}
				$listecat->closeCursor();
		}
		$listecat->closeCursor();
		return $tab;
	}
	
	/* Fonction de récupération des produits suite à une recherche */
	function recup_liste_produits_recherche($recherche)
	{
		// Connexion à la base de données
		$cnx = openBD();
		
		$rqtdep = "SELECT produits.idProduit, nomProduit, prixProduit, promotion, adresse, descriptionPhoto
				   FROM produits
				   JOIN photos
				   ON produits.idProduit = photos.idProduit
				   WHERE nomProduit COLLATE UTF8_GENERAL_CI LIKE ?";
		$listecat = $cnx->prepare($rqtdep);
		$listecat->bindValue(1, "%".$recherche."%");
		$listecat->setFetchMode(PDO::FETCH_OBJ);
		
		$tab = array(array());
		$i = 0;
		
		if ($listecat->execute()){
			// Récupération et affichage de la liste des photos
			while($row = $listecat->fetch())
			{
				$tab[$i][0] = $row->idProduit;
				$tab[$i][1] = $row->nomProduit;
				$tab[$i][2] = $row->prixProduit;
				$tab[$i][3] = $row->promotion;
				$tab[$i][4] = $row->adresse;
				$tab[$i][5] = $row->descriptionPhoto;
				$i++;
			}
				$listecat->closeCursor();
		}
		$listecat->closeCursor();
		return $tab;
	}
	
	/* Fonction qui permet de retourner la liste des produits d'une catégorie */
	function recup_liste_produits($categorie)
	{
		// Connexion à la base de données
		$cnx = openBD();
		
		// Une requête pour récupérer les produits
		$rqtdep = "SELECT produits.idProduit, nomProduit, prixProduit, promotion, adresse, descriptionPhoto
				   FROM produits
				   JOIN photos
				   ON produits.idProduit = photos.idProduit
				   WHERE idCategorie = ?";
		$listecat = $cnx->prepare($rqtdep);
		$listecat->setFetchMode(PDO::FETCH_OBJ);
		
		$tab = array(array());
		$i = 0;
		
		if ($listecat->execute(array($categorie))){
			// Récupération et affichage de la liste des photos
			while($row = $listecat->fetch())
			{
				$tab[$i][0] = $row->idProduit;
				$tab[$i][1] = $row->nomProduit;
				$tab[$i][2] = $row->prixProduit;
				$tab[$i][3] = $row->promotion;
				$tab[$i][4] = $row->adresse;
				$tab[$i][5] = $row->descriptionPhoto;
				$i++;
			}
				$listecat->closeCursor();
		}
		$listecat->closeCursor();
		return $tab;
	}
		
	/* =========================================================================
				Fonctions relatives aux photos
	========================================================================= */
	
		/* Fonction de récupération des images des produits en promotion */
		function recup_images($insee)
		{
			// Connexion à la base de données
			$cnx = openBD();
			
			$tab = array();
			$i=0;	// compteur utilisé dans le tableau
			// Exécution d'une requête 
			$listephoto = $cnx->prepare("SELECT adresse_photo FROM images WHERE insee_ville = ?");
			if ($listephoto->execute(array($insee))){
				// Récupération et affichage de la liste des photos
				while($row = $listephoto->fetch())
				{
					$tab[$i]=$row['adresse_photo'];
					$i++;
				}
					$listephoto->closeCursor();
			}
			return $tab;
		}
		
		
		/* Fonction de récupération d'une image d'un produit */
		function recup_images_produits($produit)
		{
			// Connexion à la base de données
			$cnx = openBD();
			
			$tab = array();
			$i=0;	// compteur utilisé dans le tableau
			// Exécution d'une requête 
			$listephoto = $cnx->prepare("SELECT adresse_photo FROM images WHERE insee_ville = ?");
			if ($listephoto->execute(array($insee))){
				// Récupération et affichage de la liste des photos
				while($row = $listephoto->fetch())
				{
					$tab[$i]=$row['adresse_photo'];
					$i++;
				}
					$listephoto->closeCursor();
			}
			return $tab;
		}
	
	?>

</HTML>