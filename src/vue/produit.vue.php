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

?>