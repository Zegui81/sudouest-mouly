<?php session_start();
    include 'bd/divers.bd.php';
    include 'bd/categorie.bd.php';
    include 'bd/produit.bd.php';
    include 'vue/divers.vue.php';
    include 'vue/categorie.vue.php';
    include 'modele/Produit.php';
    include 'modele/Categorie.php';
    if (!(isset($_SESSION['statut']) && $_SESSION['statut'] == 1)) {
        // Si un administrateur n'est pas connecté, on n'autorise pas l'accès à la page
        header('Location: index.php');
    }
?>
<!DOCTYPE html>
<html>
	<head><?php includeHead(); ?></head>	
	<body>
		<?php displayMenu();
		      
		    $produit = null;
		    $categories = getListeCategorie();
    		if (isset($_GET['id'])) {
    		    // Modification de produit
    		    $produit = getProduitById($_GET['id']);
    		    
    		    // Vérification de l'existance du produit
    		    if ($produit == null) {
    		        $message = 'Le produit n\'existe pas.';
    		        require_once 'form/exception.php';
    		    } else {
    		        require_once 'form/adminDetailProduit.php';
    		    }
    		} else {
    		    // Pas d'argument, ajout d'un produit
    		    
    		    require_once 'form/adminDetailProduit.php';
    		}
    		
		   	displayScroller(); // Scroller pour remonter
		?>
	</body>
</html>