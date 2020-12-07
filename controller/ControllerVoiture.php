<?php
require_once (File::build_path(array('model','ModelVoiture.php')));// chargement du modèle
class ControllerVoiture {
    protected static $object = 'voitures';

    public static function readAll() {
        $tab_v = ModelVoiture::selectAll(); //appel au modèle pour gerer la BD
        $view='list';
        $pagetitle='Liste des voitures';
          //"redirige" vers la vue
        require(File::build_path(array('view','view.php')));
    }

    public static function read(){
        $immatriculation = $_GET['immatriculation'];
        $v=ModelVoiture::select($immatriculation);
        if($v==null){
            $view='error';
            $pagetitle='Erreur';
            require(File::build_path(array('view','view.php')));
        }else
            $view='detail';
        $pagetitle='Détail d\'une voiture';
        require(File::build_path(array('view','view.php')));
    }

    public static function create(){
        $view='create';
        $pagetitle='Création d\'une voiture';
        require(File::build_path(array('view','view.php')));
    }

    public static function created(){
        $v = new ModelVoiture($_GET['modele'],$_GET['marque'],$_GET['immatriculation'],$_GET['annee'],$_GET['prix'],$_GET['imagelink']);
        $estcree=$v->save();
        if($estcree==false){
            $view='error';
            $pagetitle='Erreur';
            require(File::build_path(array('view','view.php')));
        } else{
            $view='created';
            $pagetitle='Voiture Crée';
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
        $immatriculation=$_GET['immatriculation'];
        $isDelete = ModelVoiture::delete($immatriculation);
        if($isDelete==false){
            $view='error';
            $pagetitle='Erreur';
            require(File::build_path(array('view','view.php')));
        } else{
            $view='deleted';
            $pagetitle='Voiture Supprimée';
            require(File::build_path(array('view','view.php')));
            self::readAll();
        }

    }

    public static function update(){
        $immatriculation=$_GET['immatriculation'];
        $v = ModelVoiture::getVoitureByImmat($immatriculation);
        $view='update';
        $pagetitle="Modifier une voiture";
        require (File::build_path(array('view','view.php')));
    }

    public static function updated(){
        $immatriculation=$_GET['immatriculation'];
        $v = ModelVoiture::getVoitureByImmat($immatriculation);
        $data = array(
          'immatriculation'=>$immatriculation,
          'modele'=>$_GET['modele'],
          'marque'=>$_GET['marque'],
          'prix'=>$_GET['prix'],
          'annee'=>$_GET['annee'],
            'statut'=>$_GET['statut'],
            'imagelink'=>$_GET['imagelink']
        );
        $estModifiee = ModelVoiture::update($data);
        if ($estModifiee){
            $view = 'updated';
            $pagetitle="Voiture modifiée";
            require (File::build_path(array('view','view.php')));
            self::readAll();
        } else {
            $view='error';
            $pagetitle='Erreur';
            require(File::build_path(array('view','view.php')));
        }


    }


}
?>