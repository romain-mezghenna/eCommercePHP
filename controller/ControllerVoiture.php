<?php
require_once('../model/ModelVoiture.php'); // chargement du modèle
class ControllerVoiture {
    public static function readAll() {
        $tab_v = ModelVoiture::getAllVoitures();     //appel au modèle pour gerer la BD
        require('../view/voiture/list.php');  //"redirige" vers la vue
    }

    public static function read(){
        $immatriculation = $_GET['immatriculation'];
        $v=ModelVoiture::getVoitureByImmat($immatriculation);
        if($v==null){
            require('../view/voiture/error.php');
        }else
            require('../view/voiture/detail.php');
    }

    public static function create(){
        require('../view/voiture/create.php');
    }

    public static function created(){
        $v = new ModelVoiture($_POST['marque'],$_POST['couleur'],$_POST['immatriculation']);
        $estcree=$v->save();
        if($estcree==false){
            require('../view/voiture/errorImmat.php');
        } else{
            self::readAll();
        }
    }

    public static function delete(){
        $sql = "DELETE FROM voiture WHERE immatriculation=:immat";
        try {
            $req_prep = Model::$pdo->prepare($sql);
            $value = array(
                "immat"=>$_GET['immatriculation'],
            );
            $req_prep->execute($value);
            self::readAll();
        }
        catch (PDOException $e) {
            echo $e->getMessage();
        }
    }
}
?>