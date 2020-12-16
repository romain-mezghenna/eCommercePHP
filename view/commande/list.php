
    <?php
    foreach ($tab_c as $v) {
        $html = htmlspecialchars($v->getIdCommande());
        $v_url = rawurlencode($v->getIdCommande());


            echo '<p> Commande d\'id' . '<a href= "index.php?action=read&controller=commande&idCommande=' . $v_url . '">' . $html . '</a>  ';

    }
        ?>