
<?php
foreach ($tab_c as $c){
    $htmlid = htmlspecialchars($c->getIdClient());
    $htmlnom = htmlspecialchars($c->getNom());
    $htmlprenom = htmlspecialchars($c->getPrenom());
    $c_url = rawurldecode($c->getIdClient());


    echo '<p><a href="index.php?action=read&controller=client&idClient=' . $c_url . '"> Client d\'id </a>'  .  $htmlid  . ' ' . $htmlnom . ' ' . $htmlprenom  ;
}
?>