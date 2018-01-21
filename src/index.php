<?php session_start();
	include 'vue/divers.vue.php';
	include 'bd/divers.bd.php';
	include 'bd/categorie.bd.php';
	include 'vue/categorie.vue.php';
?>
<!DOCTYPE html>
<html>
	<head>
		<?php includeHead(); ?>
	</head>
	<body onload="document.getElementById('slider').style.height = (window.innerHeight - 110) + 'px';">
		<?php
		  // Page d'accueil
		  displayMenu();
		  displaySliderAccueil();
		  displayDescriptionAccueil(getDescriptionAccueil());
		  
		  // Contenu de l'accueil
		  displayListeCategorie(getListeCategorie());
		  
		  displayScroller();
		?>
	</body>
</html>