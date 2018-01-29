<?php session_start();
    include 'bd/divers.bd.php';
    include 'bd/categorie.bd.php';
    include 'bd/produit.bd.php';
    include 'vue/divers.vue.php';
    if (!(isset($_SESSION['statut']) && $_SESSION['statut'] == 1)) {
        // Si un administrateur n'est pas connecté, on n'autorise pas l'accès à la page
        header('Location: index.php');
    }
?>
<!DOCTYPE html>
<html>
	<head><?php includeHead(); ?></head>	
	<body <?php echo isset($_GET['id']) ? ('onload=" return displayFicheProduit(\''.loadFormProduitJSON($_GET['id']).'\')"') : ''; ?>>
		<?php displayMenu();
		      
    		if (isset($_GET['id'])) {
    		    $produit = getProduitById($_GET['id']);
    		}
    		$categories = getListeCategorie();
    		
		   	require_once 'form/adminDetailProduit.php';
		   	
		   	displayScroller(); // Scroller pour remonter
		?>
	</body>
</html>