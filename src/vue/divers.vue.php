<?php
    /* Ajoute la partie head de la page chargée */
    function includeHead() {
        $html = '<title>Mon bon terroir</title>';
        $html .= '<meta charset="UTF-8">';
        $html .= '<meta name="viewport" content="width=device-width,initial-scale=1.0">';
        $html .= '<link rel="stylesheet" href="style.css" type="text/css">';
        $html .= '<link rel="shortcut icon" type="image/x-icon" href="images/logoSite.ico" />';        
        $html .= '<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>';
        $html .= '<link href="https://fonts.googleapis.com/css?family=Open+Sans:400,600,300" rel="stylesheet" type="text/css">';
        $html .= '<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">';
        $html .= '<script src="js/scroller.js"></script>';
        $html .= '<script src="js/search.js"></script>';
        
        if (basename($_SERVER['PHP_SELF']) == 'index.php') {
            // On se situe sur la page de l'inscription, import du js associé
            $html .= '<script src="js/slider.js"></script>';
        }
        
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
        
        if (isset($_SESSION['statut']) && $_SESSION['statut'] == 1) {
            // Import du js associé à l'administration
            $html .= '<script src="js/administration.js"></script>';
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
        $html .= '<a href="index.php"><img class="logo-header" src="images/logoGlobal.png"></a>';
        $html .= '<input id="search" onkeypress="return keyPressOnSearch(event)" type="search" placeholder="Rechercher un produit..." class="rechercher">';
        $html .= '<div class="compte">';
        
        if ($session && $admin) { // SESSION ADMINISTRATEUR
            $html .= '<a href="adminMenu.php"><i class="fa fa-wrench" aria-hidden="true"></i>Administrer</a>';
            $html .= '<a href="action/doDeconnexion.php" class="marge-lien"><i class="fa fa-sign-out" aria-hidden="true"></i>Se déconnecter</a>';
        } else if ($session) { // SESSION UTILISATEUR
            $nbArticle = getNbArticleForUser($_SESSION['pseudo']);
            $html .= '<a href="panier.php"><i class="fa fa-shopping-basket" aria-hidden="true"></i>Mon panier : ';
            $html .= $nbArticle > 1 ? ($nbArticle.' articles') : ($nbArticle.' article');
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
        echo '<div class="slider" id="slider">';
        echo '<div class="inner-slider" id="slider1">';
        echo '<img id="a" src="images/slider/terroir1.jpg" alt="Terroir">';
        echo '<img id="b" src="images/slider/terroir2.jpg" alt="Terroir">';
        echo '<img id="c" src="images/slider/terroir3.jpg" alt="Terroir">';
        echo '<img id="d" src="images/slider/terroir4.jpg" alt="Terroir">';
        echo '<img id="e" src="images/slider/terroir5.jpg" alt="Terroir">';
        echo '<img id="f" src="images/slider/terroir6.jpg" alt="Terroir">';
        echo '</div>';
        echo '</div>';
    }

    /* Affiche la description sur l'écran d'accueil */
    function displayDescriptionAccueil() {
        $html = '<div class="legende"><p>';
        $html .= file_get_contents('form/texteAccueil.txt');
        $html .= '</p></div>';
        echo $html;
    }
    
    /* Affiche le bouton permettant de revenir au sommet de la page */
    function displayScroller() {
        echo '<a href="#header"><span id="scroller"></span></a><footer></footer>';
    }
?>