/* Avant d'ajouter au panier, on vérifie qu'un utilisateur soit connecté */
function verificationConnexion(pseudo, idProduit) {
	if (pseudo == null) {
		// Personne n'est connecté, on affiche la popup de connexion
		openPopupConnexion();
	} else {
		// On effectue l'ajout et on ré-affiche la page 
		window.location.replace('action/doAjoutPanier.php?produit=' + idProduit
				+ '&quantite=' + $('#quantite').val());
	}

}