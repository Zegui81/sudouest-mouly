/* Contrôle la saisie effectuée lors de l'inscription */
function validateInscription() {
	// Réinitialisation du formulaire
	$('.remove-error').removeClass('input-error');
	
	var formulaire = document.forms["inscription"];
    var mail = formulaire["mail"].value;
    var pseudo = formulaire["pseudo"].value;
    var password = formulaire["password"].value;
    var confirmPassword = formulaire["confirmPassword"].value;
    var nom = formulaire["nom"].value;

    var listeErreur = [];
    var ok = true;
	// Contrôle des champs obligatoires remplis
    if (mail === "") { // MAIL
    	$('input[name="mail"]').addClass('input-error');
    	$('#labelMail').addClass('input-error');
    	listeErreur.push('Le champ "Mail" est obligatoire.');
    	ok = false;
    }
    
    if (pseudo === "") { // PSEUDO
    	$('input[name="pseudo"]').addClass('input-error');
    	$('#labelPseudo').addClass('input-error');
    	listeErreur.push('Le champ "Pseudo" est obligatoire.');
    	ok = false;
    }
	
    if (password === "") { // PASSWORD
    	$('input[name="password"]').addClass('input-error');
    	$('#labelPassWord').addClass('input-error');
    	listeErreur.push('Le champ "Mot de passe" est obligatoire.');
    	ok = false;
    }
    
    if (confirmPassword === "") { // PASSWORD
    	$('input[name="confirmPassword"]').addClass('input-error');
    	$('#labelConfirmPassWord').addClass('input-error');
    	listeErreur.push('Le champ "Confirmer mot de passe" est obligatoire.');
    	ok = false;
    }
    
    if (nom === "") { // MAIL
    	$('input[name="nom"]').addClass('input-error');
    	$('#labelNom').addClass('input-error');
    	listeErreur.push('Le champ "Nom" est obligatoire.');
    	ok = false;
    }
	
	// Contrôle du format de l'adresse mail
    if (!checkEmail(mail)) {
    	$('input[name="mail"]').addClass('input-error');
    	$('#labelMail').addClass('input-error');
    	listeErreur.push('Le format de l\'adresse mail est invalide.');
    	ok = false;
    }
	
	// Contrôle de l'unicité de l'adresse mail et du pseudo
    if (mail !== '' && pseudo !== '') {
    	$.ajax({
    		async: false,
    		url: 'ajax/testEmailPseudoInscription.php',
    		type: 'POST',
            dataType: 'json',
    		data: {
    			mail : mail, 
    			pseudo : pseudo
    		},
    		success: function(resultat) {
    			var json = JSON.parse(resultat);
    			if (json.mail !== 0) { // L'adresse mail existe déjà
    				$('input[name="mail"]').addClass('input-error');
    		    	$('#labelMail').addClass('input-error');
    		    	listeErreur.push('L\'adresse mail saisi existe déjà.');
    		    	ok = false;
    			}
    			
    			if (json.pseudo !== 0) { // L'adresse mail existe déjà
    		    	$('input[name="pseudo"]').addClass('input-error');
    		    	$('#labelPseudo').addClass('input-error');
    		    	listeErreur.push('Le pseudo saisi existe déjà.');
    		    	ok = false;
    			}
    		}
    	});
    }
    
	// Contrôle de l'égalité des deux champs du mot de passe
    if (password === "" && confirmPassword === "" && password !== confirmPassword) {
    	$('input[name="password"]').addClass('input-error');
    	$('#labelPassWord').addClass('input-error');
    	$('input[name="confirmPassword"]').addClass('input-error');
    	$('#labelConfirmPassWord').addClass('input-error');
    	listeErreur.push('Les deux champs du mot de passe ne correspondent pas.');
    	ok = false;
    	alert('MDP différents');
    }
    
    return ok;
}

/* Teste le format d'une adresse mail */
function checkEmail(aTester) {
    var pattern = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
    return pattern.test(aTester);
}