<div class="white">
	<div class="produit">
		<h1 class="page-produit no-merge">Détail du produit</h1>
		<div id="admin-produit-error"></div>
		<div class="conteneur-center">
			<form class="liste-item-inscription item-admin gestion-produit-admin" enctype="multipart/form-data" name="adminDetailProduit" method="POST"
					onsubmit="return validateProduit()" action="action/doAddOrUpdateProduit.php?<?php echo isset($_GET['id']) ? ('id='.$_GET['id']) : '' ?>">
	           <div class="admin-item-gauche">
		           <span id="label-nom-prod" class="remove-error lbl-admin-produit">Nom :</span>
		           <input id="nom-prod" type="text" name="nom" placeholder="nom" class="input-inscription remove-error" value="<?php echo (isset($produit) ? $produit->getNom() : '') ?>"><br/>
		           <span id="label-prix-prod" class="remove-error lbl-admin-produit">Prix (€) :</span>
		           <input id="prix-prod" type="number" name="prix" step="0.01" min="0.01" placeholder="prix" class="input-inscription remove-error" value="<?php echo (isset($produit) ? $produit->getPrix() : '') ?>"><br/>
		           <span id="label-promo-prod" class="remove-error lbl-admin-produit">Promo (%) :</span>
		           <input id="promo-prod" type="number" name="promo" step="1" min="0" max="100" placeholder="promotion" class="input-inscription remove-error" value="<?php echo (isset($produit) ? ($produit->getPromotion() * 100) : '') ?>"><br/>
		           <span  id="label-stock-prod" class="remove-error lbl-admin-produit">Stock :</span>
		           <input id="stock-prod" type="number" name="stock" step="1" min="0" placeholder="stock" class="input-inscription remove-error" value="<?php echo (isset($produit) ? $produit->getStock() : '') ?>"><br/>
		           <span class="lbl-admin-produit">Catégorie:</span>
    	           <select name="categorie" class="selec-categorie">
    				  <option value="null" class="input-inscription">Aucune catégorie</option>
    				  <?php displayCategoriesOption($categories, (isset($produit) ? $produit->getCategorie() : 'null')) ?>
    		       </select><br/><br/>
	           </div>
	           <div class="admin-item-droit">
	           	   <span class="remove-error lbl-admin-produit">Description :</span>
		           <textarea id="desc-prod" name="description" placeholder="description" class="input-inscription remove-error hauteur-gauche zone-texte"><?php echo (isset($produit) ? $produit->getDescription() : '') ?></textarea><br/>
		           <span class="remove-error lbl-admin-produit" id="labelImage">Image :</span>
		           <input id="img-prod" type="file" name="image-produit" placeholder="image" class="input-inscription remove-error"><br/>
		           <input class="btn-inscription btn-valider btn-admin btn-marge-top-align" type="submit" value=Enregistrer>
		           <input class="btn-inscription btn-supprimer btn-admin" type="button" value="Annuler">
	           </div>
	        </form>
		</div><br>
	</div>
</div>