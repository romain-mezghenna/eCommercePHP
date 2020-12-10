
<?php
echo 'Votre panier : <br>';
$tab_tmp = $tab_count;

foreach ($tab_v as $v){
    $html = htmlspecialchars($v->getimmatriculation());
    $v_url = rawurlencode($v->getimmatriculation());

    if ($tab_tmp[$v->getimmatriculation()]==1){



    echo '<p> Voiture d\'immatriculation' . '<a href= "index.php?action=read&immatriculation=' . $v_url . '">' . $html . '</a>  x' . $tab_count[$v->getimmatriculation()];
    echo ' <a href= "index.php?action=delete&controller=panier&immatriculation=' . $v_url . '">' . 'Supprimer cette voiture de votre panier ' . '</a> </p>';
    } else {
        $tab_tmp[$v->getimmatriculation()]--;
    }
}
?>