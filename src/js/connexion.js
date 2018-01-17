function openPopupConnexion() {
	$('body').prepend('<div class="overlay" id="popupConnexion" style="display: block;"></div>');
    $('#popupConnexion').load('ajax/connexion.html');
}

function closePopupConnexion() {
	$('#popupConnexion').remove();
}