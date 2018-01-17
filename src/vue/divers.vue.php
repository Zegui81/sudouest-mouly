<?php

    /* Affiche la description sur l'écran d'accueil */
    function displayDescriptionAccueil($description) {
        $html = '<div class="legende"><p>';
        $html .= $description;
        $html .= '</p></div>';
        echo $html;
    }
    
    function displayScroller() {
        echo '<a href="#header"><span id="scroller"></span></a><footer></footer>';
    }
    
?>