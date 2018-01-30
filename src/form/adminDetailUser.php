<div class="white">
	<div class="produit">
		<h1 class="page-produit no-merge">Détail de l'utilisateur <?php echo $user->getPseudo() ?></h1>
		<div class="conteneur-center">
    		<form class="liste-item-inscription item-admin gestion-user-admin-info" enctype="multipart/form-data" onsubmit="return validateUpdateProduit()" name="adminCategorie" method="POST" action="action/doUpdateUser.php">
               <div class="admin-item-gauche">	
               	   <span class="remove-error lbl-admin-produit lbl-marge-droite-input">Pseudo :</span>
    	           <input id="promo-prod" type="text" name="pseudo" placeholder="pseudonyme" class="input-inscription remove-error" value="<?php echo $user->getPseudo() ?>" disabled><br/>	           
    	           <span class="remove-error lbl-admin-produit lbl-marge-droite-input">Mail :</span>
    	           <input id="promo-prod" type="text" name="mail" placeholder="adresse mail" class="input-inscription remove-error" value="<?php echo $user->getMail() ?>" disabled><br/>
               </div>
               <div class="admin-item-droit">
    	           <span class="remove-error lbl-admin-produit lbl-marge-droite-input">Nom :</span>
    	           <input id="nom-prod" type="text" name="nom" placeholder="nom" class="input-inscription remove-error" value="<?php echo $user->getNom() ?>"><br/>
    	           <span class="remove-error lbl-admin-produit lbl-marge-droite-input">Prénom :</span>
    	           <input id="prix-prod" type="text" name="prenom" placeholder="prénom" class="input-inscription remove-error" value="<?php echo $user->getPrenom() ?>"><br/>
               </div>
    	        
               <div class="admin-item-gauche">
    	           <span class="remove-error lbl-admin-produit lbl-marge-droite-input">Adresse :</span>
    	           <input id="nom-prod" type="text" name="adresse" placeholder="adresse" class="input-inscription remove-error" value="<?php echo $user->getAdresse() ?>"><br/>
    	           <span class="remove-error lbl-admin-produit lbl-marge-droite-input">CP :</span>
    	           <input id="prix-prod" type="text" name="codePostal" placeholder="code postal" class="input-inscription remove-error" value="<?php echo $user->getCodePostal() ?>"><br/>
    	           <span class="remove-error lbl-admin-produit lbl-marge-droite-input">Ville :</span>
    	           <input id="promo-prod" type="text" name="ville" placeholder="ville" class="input-inscription remove-error" value="<?php echo $user->getVille() ?>"><br/>
               </div>
               <div class="admin-item-droit">
    	           <span class="remove-error lbl-admin-produit">Statut :</span>
    	           <select>
    				  <option value="0" class="input-inscription remove-error" <?php echo ($user->getRole() == 0 ? 'selected' : '') ?>>Utilisateur</option>
    				  <option value="1" class="input-inscription remove-error" <?php echo ($user->getRole() == 1 ? 'selected' : '') ?>>Administrateur</option>
    				</select>
    	           <input class="btn-inscription btn-valider btn-admin" type="submit" value=Enregistrer>
    	           <input onclick="return goToAdminListeUser()" class="btn-inscription btn-supprimer btn-admin" type="button" value="Annuler">
               </div>
            </form>
		</div><br>
	</div>
</div>