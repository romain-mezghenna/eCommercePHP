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
            $tabcars = $c->getCars();

        require(File::build_path(array('view','view.php')));
    }

    public static function create(){
        $view='update';
        $pagetitle='Création d\'une commande';
        $data = array(
            'idCommande'=>"",
            'montant'=>""

        );
        $type='create';
        require(File::build_path(array('view','view.php')));
    }

    public static function created(){
        $data = array(
            'idCommande'=>ModelCommande::getCpt(),
            'montant'=>$_GET['montant'],
            'idClient' => $_GET['idClient']
        );
        $estcree=ModelCommande::save($data);
        if($estcree==false){
            $view='error';
            $pagetitle='Erreur';
            require(File::build_path(array('view','view.php')));
        } else{
            $messageconfirmation = "Commande créee";
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
            $messageconfirmation = "Commande supprimé";
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

            'idClient' => $_GET['idClient']
        );
        $estModifiee = ModelCommande::update($data);
        if ($estModifiee){
            $messageconfirmation = "Commande modifiée";
            self::readAll();
        } else {
            $view='error';
            $pagetitle='Erreur';
            require(File::build_path(array('view','view.php')));
        }


    }

    public static function purchase(){
        $tab_v = array();
        $montantTotal=0;
        $tab_count = array_count_values($_SESSION['panier']);
        foreach ($_SESSION['panier'] as $key => $id){
            array_push($tab_v,ModelVoiture::select($id));
        }
        foreach ($tab_v as $v){
            $montantTotal+=$v->getPrix();
        }
        $data = array(
            'idCommande'=>ModelCommande::getCpt(),
            'montant'=>$montantTotal,
            'idClient' => $_GET['idClient']
        );

        $estcree=ModelCommande::save($data);
        if (!$estcree){
            $view='error';
            $pagetitle='Erreur';
            require(File::build_path(array('view','view.php')));
        } else {


            foreach ($tab_v as $v){
                $info = array(
                    'immatriculation' => $v->getImmatriculation(),
                    'qte' => $tab_count[$v->getImmatriculation()],
                    'idCommande' => $data['idCommande']
                );
                ModelCommande::saveCar($info);
            }

            self::readAll();
        }
    }

}