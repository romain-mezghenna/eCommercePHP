<?php
require_once (File::build_path(array('model','ModelVoiture.php')));// chargement du modèle
class ControllerVoiture {
    public static function readAll() {
        $tab_v = ModelVoiture::getAllVoitures();     //appel au modèle pour gerer la BD
        require(File::build_path(array('view','voitures','list.php')));  //"redirige" vers la vue
    }

    public static function read(){
        $immatriculation = $_GET['immatriculation'];
        $v=ModelVoiture::getVoitureByImmat($immatriculation);
        if($v==null){
            require(File::build_path(array('view','voitures','error.php')));
        }else
            require(File::build_path(array('view','voitures','detail.php')));
    }

    public static function create(){
        require(File::build_path(array('view','voitures','create.php')));
    }

    public static function created(){
        $v = new ModelVoiture($_POST['modele'],$_POST['marque'],$_POST['prix'],$_POST['']);
        $estcree=$v->save();
        if($estcree==false){
            require(File::build_path(array('view','voitures','error.php')));
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