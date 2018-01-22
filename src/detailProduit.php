<?php session_start();
	include 'vue/divers.vue.php';
	include 'vue/produit.vue.php';
	include 'bd/produit.bd.php';
	if (!isset($_GET['id'])) {
	    // Aucun identifiant de produit passé en argument
	    header('Location: index.php');
	} 
?>
<!DOCTYPE html>
<html>
	<head><?php includeHead(); ?></head>
	<body>
		<?php displayMenu();
		
    		$produit = getProduitById($_GET['id']);
    		if ($produit == null) {
    		    // Le produit n'existe pas, redirection vers l'accueil
    		    //header('Location: index.php');
    		} // else, affichage de la page
    		displayProduit($produit);
    		
    		// 5 : catégorie / 0 : id produit à exclure
    		displayListeProduitSimilaire(getListeProduitimilaire($produit[5], $produit[0]));
    		
    		displayScroller();
		?>
	</body>
</html>