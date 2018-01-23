function editerCategorie(codeEdit) {
	var ok = true;
	var code = $('#' + codeEdit + '-code').val().trim();
	var nom = $('#' + codeEdit + '-nom').val().trim();
	
	if (code !== '' && nom !== '') {
		// On fait le contrôle si le code a été édité
		if (codeEdit != code) {
			// Contrôle du code
			$.ajax({
	    		async: false,
	    		url: 'ajax/controlEditCategorie.php',
	    		type: 'POST',
	            dataType: 'json',
	    		data: {
	    			oldCode : codeEdit,
	    			newCode : code
	    		},
	    		complete: function(resultat) {
	    			var json = JSON.parse(resultat.responseJSON);
	    			if (json.total > 0) {
	    				ok = false; // Catégorie déjà existante
	    			}
	    		}
	    	});
		}
		
	}
	return ok;
}