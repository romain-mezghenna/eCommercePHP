<?php

require_once (File::build_path(array('model','ModelCommande.php')));// chargement du modèle
class ControllerCommande
{
    private static $object = 'commande';

    public static function readAll() {
        $tab_c = ModelCommande::selectAll(); //appel au modèle pour gerer la BD
        $view='list';
        $pagetitle='Liste des commandes';
        //"redirige" vers la vue
        require(File::build_path(array('view','view.php')));
    }

    public static function read(){
        $idCommande = $_GET['idCommande'];
        $c=ModelCommande::select($idCommande);
        if($c==null){
            $view='error';
            $pagetitle='Erreur';
            require(File::build_path(array('view','view.php')));
        }else
            $view='detail';
        $pagetitle='Détail d\'une commande';
        require(File::build_path(array('view','view.php')));
    }

    public static function create(){
        $view='update';
        $pagetitle='Création d\'une commande';
        $data = array(
            'idCommande'=>"",
            'montant'=>"",
            'date'=>""
        );
        $type='create';
        require(File::build_path(array('view','view.php')));
    }

    public static function created(){
        $data = array(
            'idCommande'=>ModelCommande::getCpt(),
            'montant'=>$_GET['montant'],
            'date'=>$_GET['date']
        );
        $estcree=ModelCommande::save($data);
        if($estcree==false){
            $view='error';
            $pagetitle='Erreur';
            require(File::build_path(array('view','view.php')));
        } else{
            $view='created';
            $pagetitle='commande Crée';
            require(File::build_path(array('view','view.php')));
            self::readAll();
        }
    }

    public static function error(){
        $view='error';
        $pagetitle='Erreur';
        require(File::build_path(array('view','view.php')));
    }

    public static function delete(){
        $idCommande=$_GET['idCommande'];
        $isDelete = ModelCommande::delete($idCommande);
        if($isDelete==false){
            $view='error';
            $pagetitle='Erreur';
            require(File::build_path(array('view','view.php')));
        } else{
            $view='deleted';
            $pagetitle='commande Supprimée';
            require(File::build_path(array('view','view.php')));
            self::readAll();
        }

    }

    public static function update(){
        $idCommande=$_GET['idCommande'];
        $c = ModelCommande::select($idCommande);
        $view='update';
        $pagetitle="Modifier une commande";
        $data = array(
            'idCommande'=>$idCommande,
            'montant'=>$c->getMontant(),
            'date'=>$c->getDate()
        );
        $type='update';
        require (File::build_path(array('view','view.php')));
    }

    public static function updated(){
        $idCommande=$_GET['idCommande'];
        $c = ModelCommande::select($idCommande);
        $data = array(
            'idCommande'=>$idCommande,
            'montant'=>$_GET['montant'],
            'date'=>$_GET['date']
        );
        $estModifiee = ModelCommande::update($data);
        if ($estModifiee){
            $view = 'updated';
            $pagetitle="commande modifiée";
            require (File::build_path(array('view','view.php')));
            self::readAll();
        } else {
            $view='error';
            $pagetitle='Erreur';
            require(File::build_path(array('view','view.php')));
        }


    }

}