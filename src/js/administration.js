function validateEditCategorie(codeEdit) {
	// Réinitialisation du formulaire
	$('.remove-error').removeClass('input-error');
	
	var ok = true;
    var listeErreur = [];
	var code = $('#' + codeEdit + '-code').val().trim();
	var nom = $('#' + codeEdit + '-nom').val().trim();
	if (code !== '' && nom !== '') {
		// On fait le contrôle si le code a été édité
		if (codeEdit != code) {
			// Contrôle du code
			$.ajax({
	    		async: false,
	    		url: 'ajax/controlCategorie.php',
	    		type: 'POST',
	            dataType: 'json',
	    		data: {
	    			oldCode : codeEdit,
	    			newCode : code
	    		},
	    		success: function(resultat) {
	    			var json = JSON.parse(resultat);
	    			if (json.total > 0) {
	    				ok = false; // Catégorie déjà existante
	    				$('#' + codeEdit + '-code').addClass('input-error');
	    		    	$('#labelcode-' + codeEdit).addClass('input-error');
	    		    	listeErreur.push('Le code saisi existe déjà.');
	    			}
	    		},
	    		error: function(error) {
					alert(error);
				}
	    	});
		}
		
	} else {
		// Au moins un champ est vide
		if (code === '') {
			$('#' + codeEdit + '-code').addClass('input-error');
	    	$('#labelcode-' + codeEdit).addClass('input-error');
	    	listeErreur.push('Le champ "Code" est obligatoire.');
	    	ok = false;
		}
		
		if (nom === '') {
			$('#' + codeEdit + '-nom').addClass('input-error');
	    	$('#labelnom-' + codeEdit).addClass('input-error');
	    	listeErreur.push('Le champ "Libellé" est obligatoire.');
	    	ok = false;
		}
	}
	return ok;
}

function validateNewCategorie() {
	// Réinitialisation du formulaire
	$('.remove-error').removeClass('input-error');
	
	var ok = true;
    var listeErreur = [];
	var code = $('#new-code').val().trim();
	var nom = $('#new-nom').val().trim();
	
	if (code !== '' && nom !== '') {
		// On contrôle que le code n'existe pas
		$.ajax({
    		async: false,
    		url: 'ajax/controlCategorie.php',
    		type: 'POST',
            dataType: 'json',
    		data: {
    			newCode : code
    		},
    		complete: function(resultat) {
    			var json = JSON.parse(resultat);
    			if (json.total > 0) {
    				$('#new-code').addClass('input-error');
    		    	$('#labelcode-new').addClass('input-error');
    		    	listeErreur.push('Le code saisi existe déjà.');
    				ok = false; // Catégorie déjà existante
    			}
    		}
    	});
	} else {
		// Au moins un champ est vide
		if (code === '') {
			$('#new-code').addClass('input-error');
	    	$('#labelcode-new').addClass('input-error');
	    	listeErreur.push('Le champ "Code" est obligatoire.');
	    	ok = false;
		}
		
		if (nom === '') {
			$('#new-nom').addClass('input-error');
	    	$('#labelnom-new').addClass('input-error');
	    	listeErreur.push('Le champ "Libellé" est obligatoire.');
	    	ok = false;
		}
	}
	return ok;
	
}

/* Importe le formulaire d'ajout de catégorie */
function addCategorie() {
	if ($('#newCategorie').length === 0) {
		$('#listeCategorie').append('<form id="newCategorie" class="liste-item-inscription item-admin" enctype="multipart/form-data" name="adminCategorie"'
						+ 'method="POST" onsubmit="return validateNewCategorie()" action="action/doAddCategorie.php"></form>')
		$('#newCategorie').load('form/adminAjoutCategorie.html');
	}
}

/* Supprime le formulaire d'ajout de catégorie */
function removeNewCategorie() {
	$('#newCategorie').remove();
}

/* Supprime une catégorie */
function deleteCategorie(code) {
	if (confirm('Supprimer la catégorie supprimera également les produits associés. Voulez-vous continuer ?')) {
		window.location.replace('action/doDeleteCategorie.php?code=' + code);
	}
}