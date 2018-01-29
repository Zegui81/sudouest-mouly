<?php

    /* Récupère les informations de la BD dans le config.ini */
    function displayListeProduit($listeProduit) {
        $html = '<div class="white">';
        $html .= '<div class="produit">';
        $html .= '<h1 class="page-produit">Parcourez nos produits</h1>';
        $html .= '<div class="liste-produits">';

        foreach ($listeProduit as $produit) {
            $html .= '<div class="conteneur-produit">';
            $html .= '<div class="image-produit">';
            $html .= '<img src="images/produits/';
            $html .= $produit[0];
            $html .= '.jpg"></div>';
            $html .= '<div class="description-produit"><h2>';
            $html .= $produit[1];
            $html .= '</h2>';
            $html .= '<span>';
            $html .= $produit[2];
            $html .= '</span>';
            $html .= '</div>';
            $html .= '<a href="detailProduit.php?id=';
            $html .= $produit[0];
            $html .= '">';
            $html .= '<div class="btn-info">';
            $html .= '<i class="fa fa-info" aria-hidden="true"></i>Détails';
            $html .= '</div>';
            $html .= '</a>';
            $html .= '</div>';
        }
        
        $html .= '</div>';
        $html .= '</div>';
        $html .= '</div>';
        
        echo $html;
    }
    
    /* Affiche un produit en détail */
    function displayProduit($produit) {
        $html = '<div class="white">';
        $html .= '<div class="produit">';
        $html .= '<div class="conteneur-produit">';
        $html .= '<div class="image-produit">';
        $html .= '<img src="images/produits/'.$produit[0].'.jpg">';
        
        if ($produit[4] == 0) { // Stock vide
            $html .= '<figcaption><img src="images/utilitaire/overStock.png" class="overlayEtatArticle"></figcaption>';
        } else if ($produit[6] > 0) { // Promotion
            $html .= '<figcaption><img src="images/utilitaire/overPromo.png" class="overlayEtatArticle"></figcaption>';
        }
        
        $html .= '</div>';
        $html .= '<div class="description-produit">';
        $html .= '<h2>'.$produit[1].'</h2>';
        $html .= '<span>'.$produit[2].'</span>';
        $html .= '</div>';
       
        
        if ($produit[4] != 0) { // Stock non vide
            $html .= '<a onclick="verificationConnexion(';
            $html .= (isset($_SESSION['pseudo']) ? ('\''.$_SESSION['pseudo'].'\'') : 'null').',';
            $html .= $produit[0];
            $html .= ')"><span class="btn-ajout">';
            $html .= '<i class="fa fa-shopping-basket" aria-hidden="true"></i>Ajouter au panier';
            $html .= '</span></a>';
        }
        
        $html .= '<div class="btn-prix">'.number_format($produit[3] * (1 - $produit[6]), 2, ',', ' ').' €</div>';
        
        if ($produit[6] > 0) { // Promotion
            $html .= '<div class="btn-prix ancienPrix">'.number_format($produit[3], 2, ',', ' ').' €</div>';
        }
        
        $html .= '<div class="btn-qtt-cbx">';
        $html .= '<select id="quantite">';
        
        // Stocks disponibles avec 10 maximum
        for ($i = 0; $i <= $produit[4] && $i <= 10; $i++) {
            $html .= '<option value="'.$i.'">'.$i.'</option>';
        }
        
        $html .= '</select>';
        $html .= '</div>';
        $html .= '<div class="btn-qtt-lbl">';
        $html .= '<span>Quantité : </span>';
        $html .= '</div>';
        $html .= '</div>';
        $html .= '</div>';
        $html .= '</div>';
        
        echo $html;  
    }
    
    function displayListeProduitSimilaire($listeProduit) {
        $html = '<div class="white">';
        $html .= '<div class="produit">';
        $html .= '<h1 class="page-produit">Vous aimerez aussi...</h1>';
        $html .= '<div class="liste-produits-similaires">';
        
        foreach ($listeProduit as $produit) {
            $html .= '<a href="detailProduit.php?id='.$produit[0].'"><span class="produit-simili">';       
            $html .= '<img src="images/produits/'.$produit[0].'.jpg">';
            $html .= '<h2>'.$produit[1].'</h2>';
            
   

            $html .= '<h3>'.number_format($produit[2] * (1 - $produit[3]), 2, ',', ' ').' €</h3>';
            if ($produit[3] != 0) { // Promotion
                $html .= '<h3  class="ancienPrixSimili">'.number_format($produit[2], 2, ',', ' ').' €</h3>';
            } else {
                $html .= '<h3>&nbsp;</h3>';
            }
            
            $html .= '</span></a>';
        }
        
        $html .= '</div>';
        $html .= '</div>';
        $html .= '</div>';
        
        echo $html;
    }
    
    /* Affiche les produit phares sur la page d'accueil */
    function displayListeProduitPhare($listeProduit) {
        $html = '<div class="white">';
        $html .= '<div class="produit">';
        $html .= '<h1 class="page-produit">Nos produits phares</h1>';
        $html .= '<div class="liste-produits-similaires">';
        
        foreach ($listeProduit as $produit) {
            $html .= '<a href="detailProduit.php?id='.$produit[0].'"><span class="produit-simili">';
            $html .= '<img src="images/produits/'.$produit[0].'.jpg">';
            $html .= '<h2>'.$produit[1].'</h2>';
            $html .= '<h3>'.number_format($produit[2], 2, ',', ' ').' €</h3>';
            $html .= '</span></a>';
        }
        
        $html .= '</div>';
        $html .= '</div>';
        $html .= '</div>';
        
        echo $html;
    }
    
    /* Affiche la liste des produits sous forme de tableau pour l'administration */
    function displayListeProduitAdmin($listeProduit) {
        $html = '<div class="white">';
        $html .= '<div class="produit">';
        $html .= '<h1 class="page-produit no-merge">Liste des produits</h1>';
        $html .= '<div class="conteneur-center">';
        $html .= '<table class="tab-liste-produit-admin">';
        $html .= '<tr>';
        $html .= '<th class="marge-colonne-tab">Nom</th>';
        $html .= '<th>Prix</th>';
        $html .= '<th></th>';
        $html .= '</tr>';
        
        foreach ($listeProduit as $produit) {
            $html .= '<tr>';
            $html .= '<td  class="marge-colonne-tab">'.$produit[1].'</td>';
            $html .= '<td>'.number_format($produit[3], 2, ',', ' ').' €</td>';
            $html .= '<td><a href="adminDetailProduit.php?id='.$produit[0].'"><span>Modifier</span></a>';
            $html .= '<span>Retirer</span></td>';
            $html .= '</tr>';
        }
            
        $html .= '</table>';
        $html .= '</div><br>';
        $html .= '<div class="produit"><span class="btn-admin-ajout" onclick="addCategorie()"><i class="fa fa-plus"></i>Ajouter</span><br></div>';
        $html .= '</div>';
        $html .= '</div>';
        
        echo $html;
    }
?>