<?php
    /* Affiche la liste des catégories */
    function displayListeCategorie($listeCategorie) {
        $html = '<div class="white">';
        $html .= '<div class="produit">';
        $html .= '<h1>Parcourez nos produits</h1>';
        $html .= '<div class="categorie">';
        foreach ($listeCategorie as $categorie) {
            $html .= '<a href="listeProduit.php?categorie=';
            $html .= $categorie[0];
            $html .= '"><span class="conteneur"><img src="images/categories/';
            $html .= $categorie[0];
            $html .= '.jpg"><figcaption class="legende-categorie">';
            $html .= $categorie[1];
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
            $html .= '<form class="liste-item-inscription item-admin" enctype="multipart/form-data" name="adminCategorie" method="POST" onsubmit="return validateEditCategorie(\''.$categorie[0].'\')" action="action/doMAJCategorie.php?edit='.$categorie[0].'">';
            $html .= '<div class="admin-item-gauche">';
            $html .= '<span class="remove-error" id="labelcode-'.$categorie[0].'">Code :</span>';
            $html .= '<input type="text" name="code" placeholder="code" class="input-inscription remove-error" value="'.$categorie[0].'" id="'.$categorie[0].'-code"><br/>';
            $html .= '<span class="remove-error" id="labelnom-'.$categorie[0].'">Libellé :</span>';
            $html .= '<input type="text" name="nom" placeholder="nom" class="input-inscription remove-error" value="'.$categorie[1].'" id="'.$categorie[0].'-nom"><br/>';
            $html .= '</div>';
            $html .= '<div class="admin-item-droit">';
            $html .= '<span class="remove-error" id="labelImage">Image :</span>';
            $html .= '<input type="file" name="image-'.$categorie[0].'" placeholder="image" class="input-inscription remove-error"><br/>';
            $html .= '<input class="btn-inscription btn-valider btn-admin" type="submit" value="Éditer">';
            $html .= '<input onclick="deleteCategorie(\''.$categorie[0].'\')" class="btn-inscription btn-supprimer btn-admin" type="button" value="Supprimer" id="suppr-'.$categorie[0].'">';
            $html .= '</div>';
            $html .= '</form>';
            
        }
        $html .= '</div>';
        $html .= '<div class="produit"><span class="btn-admin-ajout" onclick="addCategorie()"><i class="fa fa-plus"></i>Ajouter</span><br></div>';
        $html .= '</div>';
        
        echo $html;
    }
?>
