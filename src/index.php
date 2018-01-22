<?php session_start();
	include 'bd/categorie.bd.php';
	include 'bd/divers.bd.php';
	include 'bd/panier.bd.php';
	include 'vue/categorie.vue.php';
	include 'vue/divers.vue.php';
?>
<!DOCTYPE html>
<html>
	<head><?php includeHead(); ?></head>
	<body onload="document.getElementById('slider').style.height = (window.innerHeight - 110) + 'px';">
		<?php displayMenu();
		
		  displaySliderAccueil();
		  displayDescriptionAccueil(getDescriptionAccueil());
		  
		  // Catégories
		  displayListeCategorie(getListeCategorie());
		  
		  displayScroller(); // Scroller pour remonter
		?>
	</body>
</html>