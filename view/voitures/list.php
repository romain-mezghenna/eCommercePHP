
    <?php
    foreach ($tab_v as $v){
        $html = htmlspecialchars($v->getimmatriculation());
        $v_url = rawurlencode($v->getimmatriculation());

            echo '<p> Voiture d\'immatriculation' . '<a href= "index.php?action=read&immatriculation=' . $v_url . '">' . $html . '</a>  ';
            echo '<a href="index.php?controller=panier&action=add&immatriculation=' . $v_url . '">' . 'Ajouter cette voiture à votre panier' . '</a>';
            echo ' <a href= "index.php?action=delete&immatriculation=' . $v_url . '">' . 'Supprimer cette voiture' . '</a> </p>';
          }
        ?>