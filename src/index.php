<!DOCTYPE html>
<html>
	<head>
		<title>Mon bon terroir</title>
		<link rel="stylesheet" href="style.css" type="text/css">
		<meta charset="UTF-8">
		<script	src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js" ></script>
		<link href="https://fonts.googleapis.com/css?family=Open+Sans:400,600,300" rel="stylesheet" type="text/css">
	</head>
		
	<script type="text/javascript">
		function resolution() {
			document.getElementById("slider").style.height = (window.innerHeight - 125) + "px";
		}
	
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
	
	<body onload="resolution()">
		<header id="header">
			<div class="menu">
				<div class="item-menu btn">Accueil</div>
				<div class="item-menu btn">Produits</div>
				<div class="item-menu btn">Nous contacter</div>
				<input type="search" placeholder="Recherchez un produit" class="rechercher">
				<div class="compte">
					<a href="">Se connecter</a><br/>
					<a href="">Créer un compte</a>
				</div>
			</div>
		</header>
	
		<div class="slider" id="slider">
			<img src="images/font/terroir1.jpg" alt="Terroir">
		</div>
	
		<?php
		  include 'bd/divers.bd.php';
		  include 'bd/categorie.bd.php';
		  include 'vue/divers.vue.php';
		  include 'vue/categorie.vue.php';
		  
		  displayDescriptionAccueil(getDescriptionAccueil());
		  displayListeCategorie(getListeCategorie());
		?>
	
		<a href="#header"><span id="scroller"></span></a>
	
		<footer> </footer>
	</body>
</html>