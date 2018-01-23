function keyPressOnSearch(evt) {
	var search = $('#search').val().trim(); // Contenu recherché
	
	if (evt.keyCode == 13 && search !== '') {
		// Bouton "Entrée" pressé et du contenu a été trouvé
		window.location.replace('listeProduit.php?search=' + search);
	}
}