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
        $html .= '<th></th>';
        $html .= '</tr>';
        
        foreach ($listeUser as $user) {
            $html .= '<tr>';
            $html .= '<td class="marge-colonne-tab">'.$user->getPseudo().'</td>';
            $html .= '<td>'.$user->getMail().'</td>';
            $html .= '<td>'.($user->getRole() == 0 ? 'Client' : 'Administrateur').'</td>';
            $html .= '<td><a href="adminDetailUser.php?pseudo='.$user->getPseudo().'"><span>Modifier</span>';
            $html .= '<span>Désactiver</span></td></a>';
            $html .= '</tr>';
        }
        
        $html .= '</table>';
        $html .= '</div><br>';
        $html .= '<div class="produit"><span class="btn-admin-ajout" onclick="addCategorie()"><i class="fa fa-plus"></i>Ajouter</span><br></div>';
        $html .= '</div>';
        $html .= '</div>';
        
        echo $html;
    }
?>