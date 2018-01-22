<?php
    
    /* Affiche le panier d'un utilisateur */
    function displayPanierUtilisateur($listeProduit) {
        $totalFinal = 0;
        $html = '<div class="white">';
        $html .= '<div class="produit">';
        $html .= '<h1 class="page-produit">Mon panier</h1>';
        $html .= '<div class="liste-produits">';
        
        foreach ($listeProduit as $produit) {
            $totalProduit = $produit[1] * $produit[4];
            $totalFinal += $totalProduit;
            
            $html .= '<div class="conteneur-produit">';
            $html .= '<div class="image-produit">';
            $html .= '<img src="images/produits/'.$produit[0].'.jpg">';
            $html .= '</div>';
            $html .= '<div class="description-produit">';
            $html .= '<h2>'.$produit[2].'</h2>';
            $html .= '<span>'.$produit[3].'</span>';
            $html .= '</div>';
            $html .= '<span class="btn-ajout">';
            $html .= '<i class="fa fa-trash-o" aria-hidden="true"></i>Enlever du panier';
            $html .= '</span>';
            $html .= '<div class="btn-prix total">';
            $html .= number_format($totalProduit, 2, ',', ' ').' €';
            $html .= '</div>';
            $html .= '<div class="btn-prix no-border">=</div>';
            $html .= '<div class="btn-prix">'.number_format($produit[4], 2, ',', ' ').' €</div>';
            $html .= '<div class="btn-prix no-border">x</div>';
            $html .= '<div class="btn-prix">'.$produit[1].'</div>';
            $html .= '<div class="btn-qtt-lbl">';
            $html .= '<span>Quantité : </span>';
            $html .= '</div>';
            $html .= '</div>';
        }

        $html .= '<div class="conteneur-produit total-final">';
        $html .= '<div class="btn-prix total prix-final">';
        $html .= number_format($totalFinal, 2, ',', ' ').' €';
        $html .= '</div>';
        $html .='<h1>TOTAL</h1>';
        $html .= '</div>';
        $html .= '</div>';
        $html .= '</div>';
        $html .= '</div>';

        echo $html;
    }
?>