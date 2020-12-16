<?php
echo "<div class=\"liste\">";
foreach ($tab_v as $v) {
    $html = htmlspecialchars($v->getimmatriculation());
    $v_immat = rawurlencode($v->getimmatriculation());

    echo "<div class=\"container\">";
    echo '<a href= "index.php?action=read&immatriculation=' . $v_immat . '">' . '<img src="images/' . $v->getimmatriculation() . '.jpg">' . '</a>';
    echo '<p class="description"> Voiture d\'immatriculation' . '<br>' . $v_immat;

    echo "</p></div>";
}
echo "</div>";
?>