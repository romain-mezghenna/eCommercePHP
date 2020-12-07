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
        $view='update';
        $pagetitle='Création d\'une voiture';
        $data = array(
            'immatriculation'=>"",
            'modele'=>"",
            'marque'=>"",
            'prix'=>"",
            'annee'=>"",
            'statut'=>"",
            'imagelink'=>""
        );
        $type='create';
        require(File::build_path(array('view','view.php')));
    }

    public static function created(){
        $data = array(
            'immatriculation'=>$_GET['immatriculation'],
            'modele'=>$_GET['modele'],
            'marque'=>$_GET['marque'],
            'prix'=>$_GET['prix'],
            'annee'=>$_GET['annee'],
            'statut'=>"V",
            'imagelink'=>$_GET['imagelink']
        );
        $estcree=ModelVoiture::save($data);
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
        $v = ModelVoiture::select($immatriculation);
        $view='update';
        $pagetitle="Modifier une voiture";
        $data = array(
            'immatriculation'=>$immatriculation,
            'modele'=>$v->getModele(),
            'marque'=>$v->getMarque(),
            'prix'=>$v->getPrix(),
            'annee'=>$v->getAnnee(),
            'statut'=>$v->getStatut(),
            'imagelink'=>$v->getImagelink()
        );
        $type='update';
        require (File::build_path(array('view','view.php')));
    }

    public static function updated(){
        $immatriculation=$_GET['immatriculation'];
        $v = ModelVoiture::select($immatriculation);
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