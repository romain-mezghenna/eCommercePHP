<!DOCTYPE html>
<html>

<head>
    <!-- L'en-tête du document avec au moins un titre -->
    <meta charset="utf-8">
    <link rel="stylesheet" href="css/style.css">
    <title><?php echo $pagetitle; ?></title>
</head>
<header>
    <div class="menu">
        <div class="menugauche">
            <a class="textmenugauche" href='index.php'>Accueil</a>
            <a class="textmenudroite" href="index.php?controller=commande">Liste des commandes</a>
            <a class="textmenudroite" href="index.php?controller=client">Listes des clients</a>

        </div>
        <div id="menumilieu">
            <a href="index.php"><img src="images/logo2.png"></a>
        </div>
        <div class="menudroite">
            <?php
            if(isset($_SESSION['login'])){
                echo 'Bonjour ';
                $user= ModelClient::getClientbyMail($_SESSION['login']);
                    echo $user->getPrenom() . "<br>";
                    echo '<a class="textmenudroite" href="index.php?controller=client&action=read&idClient='.$user->getIdClient().'">Mon Compte </a>';

            echo "<a class=\"textmenudroite\" href=\"index.php?controller=client&action=disconnect\">Se déconnecter</a>";


            } else {
                echo "<a class=\"textmenudroite\" href=\"index.php?controller=client&action=connect\">Se Connecter</a>";
                echo '<a class="textmenudroite" href="index.php?controller=client&action=create">S\'inscrire</a>';
            }


            if(isset($_SESSION['admin'])) {
                echo '<a class="textmenudroite" href="index.php?action=create&controller=commande">Ajouter une commande</a>';
                echo '<a class="textmenudroite" href="index.php?action=create&controller=voiture">Ajouter Une voiture</a>';

            }
            ?>







        </div>
        <a id="panier" href="index.php?controller=panier">
            <img src="images/panier.png" alt="">
        </a>
    </div>
</header>

<!--------------header--------->

<body>
<?php
if (isset($messageconfirmation)) echo '<h1>' . $messageconfirmation . '</h1>';
require(File::build_path(array("view", static::$object, $view . ".php")));
?>
</body>
<footer>©classic.motorsport Created by Mezghenna Romain, Castel Florian, Shun Cathelot</footer>


</html>