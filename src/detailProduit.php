<?php session_start();
    include 'bd/divers.bd.php';
    include 'bd/produit.bd.php';
    include 'bd/panier.bd.php';
	include 'vue/divers.vue.php';
	include 'vue/produit.vue.php';
	include 'modele/Produit.php';
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
    		    header('Location: index.php');
    		} // else, affichage de la page
    		displayProduit($produit);
    		
    		// 5 : catégorie / 0 : id produit à exclure
    		displayListeProduitSimilaire(getListeProduitSimilaire(
    		      $produit->getCategorie(), $produit->getIdProduit()));
    		
    		displayScroller();
		?>
	</body>
</html>