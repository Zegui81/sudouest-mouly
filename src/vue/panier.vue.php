<?php
    
    /* Affiche le panier d'un utilisateur */
    function displayPanierUtilisateur($listePanier) {
        $totalFinal = 0;
        $html = '<div class="white">';
        $html .= '<div class="produit">';
        $html .= '<h1 class="page-produit">Mon panier</h1>';
        $html .= '<div class="liste-produits">';
        
        foreach ($listePanier as $panier) {
            $totalPanier = $panier->getQuantite() * $panier->getPrix();
            $totalFinal += $totalPanier;
            
            $html .= '<div class="conteneur-produit">';
            $html .= '<div class="image-produit">';
            $html .= '<img src="images/produits/'.$panier->getProduit().'.jpg">';
            if ($panier->getPromotion() > 0) { // Promotion
                $html .= '<figcaption><img src="images/utilitaire/overPromo.png" class="overlayEtatArticle"></figcaption>';
            }
            $html .= '</div>';
            $html .= '<div class="description-produit">';
            $html .= '<h2>'.$panier->getNom().'</h2>';
            $html .= '<span>'.$panier->getDescription().'</span>';
            $html .= '</div>';
            $html .= '<span class="btn-ajout">';
            $html .= '<i class="fa fa-trash-o" aria-hidden="true"></i>Enlever du panier';
            $html .= '</span>';
            $html .= '<div class="btn-prix total">';
            $html .= number_format($totalPanier, 2, ',', ' ').' €';
            $html .= '</div>';
            $html .= '<div class="btn-prix no-border">=</div>';
            $html .= '<div class="btn-prix">'.number_format($panier->getPrix() * (1 - $panier->getPromotion()), 2, ',', ' ').' €</div>';
            $html .= '<div class="btn-prix no-border">x</div>';
            $html .= '<div class="btn-prix">'.$panier->getQuantite().'</div>';
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