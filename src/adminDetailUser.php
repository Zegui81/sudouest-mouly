<?php session_start();
    include 'bd/divers.bd.php';
    include 'bd/utilisateur.bd.php';
    include 'vue/divers.vue.php';
    include 'modele/Utilisateur.php';
    
    if (!(isset($_SESSION['statut']) && $_SESSION['statut'] == 1)) {
        // Si un administrateur n'est pas connecté, on n'autorise pas l'accès à la page
        header('Location: index.php');
    }
    
    if (!isset($_GET['pseudo'])) {
        // Un pseudo doit être renseigné en argument
        header('Location: adminListeUser.php');
    }
?>
<!DOCTYPE html>
<html>
	<head><?php includeHead(); ?></head>	
	<body>
		<?php displayMenu();
		
		    $user = getUtilisateurByPseudo($_GET['pseudo']);
		   	require_once 'form/adminDetailUser.php';
		   	
		   	displayScroller(); // Scroller pour remonter
		?>
	</body>
</html>