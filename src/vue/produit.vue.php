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
        $html .= '</div>';
        $html .= '<div class="description-produit">';
        $html .= '<h2>'.$produit[1].'</h2>';
        $html .= '<span>'.$produit[2].'</span>';
        $html .= '</div>';
        $html .= '<a onclick="verificationConnexion(';
        $html .= (isset($_SESSION['pseudo']) ? ('\''.$_SESSION['pseudo'].'\'') : 'null').',';
        $html .= $produit[0];
        $html .= ')"><span class="btn-ajout">';
        $html .= '<i class="fa fa-shopping-basket" aria-hidden="true"></i>Ajouter au panier';
        $html .= '</span></a>';
        $html .= '<div class="btn-prix">'.number_format($produit[3], 2, ',', ' ').' €</div>';
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
            $html .= '<span class="produit-simili">';       
            $html .= '<img src="images/produits/'.$produit[0].'.jpg">';
            $html .= '<h2>'.$produit[1].'</h2>';
            $html .= '<h3>'.number_format($produit[2], 2, ',', ' ').' €</h3>';
            $html .= '</span>';
        }
        
        $html .= '</div>';
        $html .= '</div>';
        $html .= '</div>';
        
        echo $html;
    }
?>