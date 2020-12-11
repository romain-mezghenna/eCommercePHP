<?php
require_once (File::build_path(array('model','ModelVoiture.php')));// chargement du modèle
class ControllerPanier {
    private static $object = 'panier';


    public static function readAll(){
        if (isset($_SESSION['panier']) && !empty($_SESSION['panier'])){
            $tab_v = array();
            $tab_count = array_count_values($_SESSION['panier']);
            foreach ($_SESSION['panier'] as $key => $id){

                array_push($tab_v,ModelVoiture::select($id));
            }
            $view = 'list';
            require (File::build_path(array('view','view.php')));
        } else {
            $view = 'empty';
            require(File::build_path(array('view','view.php')));
        }

    }

    public static function add(){
      if (isset($_SESSION['panier'])){
          array_push($_SESSION['panier'],$_GET['immatriculation']);
      }  else {
          $_SESSION['panier']=array($_GET['immatriculation']);
      }

      ControllerVoiture::readAll();
    }

    public static function delete(){

        unset($_SESSION['panier'][array_search($_GET['immatriculation'],$_SESSION['panier'])]);
        if (isset($_SESSION['panier'])){
            $tab_v = array();
            $tab_count = array_count_values($_SESSION['panier']);
            foreach ($_SESSION['panier'] as $key => $id){

                array_push($tab_v,ModelVoiture::select($id));
            }
            $view = 'list';
            require (File::build_path(array('view','view.php')));
        } else {
            $view = 'empty';
            require(File::build_path(array('view','view.php')));
        }

    }








}