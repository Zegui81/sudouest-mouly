<?php session_start();
    include 'bd/divers.bd.php';
	include 'bd/produit.bd.php';
	include 'bd/panier.bd.php';
	include 'vue/divers.vue.php';
	include 'vue/produit.vue.php';
?>
<!DOCTYPE html>
<html>
	<head><?php includeHead(); ?></head>
	<body>	
		<?php displayMenu();
    		
    		if (isset($_GET['categorie'])){
    		    $categorie = $_GET['categorie'];
    		} else {
    		    header('Location: index.php');
    		}
    		
    		// Contenu de la liste
    		displayListeProduit(getListeProduitByCategorie($categorie));
    		
    		displayScroller(); // Scroller pour remonter
		?>
	</body>
</html>