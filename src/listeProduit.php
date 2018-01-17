<!DOCTYPE html>
<html>
	<head>
		<title>Mon bon terroir</title>
		<link rel="stylesheet" href="style.css" type="text/css">
		<meta charset="UTF-8">
		<script	src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
		<link href="https://fonts.googleapis.com/css?family=Open+Sans:400,600,300" rel="stylesheet" type="text/css">
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
		<script src="js/scroller.js"></script>
		
		<script  src="js/connexion.js"></script>
	</head>
	<body>	
		<?php 
    		include 'bd/produit.bd.php';
    		include 'vue/divers.vue.php';
    		include 'vue/produit.vue.php';
    		
    		displayMenu(false, false);
    		
    		if (isset($_GET['categorie'])){
    		    $categorie = $_GET['categorie'];
    		} else {
    		    header('Location: categorie.php');
    		}
    		
    		// Contenu de la liste
    		displayListeProduit(getListeProduitByCategorie($categorie));
    		
    		displayScroller();
		?>
	</body>
</html>