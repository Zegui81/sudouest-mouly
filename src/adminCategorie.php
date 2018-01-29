<?php session_start();
    include 'bd/divers.bd.php';
    include 'bd/categorie.bd.php';
    include 'vue/divers.vue.php';
    include 'vue/categorie.vue.php';
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
		    
		   	displayAdminCategorie(getListeCategorie());
		   	
		   	displayScroller(); // Scroller pour remonter
		?>
	</body>
</html>