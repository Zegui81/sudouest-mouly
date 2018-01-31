<?php session_start();
	include 'bd/categorie.bd.php';
	include 'bd/divers.bd.php';
	include 'bd/panier.bd.php';
	include 'bd/produit.bd.php';
	include 'vue/categorie.vue.php';
	include 'vue/divers.vue.php';
	include 'vue/produit.vue.php';
	include 'modele/Produit.php';
	include 'modele/Categorie.php';
?>
<!DOCTYPE html>
<html>
	<head><?php includeHead(); ?></head>
	<body onload="document.getElementById('slider').style.height = (window.innerHeight - 125) + 'px'; setInterval(function(){slide(3)}, 5000);">
		<?php displayMenu();
		
		  displaySliderAccueil();
		  displayDescriptionAccueil(getDescriptionAccueil());
		  
		  // Catégories
		  displayListeCategorie(getListeCategorie());
		  
		  // Produits phares
		  displayListeProduitPhare(getListeProduitPhare());
		  
		  displayScroller(); // Scroller pour remonter
		?>
	</body>
</html>