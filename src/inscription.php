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
		    include 'vue/divers.vue.php';
		    
		    displayMenu(false, false);
		   		
		?>
		<div class="white">
			<div class="produit">
				<h1 class="page-produit no-merge">Créez un compte</h1>
				<form class="liste-item-inscription">
					<div class="item-gauche">
						<span>Adresse mail :</span><input type=text placeholder="adresse mail" class="input-inscription"><br/>
						<span>Pseudo :</span><input type="text" placeholder="pseudonyme" class="input-inscription"><br/>
						<span>Mot de passe :</span><input type="password" placeholder="mot de passe" class="input-inscription"><br/>
						<span>Confirmer mot de passe :</span><input type="password" placeholder="mot de passe" class="input-inscription"><br/>
					</div>
					<div class="item-droit">
						<span>Nom :</span><input type=text placeholder="nom" class="input-inscription"><br/>
						<span>Prénom :</span><input type=text placeholder="prénom" class="input-inscription"><br/>
						<span>Date naissance :</span><input type=date placeholder="date de naissance" class="input-inscription"><br/>
						<span>Adresse :</span><input type=text placeholder="adresse" class="input-inscription"><br/>
						<span>Code Postal :</span><input type=text placeholder="code postal" class="input-inscription"><br/>
						<span>Ville :</span><input type=text placeholder="ville" class="input-inscription"><br/>
						
						<span class="btn-inscription btn-valider">Valider</span>
					</div>
				</form>
			</div>
		
			<a href="#header"><span id="scroller"></span></a>
		</div>
		<footer></footer>
	</body>
</html>