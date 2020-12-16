

        <?php
              $c->afficher();
              if (Session::is_user($c->getMail())){
                  $v_url = rawurlencode($c->getIdClient());
                  echo ' <a href= "index.php?action=delete&controller=client&idClient=' . $v_url . '">' . 'Supprimer ce client' . '</a> </p>';
                  echo ' <a href= "index.php?action=update&controller=client&idClient=' . $v_url . '">' . 'Modifier ce client ' . '</a> </p>';
              }
        ?>


