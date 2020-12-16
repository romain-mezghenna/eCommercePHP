<?php
require_once (File::build_path(array('model','ModelClient.php')));
// chargement du modèle
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
        $c=ModelClient::select($idclient);
        if($c->getMail()==$_SESSION['login']){
        $isDelete = ModelClient::delete($idclient);
        if($isDelete==false){
            $view='error';
            $pagetitle='Erreur';
            require(File::build_path(array('view','view.php')));
        } else{
            $messageconfirmation = "Client supprimé";
            self::readAll();
        }}
        else {
            self::connect();
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

        if($c->getMail()==$_SESSION['login']){
        $view='update';
        $pagetitle="Modifier un  client";
        $data = array(
            'idClient'=>$c->getIdClient(),
            'nom'=>$c->getNom(),
            'prenom'=>$c->getPrenom(),
            'mail'=>$c->getMail(),
            'password'=>""
        );
        $type='update';
        require (File::build_path(array('view','view.php')));}
        else {
           self::connect();
        }
    }

    public static function updated(){
        $idclient=$_GET['idClient'];
        $c = ModelVoiture::select($idclient);
        $data = array(
            'idClient'=>$idclient,
            'nom'=>$_GET['nom'],
            'prenom'=>$_GET['prenom'],
            'mail'=>$_GET['mail'],
            'password'=>Security::hacher($_GET['password']),
            'admin' => (bool)$_GET['admin']
        );
        $estModifiee = ModelClient::update($data);
        if ($estModifiee){
            $messageconfirmation = "Client modifié";
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
            'password'=>Security::hacher($_GET['password']),
            "admin" => (bool)$_GET['admin']

        );
        $estcree=ModelClient::save($data);
        if($estcree==false){
            $view='error';
            $pagetitle='Erreur';
            require(File::build_path(array('view','view.php')));
        } else{
            $messageconfirmation = "Client créer";
            self::readAll();
        }

        } else {
            $erreur = "<h1> Les deux mots de passe ne correspondent pas </h1>";
            $view='update';
            $pagetitle='Création d\'un client';
            $data = array(
                'idClient'=>"",
                'nom'=>$_GET['nom'],
                'prenom'=>$_GET['prenom'],
                'mail'=>$_GET['mail'],
                'password'=>$_GET['password']

            );
            $type='create';
            require(File::build_path(array('view','view.php')));

        }
    }


    public static function connect(){
        $pagetitle="Connexion";
        $data = array("login" => "",
            "password" => "");
        $view="connect";
        require(File::build_path(array('view','view.php')));
    }

    public static function connected(){
        if (ModelClient::checkPassword($_GET['login'],Security::hacher($_GET['password']))){
            $_SESSION['login']=$_GET['login'];
            $c=ModelClient::getClientbyMail($_GET['login']);

            if((bool)$c->getAdmin()){
                $_SESSION['admin']=$c->getAdmin();
            }
            if(!$c){
                $view='error';
                $pagetitle='Erreur';
                require(File::build_path(array('view','view.php')));
            }else {
                $view = 'detail';
                $pagetitle = 'Détail d\'un client';
                require(File::build_path(array('view', 'view.php')));
            }

        } else {
            $erreur = "Les informations ne sont pas bonnes";
            $data = array("login" => $_GET['login'],
                "password" =>$_GET['password'] );
            $pagetitle="Connexion";
            $view="connect";
            require(File::build_path(array('view','view.php')));

        }
    }

    public static function disconnect(){
        unset($_SESSION['login']);
        unset($_SESSION['admin']);
        self::readAll();
    }

}