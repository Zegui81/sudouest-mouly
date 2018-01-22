<?php session_start();
    include 'vue/divers.vue.php';
    if (isset($_SESSION['pseudo'])) {
        // Quelqu'un est connecté, on empêche l'accès à cette page
        header('Location: index.php');
    }
?>
<!DOCTYPE html>
<html>
	<head><?php includeHead(); ?></head>	
	<body>
		<?php displayMenu();
		    
		   	require 'form/inscription.html';
		   	
		   	displayScroller(); // Scroller pour remonter
		?>
	</body>
</html>