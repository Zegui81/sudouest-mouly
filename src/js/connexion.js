function openPopupConnexion() {
	$('body').prepend('<div class="overlay" id="popupConnexion" style="display: block;"></div>');
    $('#popupConnexion').load('form/connexion.html');
}

function closePopupConnexion() {
	$('#popupConnexion').remove();
}