/* Contrôle la saisie effectuée lors de l'inscription */
function validateInscription() {
	var formulaire = document.forms["inscription"];
    var mail = formulaire["mail"].value;
    var pseudo = formulaire["pseudo"].value;
    var password = formulaire["password"].value;
    var confirmPassword = formulaire["confirmPassword"].value;
    var nom = formulaire["nom"].value;

    
    var listeErreur = {};
	// Contrôle des champs obligatoires remplis
    if (mail === "") {
    	$('input[name="mail"]').addClass();
    }
	
	
	// Contrôle du format de l'adresse mail
	
	// Contrôle de l'unicité de l'adresse mail et du pseudo
	
	// Contrôle de l'égalité des deux champs du mot de passe
	
	// Contrôle du format du code postal
    
    return false;
}