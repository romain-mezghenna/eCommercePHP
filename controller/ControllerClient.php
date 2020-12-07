<?php
require_once (File::build_path(array('model','ModelClient.php')));// chargement du modèle
class ControllerClient
{
    protected static $object='client';

    public static function readAll() {
        $tab_c = ModelCLient::selectAll(); //appel au modèle pour gerer la BD
        $view='list';

        $pagetitle='Liste des voitures';
        //"redirige" vers la vue
        require(File::build_path(array('view','view.php')));
    }

    public static function read(){
        $idclient = $_GET['idClient'];
        $c=ModelClient::select($idclient);
        if($c==null){
            $view='error';
            $pagetitle='Erreur';
            require(File::build_path(array('view','view.php')));
        }else
            $view='detail';
        $pagetitle='Détail d\'un client';
        require(File::build_path(array('view','view.php')));
    }

    public static function delete(){
        $idclient = $_GET['idClient'];
        $isDelete = ModelClient::delete($idclient);
        if($isDelete==false){
            $view='error';
            $pagetitle='Erreur';
            require(File::build_path(array('view','view.php')));
        } else{
            $view='deleted';
            $pagetitle='Client Supprimé';
            require(File::build_path(array('view','view.php')));
            self::readAll();
        }

    }

}