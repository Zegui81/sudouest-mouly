<?php

    /* Affiche le menu au sommet de la page */
    function displayMenu($sessionActive, $sessionAdmin) {
        $html = '<header id="header">';
        $html .= '<div class="menu">';
        $html .= '<div class="item-menu btn"><a href="index.php">Accueil</a></div>';
        $html .= '<div class="item-menu btn">Produits</div>';
        $html .= '<div class="item-menu btn">Nous contacter</div>';
        $html .= '<input type="search" placeholder="Recherchez un produit" class="rechercher">';
        $html .= '<div class="compte">';
        $html .= '<a onclick="openPopupConnexion()"><i class="fa fa-sign-in" aria-hidden="true"></i>Se connecter</a>';
        $html .= '<a href="inscription.php" class="marge-lien"><i class="fa fa-user" aria-hidden="true"></i>Créer un compte</a>';
        $html .= '</div>';
        $html .= '</div>';
        $html .= '</header>';
        echo $html;
    }
    
    function displaySliderAccueil() {
        echo '<div class="slider" id="slider"><img src="images/font/terroir1.jpg" alt="Terroir"></div>';
    }

    /* Affiche la description sur l'écran d'accueil */
    function displayDescriptionAccueil($description) {
        $html = '<div class="legende"><p>';
        $html .= $description;
        $html .= '</p></div>';
        echo $html;
    }
    
    /* Affiche le bouton permettant de revenir au sommet de la page */
    function displayScroller() {
        echo '<a href="#header"><span id="scroller"></span></a><footer></footer>';
    }
    
?>