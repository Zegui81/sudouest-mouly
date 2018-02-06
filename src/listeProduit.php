<?php session_start();
    include 'bd/divers.bd.php';
	include 'bd/produit.bd.php';
	include 'bd/panier.bd.php';
	include 'bd/categorie.bd.php';
	include 'vue/divers.vue.php';
	include 'vue/produit.vue.php';
	include 'modele/Produit.php';
?>
<!DOCTYPE html>
<html>
	<head><?php includeHead(); ?></head>
	<body>	
		<?php displayMenu();
		
    		$listeProduit = null;
    		$titre = null;
    		if (isset($_GET['categorie'])){
    		    $categorie = $_GET['categorie'];
    		    // Contrôle de l'existance de la catégorie
    		    if (isCategorie($categorie)) {
    		        $titre = 'Nos produits dans la catégorie : "'.getNomCategorie($categorie).'"';
    		        $listeProduit = getListeProduitActifByCategorie($categorie);
    		    }
    		} else if (isset($_GET['search'])){
    		    $search = $_GET['search'];
    		    $titre = 'Résultat de votre recherche : "'.$search.'"';
    		    $listeProduit = getListeProduitBySearch($search);
    		} else {
    		    header('Location: index.php');
    		}
    		
    		// Contenu de la liste
    		if (count($listeProduit) == 0) {
    		    $message = 'Aucun produit n\'a été trouvé.';
    		    require_once 'form/exception.php';
    		} else {
    		    displayListeProduit($listeProduit, $titre);
    		}
    		
    		displayScroller(); // Scroller pour remonter
		?>
	</body>
</html>