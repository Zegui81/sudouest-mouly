<?php
	session_start();
?>
<!DOCTYPE html>
<html>
	<head>
		<title>Mon bon terroir</title>
		<link rel="stylesheet" href="style.css" type="text/css">
		<meta charset="UTF-8">
		<script	src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js" ></script>
		<link href="https://fonts.googleapis.com/css?family=Open+Sans:400,600,300" rel="stylesheet" type="text/css">
    	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
		<script src="js/scroller.js"></script>
		
		<script src="js/connexion.js"></script>
	</head>
	<body onload="document.getElementById('slider').style.height = (window.innerHeight - 110) + 'px';">
		<?php
		  include 'bd/divers.bd.php';
		  include 'bd/categorie.bd.php';
		  include 'vue/divers.vue.php';
		  include 'vue/categorie.vue.php';
		  
		  // Page d'accueil
		  displayMenu(false, false);
		  displaySliderAccueil();
		  displayDescriptionAccueil(getDescriptionAccueil());
		  
		  // Contenu de l'accueil
		  displayListeCategorie(getListeCategorie());
		  
		  displayScroller();
		?>
	</body>
</html>