<?php session_start();
    include 'vue/divers.vue.php';
?>
<!DOCTYPE html>
<html>
	<head><?php includeHead(); ?></head>	
	<body>
		<?php displayMenu();
		    
		   	require 'form/erreur.html';
		   	
		   	displayScroller(); // Scroller pour remonter
		?>
	</body>
</html>