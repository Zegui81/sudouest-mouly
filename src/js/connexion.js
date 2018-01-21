function openPopupConnexion() {
	$('body').prepend('<div class="overlay" id="popupConnexion" style="display: block;"></div>');
    $('#popupConnexion').load('form/connexion.html');
}

function closePopupConnexion() {
	$('#popupConnexion').remove();
}

function validateConnexion() {
	var ok = true;
	var statut = -2;
	var pseudo = $('#pseudo').val();
	var mdp = $('#mdp').val();
	
	if (pseudo === '' || mdp === '') {
		ok = false;
	} else {
		// Contrôle de la validité
		$.ajax({
    		async: false,
    		url: 'ajax/tryConnexion.php',
    		type: 'POST',
            dataType: 'json',
    		data: {
    			pseudo : pseudo,
    			mdp : mdp
    		},
    		complete: function(resultat) {
    			var json = JSON.parse(resultat.responseJSON);
    			if (json.statut < 0) {
    				ok = false; // Identification ratée
    			}
    		}
    	});
	}
	return ok;
}