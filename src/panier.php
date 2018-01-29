<?php session_start();
    include 'bd/divers.bd.php';
    include 'bd/panier.bd.php';
    include 'vue/divers.vue.php';
    include 'vue/panier.vue.php';
    include 'modele/Panier.php';
    if (!isset($_SESSION['pseudo'])) {
        // On ne peut pas afficher le panier si on n'est pas connecté
        header('Location: index.php');
    } 
?>
<!DOCTYPE html>
<html>
	<head> <?php includeHead(); ?></head>
	<body>
		<?php displayMenu();
		      
    		displayPanierUtilisateur(
    		    getListeProduitPanierUtilisateur($_SESSION['pseudo']));
    		
    		displayScroller(); // Scroller pour remonter
		?>
	</body>
</html>