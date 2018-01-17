<!DOCTYPE html>
<html>
	<head>
		<title>Mon bon terroir</title>
		<link rel="stylesheet" href="style.css" type="text/css">
		<meta charset="UTF-8">
		
		<script	src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
		<link href="https://fonts.googleapis.com/css?family=Open+Sans:400,600,300" rel="stylesheet" type="text/css">
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
		<script  src="js/connexion.js"></script>
	
	<script type="text/javascript">
		$(document).ready(function() {
			$("a").on('click', function(event) {
				if (this.hash !== "") {
					event.preventDefault();
					var hash = this.hash;
					$('html, body').animate({
						scrollTop : $(hash).offset().top
					}, 800, function() {
						window.location.hash = hash;
					});
				}
			});
		});
		
	</script>
	</head>
	
	<body>
	
		<header id="header">
			<div class="menu">
				<div class="item-menu btn"><a href="index.php">Accueil</a></div>
				<div class="item-menu btn">Produits</div>
				<div class="item-menu btn">Nous contacter</div>
				<input type="search" placeholder="Recherchez un produit" class="rechercher">
				<div class="compte">
					<a onclick="openPopupConnexion()">Se connecter</a><br/>
					<a href="" >Créer un compte</a>
				</div>
			</div>
		</header>
	
		<?php 
    		include 'bd/produit.bd.php';
    		include 'vue/produit.vue.php';
    		
    		if (isset($_GET['categorie'])){
    		    $categorie = $_GET['categorie'];
    		} else {
    		    header('Location: categorie.php');
    		}
    		
    		displayListeProduit(getListeProduitByCategorie($categorie));
		?>
	
		<a href="#header"><span id="scroller"></span></a>
	
		<footer> </footer>
	</body>
</html>