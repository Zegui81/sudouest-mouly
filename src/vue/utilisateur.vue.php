<?php 
    /* Affiche la liste des utilisateurs sur l'interface d'administration */
    function displayListeUtilisateur($listeUser) {
        $html = '<div class="white">';
        $html .= '<div class="produit">';
        $html .= '<h1 class="page-produit no-merge">Liste des utilisateurs</h1>';
        $html .= '<div class="conteneur-center">';
        $html .= '<table class="tab-liste-produit-admin">';
        $html .= '<tr>';           
        $html .= '<th class="marge-colonne-tab">Pseudo</th>';
        $html .= '<th>Email</th>';
        $html .= '<th>Statut</th>';
        $html .= '<th>Actif</th>';
        $html .= '<th></th>';
        $html .= '</tr>';
        
        foreach ($listeUser as $user) {
            $html .= '<tr>';
            $html .= '<td class="marge-colonne-tab">'.$user->getPseudo().'</td>';
            $html .= '<td>'.$user->getMail().'</td>';
            $html .= '<td>'.($user->getRole() == 0 ? 'Client' : 'Administrateur').'</td>';
            $html .= '<td>'.($user->getSupprime() == 0 ? 'Oui' : 'Non').'</td>';
            $html .= '<td><a href="adminDetailUser.php?pseudo='.$user->getPseudo().'"><span>Modifier</span></a>';
            
            if ($user->getSupprime() == 1) {
                // Le compte est désactivé
                $html .= '<a href="action/doEnableUser.php?pseudo='.$user->getPseudo().'"><span>Activer</span></td></a>';
            } else {
                // Le compte est actif
                $html .= '<a href="action/doDisableUser.php?pseudo='.$user->getPseudo().'"><span>Désactiver</span></td></a>';
            }
            
            $html .= '</tr>';
        }
        
        $html .= '</table>';
        $html .= '</div><br>';
        $html .= '</div>';
        $html .= '</div>';
        
        echo $html;
    }
?>