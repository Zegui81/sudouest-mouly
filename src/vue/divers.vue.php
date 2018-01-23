<?php
    /* Ajoute la partie head de la page chargée */
    function includeHead() {
        $html = '<title>Mon bon terroir</title>';
        $html .= '<meta charset="UTF-8">';
        $html .= '<link rel="stylesheet" href="style.css" type="text/css">';
        $html .= '<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>';
        $html .= '<link href="https://fonts.googleapis.com/css?family=Open+Sans:400,600,300" rel="stylesheet" type="text/css">';
        $html .= '<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">';
        $html .= '<script src="js/scroller.js"></script>';
        $html .= '<script src="js/search.js"></script>';
        
        if (!isset($_SESSION['pseudo'])) {
            // Aucune session, import de la popup de connexion
            $html .= '<script src="js/connexion.js"></script>';
        }
        
        if (basename($_SERVER['PHP_SELF']) == 'inscription.php') {
            // On se situe sur la page de l'inscription, import du js associé
            $html .= '<script src="js/inscription.js"></script>';
        }
        
        if (basename($_SERVER['PHP_SELF']) == 'detailProduit.php') {
            // On se situe sur la page de l'inscription, import du js associé
            $html .= '<script src="js/ajouterAuPanier.js"></script>';
        }
        
        echo $html;
    }

    /* Affiche le menu au sommet de la page */
    function displayMenu() {
        $session = false;
        $admin = false;
        if (isset($_SESSION['pseudo'])) {
            $session = true;
            if (isset($_SESSION['statut']) && $_SESSION['statut'] == 1) {
                $admin = true;
            }
        }
            
        $html = '<header id="header">';
        $html .= '<div class="menu">';
        $html .= '<div class="item-menu btn"><a href="index.php">Accueil</a></div>';
        $html .= '<div class="item-menu btn">Produits</div>';
        $html .= '<div class="item-menu btn">Nous contacter</div>';
        $html .= '<input id="search" onkeypress="return keyPressOnSearch(event)" type="search" placeholder="Recherchez un produit" class="rechercher">';
        $html .= '<div class="compte">';
        
        if ($session && $admin) { // SESSION ADMINISTRATEUR
            $html .= '<a><i class="fa fa-wrench" aria-hidden="true"></i>Administrer</a>';
            $html .= '<a href="action/doDeconnexion.php" class="marge-lien"><i class="fa fa-sign-out" aria-hidden="true"></i>Se déconnecter</a>';
        } else if ($session) { // SESSION UTILISATEUR
            $html .= '<a href="panier.php"><i class="fa fa-shopping-basket" aria-hidden="true"></i>Mon panier : ';
            $html .= getNbArticleForUser($_SESSION['pseudo']).' article(s)';
            $html .= '</a>';
            $html .= '<a href="action/doDeconnexion.php" class="marge-lien"><i class="fa fa-sign-out" aria-hidden="true"></i>Se déconnecter</a>';
        } else { // PAS DE SESSION
            $html .= '<a onclick="openPopupConnexion()"><i class="fa fa-sign-in" aria-hidden="true"></i>Se connecter</a>';
            $html .= '<a href="inscription.php" class="marge-lien"><i class="fa fa-user" aria-hidden="true"></i>Créer un compte</a>';
        }

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
    
    /* Affiche le bouton permettant de revenir au sommet de la page sur la page détail */
    function displayScrollerDetailProduit() {
        echo '<a href="#header"><span id="scroller"></span></a><footer class="remplissage"></footer>';
    }
?>