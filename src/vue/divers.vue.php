<?php

    /* Affiche la description sur l'écran d'accueil */
    function displayDescriptionAccueil($description) {
        $html = "<div class=\"legende\"><p>";
        $html .= $description;
        $html .= "</p></div>";
        echo $html;
    }

?>