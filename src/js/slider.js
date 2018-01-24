/* Index de l'image affichée actuellement sur le caroussel */
var localisation = 1;

/* Appelée pour faire bouger le slider */
function slide(nbImage) {

	if (localisation == nbImage) {
		//
		localisation = 0;
	}
	
//	var top = -(window.innerHeight ) * (localisation - 1) - 125;
	var hauteurEcran = -(window.innerHeight + 125) * localisation;
	$('#slider1').animate({top: hauteurEcran + 'px'}, 1500);
	localisation++;
}