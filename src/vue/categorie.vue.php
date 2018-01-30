<?php
    /* Affiche la liste des catégories */
    function displayListeCategorie($listeCategorie) {
        $html = '<div class="white">';
        $html .= '<div class="produit">';
        $html .= '<h1>Parcourez nos produits</h1>';
        $html .= '<div class="categorie">';
        foreach ($listeCategorie as $categorie) {
            $html .= '<a href="listeProduit.php?categorie=';
            $html .= $categorie->getCode();
            $html .= '"><span class="conteneur"><img src="images/categories/';
            $html .= $categorie->getCode();
            $html .= '.jpg"><figcaption class="legende-categorie">';
            $html .= $categorie->getNom();
            $html .= '</figcaption></span></a>';
        }
        $html .= '</div>';
        $html .= '</div>';
        $html .= '</div>';
        
        echo $html;
    }
    
    /* Affiche la liste des catégories plus un bouton pour en ajouter */
    function displayAdminCategorie($listeCategorie) {
        $html = '<div class="white">';
        $html .= '<div class="produit" id="listeCategorie">';
        $html .= '<h1 class="page-produit no-merge">Gestion des catégories</h1>';
        $html .= '<div id="admin-categorie-error"></div>';

        foreach ($listeCategorie as $categorie) {
            $html .= '<form class="liste-item-inscription item-admin" enctype="multipart/form-data" name="adminCategorie" method="POST" onsubmit="return validateEditCategorie(\''.$categorie->getCode().'\')" action="action/doUpdateCategorie.php?edit='.$categorie->getCode().'">';
            $html .= '<div class="admin-item-gauche">';
            $html .= '<span class="remove-error" id="labelcode-'.$categorie->getCode().'">Code :</span>';
            $html .= '<input type="text" name="code" placeholder="code" class="input-inscription remove-error" value="'.$categorie->getCode().'" id="'.$categorie->getCode().'-code"><br/>';
            $html .= '<span class="remove-error" id="labelnom-'.$categorie->getNom().'">Libellé :</span>';
            $html .= '<input type="text" name="nom" placeholder="nom" class="input-inscription remove-error" value="'.$categorie->getNom().'" id="'.$categorie->getCode().'-nom"><br/>';
            $html .= '</div>';
            $html .= '<div class="admin-item-droit">';
            $html .= '<span class="remove-error" id="labelImage">Image :</span>';
            $html .= '<input type="file" name="image-'.$categorie->getCode().'" placeholder="image" class="input-inscription remove-error"><br/>';
            $html .= '<input class="btn-inscription btn-valider btn-admin" type="submit" value="Éditer">';
            $html .= '<input onclick="deleteCategorie(\''.$categorie->getCode().'\')" class="btn-inscription btn-supprimer btn-admin" type="button" value="Supprimer" id="suppr-'.$categorie->getCode().'">';
            $html .= '</div>';
            $html .= '</form>';
        }
        
        $html .= '</div>';
        $html .= '<div class="produit"><span class="btn-admin-ajout" onclick="addCategorie()"><i class="fa fa-plus"></i>Ajouter</span><br></div>';
        $html .= '</div>';
        
        echo $html;
    }
    
    /* Affiche la liste des catégories dans le menu d'administration des produits */
    function displayListeCategorieAdmin($listeCategorie) {
        $html = '<div class="white">';
        $html .= '<div class="produit">';
        $html .= '<h1 class="page-produit no-merge">Administrer les produits</h1>';
        $html .= '<div class="conteneur-center">';
        
        foreach ($listeCategorie as $categorie) {
            $html .= '<a href="adminListeProduit.php?categorie='.$categorie->getCode().'">';
            $html .= '<span class="admin-btn-menu">';
            $html .= $categorie->getNom();
            $html .= '</span></a>';
        }
        
        // Produits sans catégorie
        $html .= '<a href="adminListeProduit.php?categorie=null">';
        $html .= '<span class="admin-btn-menu">';
        $html .= 'Produits non classés';
        $html .= '</span></a>';
        
        $html .= '</div><br>';
        $html .= '</div>';
        $html .= '</div>';
        
        echo $html;
    }
?>