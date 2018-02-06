<?php session_start();
    include 'bd/divers.bd.php';
    include 'bd/produit.bd.php';
    include 'bd/categorie.bd.php';
    include 'vue/divers.vue.php';
    include 'vue/produit.vue.php';
    include 'modele/Produit.php';
    
    if (!(isset($_SESSION['statut']) && $_SESSION['statut'] == 1)) {
        // Si un administrateur n'est pas connecté, on n'autorise pas l'accès à la page
        header('Location: index.php');
    }
    
    if (!isset($_GET['categorie'])) {
        // Une catégorie doit être renseignée en argument
        header('Location: adminProduitMenu.php');
    }
?>
<!DOCTYPE html>
<html>
	<head><?php includeHead(); ?></head>	
	<body>
		<?php displayMenu();
		    
		    displayListeProduitAdmin(
		        getListeProduitAdminByCategorie($_GET['categorie']),
		        getNomCategorie($_GET['categorie']));
		   	
		   	displayScroller(); // Scroller pour remonter
		?>
	</body>
</html>