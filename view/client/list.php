
<?php
foreach ($tab_c as $c){
    $htmlid = htmlspecialchars($c->getIdClient());
    $htmlnom = htmlspecialchars($c->getNom());
    $htmlprenom = htmlspecialchars($c->getPrenom());


    echo '<p> Client d\'id' .  $htmlid  . ' ' . $htmlnom . ' ' . $htmlprenom  ;
}
?>