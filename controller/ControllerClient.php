<?php
require_once (File::build_path(array('model','ModelClient.php')));// chargement du modèle
require_once (File::build_path(array('lib','Security.php'))); // chargement de la fonction de hachage
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
        if(!$c){
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

    public static function create(){
        $view='update';
        $pagetitle='Création d\'un client';
        $data = array(
            'idClient'=>"",
            'nom'=>"",
            'prenom'=>"",
            'mail'=>"",
            'password'=>""

        );
        $type='create';
        require(File::build_path(array('view','view.php')));
    }

    public static function update(){
        $idclient = $_GET['idClient'];
        $c=ModelClient::select($idclient);
        $view='update';
        $pagetitle="Modifier une voiture";
        $data = array(
            'idClient'=>$c->getIdClient(),
            'nom'=>$c->getNom(),
            'prenom'=>$c->getPrenom(),
            'mail'=>$c->getMail(),
            'password'=>$c->getPassword()
        );
        $type='update';
        require (File::build_path(array('view','view.php')));
    }

    public static function updated(){
        $idclient=$_GET['idClient'];
        $c = ModelVoiture::select($idclient);
        $data = array(
            'idClient'=>$idclient,
            'nom'=>$_GET['nom'],
            'prenom'=>$_GET['prenom'],
            'mail'=>$_GET['mail'],
            'password'=>Security::hacher($_GET['password'])

        );
        $estModifiee = ModelClient::update($data);
        if ($estModifiee){
            $view = 'updated';
            $pagetitle="Client modifié";
            require (File::build_path(array('view','view.php')));
            self::readAll();
        } else {
            $view='error';
            $pagetitle='Erreur';
            require(File::build_path(array('view','view.php')));
        }

    }
    public static function created(){
        if($_GET['passwordconf']==$_GET['password']){

        $erreur ="";
        $data = array(
            'idClient'=>ModelClient::getCpt(),
            'nom'=>$_GET['nom'],
            'prenom'=>$_GET['prenom'],
            'mail'=>$_GET['mail'],
            'password'=>Security::hacher($_GET['password'])

        );
        $estcree=ModelClient::save($data);
        if($estcree==false){
            $view='error';
            $pagetitle='Erreur';
            require(File::build_path(array('view','view.php')));
        } else{
            $view='created';
            $pagetitle='Client Crée';
            require(File::build_path(array('view','view.php')));
            self::readAll();
        }

        } else {
            $erreur = "<h1> Les deux mots de passe ne correspondent pas </h1>";
            $view='update';
            $pagetitle='Création d\'un client';
            $data = array(
                'idClient'=>"",
                'nom'=>"",
                'prenom'=>"",
                'mail'=>"",
                'password'=>""

            );
            $type='create';
            require(File::build_path(array('view','view.php')));

        }
    }
    /*
    public static function account(){

        if(isset($_SESSION['login'])){
            $idClient = $_GET['idClient'];
            $c = ModelClient::select($idClient);
        } else {

        }


    }*/

}