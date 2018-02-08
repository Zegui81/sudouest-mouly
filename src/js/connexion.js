function openPopupConnexion() {
	$('body').prepend('<div class="overlay" id="popupConnexion" style="display: block;"></div>');
    $('#popupConnexion').load('form/connexion.html');
}

function closePopupConnexion() {
	$('#popupConnexion').remove();
}

function validateConnexion() {
	// Réinitialisation du formulaire
	$('#connexion-error').empty();
	$('#connexion-error').removeClass('error-form-popup');
	
	var ok = true;
	var statut = -2;
	var pseudo = $('#pseudo').val();
	var mdp = $('#mdp').val();
	var erreur = '';
	if (pseudo === '' || mdp === '') {
		erreur = 'Vous devez renseigner les deux champs.';
		ok = false;
	} else {
		// Contrôle de la validité
		$.ajax({
    		async: false,
    		url: 'ajax/controlConnexion.php',
    		type: 'POST',
            dataType: 'json',
    		data: {
    			pseudo : pseudo,
    			mdp : mdp
    		},
    		complete: function(resultat) {
    			var json = JSON.parse(resultat.responseJSON);
    			if (json.statut == -2) {
    				erreur = 'Le pseudo saisi ne correspond à aucun compte actif.';
    				ok = false;
    			} else if (json.statut == -1) {
    				erreur = 'Le mot de passe pour ce compte est incorrect.';
    				ok = false;
    			}
    		}
    	});
	}
	
    if (!ok) {
    	$('#connexion-error').addClass('error-form-popup');
    	$('#connexion-error').append(erreur);
    }
	return ok;
}