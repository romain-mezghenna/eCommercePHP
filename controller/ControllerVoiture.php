<?php
require_once (File::build_path(array('model','ModelVoiture.php')));// chargement du modèle
class ControllerVoiture {

    public static function readAll() {
        $tab_v = ModelVoiture::getAllVoitures(); //appel au modèle pour gerer la BD
        $view='list';
        $controller='voitures';
        $pagetitle='Liste des voitures';
          //"redirige" vers la vue
        require(File::build_path(array('view','view.php')));
    }

    public static function read(){
        $immatriculation = $_GET['immatriculation'];
        $v=ModelVoiture::getVoitureByImmat($immatriculation);
        $controller='voitures';
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
        $controller='voitures';
        $view='create';
        $pagetitle='Création d\'une voiture';
        require(File::build_path(array('view','view.php')));
    }

    public static function created(){
        $controller='voitures';
        $v = new ModelVoiture($_GET['modele'],$_GET['marque'],$_GET['immatriculation'],$_GET['annee'],$_GET['prix'],$_GET['imagelink']);
        $estcree=$v->save();
        if($estcree==false){
            $view='error';
            $pagetitle='Erreur';
            require(File::build_path(array('view','view.php')));
        } else{
            $view='created';
            $controller='voitures';
            $pagetitle='Voiture Crée';
            require(File::build_path(array('view','view.php')));
            self::readAll();
        }
    }

    public static function error(){
        $controller='voitures';
        $view='error';
        $pagetitle='Erreur';
        require(File::build_path(array('view','view.php')));
    }

    public static function delete(){
        $controller='voitures';
        $immatriculation=$_GET['immatriculation'];
        $sql = "DELETE FROM Voitures WHERE immatriculation=:immatriculation";
        try {
            $req_prep = Model::$pdo->prepare($sql);
            $value = array(
                "immatriculation"=>$immatriculation,
            );
            $req_prep->execute($value);
            $view='deleted';
            $pagetitle='Voiture supprimée';
            require(File::build_path(array('view','view.php')));
            self::readAll();
        }
        catch (PDOException $e) {
            echo $e->getMessage();

        }
    }

    public static function update(){
        $controller='voitures';
        $immatriculation=$_GET['immatriculation'];
        $v = ModelVoiture::getVoitureByImmat($immatriculation);
        $view='update';
        $pagetitle="Modifier une voiture";
        require (File::build_path(array('view','view.php')));
    }

    public static function updated(){
        $controller='voitures';
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