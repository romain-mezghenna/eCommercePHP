

        <?php
              $c->afficher();
              $v_url = rawurlencode($c->getidCommande());
            echo ' <a href= "index.php?action=delete&controller=commande&idCommande=' . $v_url . '">' . 'Supprimer cette commande' . '</a> </p>';
        echo ' <a href= "index.php?action=update&controller=commande&idCommande=' . $v_url . '">' . 'Modifier cette commande' . '</a> </p>';
        ?>


