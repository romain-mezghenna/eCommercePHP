

        <?php
              $c->afficher();
              $v_url = rawurlencode($c->getidCommande());
              if (isset($_SESSION['admin'])){
                  echo '<br> <a href= "index.php?action=delete&controller=commande&idCommande=' . $v_url . '">' . 'Supprimer cette commande' . '</a> </p>';
                  echo ' <a href= "index.php?action=update&controller=commande&idCommande=' . $v_url . '">' . 'Modifier cette commande' . '</a> </p>';
              }
        foreach ($tabcars as $key => $value){
            $html = htmlspecialchars($key);
            $v_url = rawurlencode($key);
            echo '<p> Voiture d\'immatriculation' . '<a href= "index.php?action=read&immatriculation=' . $v_url . '">' . $html . '</a>  x'. $value . '<br>';
        }
        ?>


