<div class="white">
	<div class="produit">
		<h1 class="page-produit no-merge">Détail du produit</h1>
		<div class="conteneur-center">
			<form class="liste-item-inscription item-admin gestion-produit-admin" enctype="multipart/form-data" name="adminCategorie" method="POST">
	           <div class="admin-item-gauche">
		           <span class="remove-error lbl-admin-produit">Nom :</span>
		           <input id="nom-prod" type="text" name="nom" placeholder="nom" class="input-inscription remove-error" value="<?php echo (isset($produit) ? $produit[1] : '') ?>"><br/>
		           <span class="remove-error lbl-admin-produit">Prix :</span>
		           <input id="prix-prod" type="text" name="nom" placeholder="nom" class="input-inscription remove-error" value="<?php echo (isset($produit) ? $produit[3] : '') ?>"><br/>
		           <span class="remove-error lbl-admin-produit">Promo :</span>
		           <input id="promo-prod" type="text" name="promo" placeholder="promotion" class="input-inscription remove-error" value="<?php echo (isset($produit) ? $produit[6] : '') ?>"><br/>
		           <span class="remove-error lbl-admin-produit">Stock :</span>
		           <input id="stock-prod" type="text" name="stock" placeholder="stock" class="input-inscription remove-error" value="<?php echo (isset($produit) ? $produit[4] : '') ?>"><br/>
	           </div>
	           <div class="admin-item-droit">
	           	   <span class="remove-error lbl-admin-produit">Description :</span>
		           <textarea id="desc-prod" name="description" placeholder="description" class="input-inscription remove-error hauteur-gauche" value="<?php echo (isset($produit) ? $produit[2] : '') ?>"></textarea><br/>
		           <span class="remove-error lbl-admin-produit" id="labelImage">Image :</span>
		           <input id="img-prod" type="file" name="image-'.$categorie[0].'" placeholder="image" class="input-inscription remove-error"><br/>
		           <input class="btn-inscription btn-valider btn-admin" type="submit" value=Enregistrer>
		           <input class="btn-inscription btn-supprimer btn-admin" type="button" value="Annuler">
	           </div>
	        </form>
		</div><br>
	</div>
</div>