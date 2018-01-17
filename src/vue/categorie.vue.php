<?php

    /* Récupère les informations de la BD dans le config.ini */
    function displayListeCategorie($listeCategorie) {
        $html = "<div class=\"produit\">";
        $html .= "<h1>Parcourez nos produits</h1>";
        $html .= "<div class=\"categorie\">";
        foreach ($listeCategorie as $categorie) {
            $html .= "<a href=\"listeProduit.php?categorie=";
            $html .= $categorie[0];
            $html .= "\"><span class=\"conteneur\"><img src=\"images/categories/";
            $html .= $categorie[0];
            $html .= ".jpg\"></span></a>";
        }
        $html .= "</div>";
        $html .= "</div>";
        
        echo $html;
    }

?>
