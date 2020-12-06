<?php
require_once (File::build_path(array('model','ModelClient.php')));// chargement du modèle
class ControllerClient
{
    public static function readAll() {
        $tab_c = ModelCLient::getAllClient(); //appel au modèle pour gerer la BD
        $view='list';
        $controller='client';
        $pagetitle='Liste des voitures';
        //"redirige" vers la vue
        require(File::build_path(array('view','view.php')));
    }

}