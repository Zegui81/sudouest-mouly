<?php

    /* Affiche une liste de produit avec la description */
    function displayListeProduit($listeProduit, $titre) {
        $html = '<div class="white">';
        $html .= '<div class="produit">';
        $html .= '<h1 class="page-produit">'.$titre.'</h1>';
        $html .= '<div class="liste-produits">';

        foreach ($listeProduit as $produit) {
            $html .= '<div class="conteneur-produit">';
            $html .= '<div class="image-produit">';
            $html .= '<img src="images/produits/'.$produit->getIdProduit().'.jpg">';
            
            if ($produit->getStock() == 0) { // Stock vide
                $html .= '<figcaption><img src="images/utilitaire/overStock.png" class="overlayEtatArticle"></figcaption>';
            } else if ($produit->getPromotion() > 0) { // Promotion
                $html .= '<figcaption><img src="images/utilitaire/overPromo.png" class="overlayEtatArticle"></figcaption>';
            }
            
            $html .= '</div>';
            $html .= '<div class="description-produit"><h2>';
            $html .= $produit->getNom();
            $html .= '</h2>';
            $html .= '<span>';
            $html .= $produit->getDescription();
            $html .= '</span>';
            $html .= '</div>';
            $html .= '<a href="detailProduit.php?id='.$produit->getIdProduit().'"><span class="btn-info">';
            $html .= '<i class="fa fa-info" aria-hidden="true"></i>Détails';
            $html .= '</span></a>';
            $html .= '<div class="btn-prix">'.number_format($produit->getPrix() * (1 - $produit->getPromotion()), 2, ',', ' ').' €</div>';
            
            if ($produit->getPromotion() > 0) { // Promotion
                $html .= '<div class="btn-prix ancienPrix">'.number_format($produit->getPrix(), 2, ',', ' ').' €</div>';
            }

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
        $html .= '<img src="images/produits/'.$produit->getIdProduit().'.jpg">';
        
        if ($produit->getStock() == 0) { // Stock vide
            $html .= '<figcaption><img src="images/utilitaire/overStock.png" class="overlayEtatArticle"></figcaption>';
        } else if ($produit->getPromotion() > 0) { // Promotion
            $html .= '<figcaption><img src="images/utilitaire/overPromo.png" class="overlayEtatArticle"></figcaption>';
        }
        
        $html .= '</div>';
        $html .= '<div class="description-produit">';
        $html .= '<h2>'.$produit->getNom().'</h2>';
        $html .= '<span>'.$produit->getDescription().'</span>';
        $html .= '</div>';
        
        $admin = isset($_SESSION['pseudo']) && $_SESSION['statut'] == 1;
        if ($produit->getStock() != 0 && !$admin) { // Stock non vide et non admin
            $html .= '<a onclick="verificationConnexion(';
            $html .= (isset($_SESSION['pseudo']) ? ('\''.$_SESSION['pseudo'].'\'') : 'null').',';
            $html .= $produit->getIdProduit();
            $html .= ')"><span class="btn-ajout">';
            $html .= '<i class="fa fa-shopping-basket" aria-hidden="true"></i>Ajouter au panier';
            $html .= '</span></a>';
        }
        
        $html .= '<div class="btn-prix">'.number_format($produit->getPrix() * (1 - $produit->getPromotion()), 2, ',', ' ').' €</div>';
        
        if ($produit->getPromotion() > 0) { // Promotion
            $html .= '<div class="btn-prix ancienPrix">'.number_format($produit->getPrix(), 2, ',', ' ').' €</div>';
        }
        
        if ($produit->getStock() != 0) { 
            // Choix de la quantité s'il n'y a pas rupture de stock
            $html .= '<div class="btn-qtt-cbx">';
            $html .= '<select id="quantite">';
            
            // Stocks disponibles avec 10 maximum
            for ($i = 1; $i <= $produit->getStock() && $i <= 10; $i++) {
                $html .= '<option value="'.$i.'">'.$i.'</option>';
            }
            
            $html .= '</select>';
            $html .= '</div>';
            $html .= '<div class="btn-qtt-lbl">';
            $html .= '<span>Quantité : </span>';
            $html .= '</div>';
        }
        
        $html .= '</div>';
        $html .= '</div>';
        $html .= '</div>';
        
        echo $html;  
    }
    
    /* Affiche les produits similaires dans le détail d'un produit */
    function displayListeProduitSimilaire($listeProduit) {
        $html = '<div class="white">';
        $html .= '<div class="produit">';
        $html .= '<h1 class="page-produit">Vous aimerez aussi...</h1>';
        $html .= '<div class="liste-produits-similaires">';
        
        foreach ($listeProduit as $produit) {
            $html .= '<a href="detailProduit.php?id='.$produit->getIdProduit().'"><span class="produit-simili">';       
            $html .= '<img src="images/produits/'.$produit->getIdProduit().'.jpg">';
            $html .= '<h2>'.$produit->getNom().'</h2>';

            $html .= '<h3>'.number_format($produit->getPrix() * (1 - $produit->getPromotion()), 2, ',', ' ').' €</h3>';
            if ($produit->getPromotion() != 0) { // Promotion
                $html .= '<h3  class="ancienPrixSimili">'.number_format($produit->getPrix(), 2, ',', ' ').' €</h3>';
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
            $html .= '<a href="detailProduit.php?id='.$produit->getIdProduit().'"><span class="produit-simili">';
            $html .= '<img src="images/produits/'.$produit->getIdProduit().'.jpg">';
            $html .= '<h2>'.$produit->getNom().'</h2>';
            
            $html .= '<h3>'.number_format($produit->getPrix() * (1 - $produit->getPromotion()), 2, ',', ' ').' €</h3>';
            if ($produit->getPromotion() != 0) { // Promotion
                $html .= '<h3  class="ancienPrixSimili">'.number_format($produit->getPrix(), 2, ',', ' ').' €</h3>';
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
    
    /* Affiche la liste des produits sous forme de tableau pour l'administration */
    function displayListeProduitAdmin($listeProduit, $nomCategorie) {
        $html = '<div class="white">';
        $html .= '<div class="produit">';
        $html .= '<h1 class="page-produit no-merge">';
        $html .= ($nomCategorie == null ? 'Produits non classés' : ('Produits de la catégorie : "'.$nomCategorie.'"'));
        $html .= '</h1>';
        $html .= '<div class="conteneur-center">';
        
        if (count($listeProduit) == 0) {
            // Liste vide
            $html .= '<span class="erreur">Aucun produit trouvé.</span><br/>';
        } else {
            // Des produits ont été trouvés
            $html .= '<table class="tab-liste-produit-admin">';
            $html .= '<tr>';
            $html .= '<th class="marge-colonne-tab">Nom</th>';
            $html .= '<th>Prix</th>';
            $html .= '<th></th>';
            $html .= '</tr>';
            
            foreach ($listeProduit as $produit) {
                $html .= '<tr>';
                $html .= '<td  class="marge-colonne-tab">'.$produit->getNom().'</td>';
                $html .= '<td>'.number_format($produit->getPrix(), 2, ',', ' ').' €</td>';
                $html .= '<td><a href="adminDetailProduit.php?id='.$produit->getIdProduit().'"><span>Modifier</span></a>';
                
                if ($produit->getEtat() == 0) {
                    // Le produit est désactivé
                    $html .= '<a href="action/doEnableProduit.php?id='.$produit->getIdProduit().'"><span>Activer</span></td></a>';
                } else {
                    // Le produit est actif
                    $html .= '<a href="action/doDisableProduit.php?id='.$produit->getIdProduit().'"><span>Retirer</span></td></a>';
                }
                $html .= '</tr>';
            }
            $html .= '</table>';
        }

        $html .= '</div><br>';
        $html .= '</div>';
        $html .= '</div>';
        
        echo $html;
    }
?>