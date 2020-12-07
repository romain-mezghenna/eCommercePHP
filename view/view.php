<!DOCTYPE html>
<html>

<head>
    <!-- L'en-tête du document avec au moins un titre -->
    <link type="text/css" rel="stylesheet"  href="style.css">
    <meta charset="utf-8">
    <title><?php echo $pagetitle;?></title>
</head>
<header>
    <div class="menu">
        <div class="menugauche">
            <a class="textmenugauche" href='index.php'>Accueil</a>
        </div>
        <div id="menumilieu">
            <a href="list.php"><img src="<?php echo File::build_path(array('images','logo2.png'));?>" ></a>
        </div>
        <div class="menudroite">

            <a class="textmenudroite" href="monCompte.php">Mon Compte (non fonctionnel)</a>
            <a class="textmenudroite" href="index.php?action=create&controller=voiture">Ajouter Une voiture</a>
            <a class="textmenudroite" href="index.php?&controller=client">Listes des clients</a>
            <a class ="textmenudroite" href="index.php?controller=client&action=create">Ajouter un client</a>
        </div>
        <div id="panier">
            <img src="<?php echo File::build_path(array('images','panier.png'));?>" alt="">
        </div>
    </div>
</header>
<!--------------header--------->

<body>
<?php
require (File::build_path(array("view", static::$object, $view.".php")));
?>
</body>
<footer>

</footer>


</html>