<!DOCTYPE html>
<html>

<head>
    <!-- L'en-tête du document avec au moins un titre -->
    <link type="text/css" rel="stylesheet"  href="style.css">
    <meta charset="utf-8">
    <title><?php echo $pagetitle;?></title>
</head>
<nav style="display: inline">
    <ul>
        <li><a href='index.php'>Accueil</a></li>
        <li><a href='index.php?action=create&controller=voiture'>Ajouter une voiture</a></li>
        <li><a href='index.php?controller=client'>Clients</a></li>
        <li> <a href="index.php?controller=client&action=create">Ajouter un client</a> </li>
    </ul>
</nav>
<!--------------header--------->

<body>
<?php
require (File::build_path(array("view", static::$object, $view.".php")));
?>
</body>
</html>