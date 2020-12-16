<?php
$v->afficher();
$v_url = rawurlencode($v->getimmatriculation());
if (isset($_SESSION['admin'])){
    echo ' <a href= "index.php?action=delete&immatriculation=' . $v_url . '">' . 'Supprimer cette voiture' . '</a> </p>';
    echo ' <a href= "index.php?action=update&immatriculation=' . $v_url . '">' . 'Modifier cette voiture' . '</a> </p>';}

?>

