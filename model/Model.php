<?php
require_once(File::build_path(array('config','Conf.php')));

class Model {

    public static $pdo;public static function Init() {
        $hostname = Conf::getHostname();
        $database_name = Conf::getDatabase();
        $login  = Conf::getLogin();
        $password = Conf::getPassword();

        try{
            self::$pdo = new PDO("mysql:host=$hostname;dbname=$database_name", $login, $password,
                array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"));
            self::$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        } catch(PDOException $e) {
            if (Conf::getDebug()) {
                echo $e->getMessage(); // affiche un message d'erreur
            } else {
                echo 'Une erreur est survenue <a href="index.php"> retour a la page d\'accueil </a>';
            }
            die();
        }
    }

    public static function selectAll(){
        $table_name = static::$object;
        $class_name = 'Model'. static::$class;
        $rep = Model::$pdo->query('Select * from ' . $table_name);
        $rep->setFetchMode(PDO::FETCH_CLASS, $class_name);;
        return $rep->fetchAll();
    }

    public static function select($primary_value){

        $table_name = static::$object;
        $class_name = 'Model'. static::$class;

        $primary_key= static::$primary;
        $sql = 'SELECT * from ' . $table_name . ' WHERE ' . $primary_key . ' =:id';
        // Préparation de la requête
        $req_prep = Model::$pdo->prepare($sql);
        $values = array("id" => $primary_value);
        $req_prep->execute($values);
        // On récupère les résultats comme précédemment
        $req_prep->setFetchMode(PDO::FETCH_CLASS , $class_name);
        $tab_voit = $req_prep->fetchAll();
        if (empty($tab_voit))
            return false;
        return $tab_voit[0];
    }

    public static function getCpt(){ //calculer le prochain indice de l'ID dans les tables Clients et Commande

        $table_name = static::$object;
        $primary_key= static::$primary;

        $sql = "SELECT MAX(". $primary_key . ") as max FROM " . $table_name;

        try {
            $req_prep = Model::$pdo->prepare($sql);
            $req_prep->execute();
            $req_prep->setFetchMode(PDO::FETCH_OBJ);
            $tab = $req_prep->fetchAll();
            $return =(int) $tab[0]->max;
            $return++;
            return $return;
        }
        catch (PDOException $e) {
            echo $e->getMessage();

        }

    }

    public static function delete($primary){
        $table_name = static::$object;
        $primary_key= static::$primary;

        $sql = "DELETE FROM " . $table_name . " WHERE " . $primary_key  . "=:tag";

        try {
            $req_prep = Model::$pdo->prepare($sql);
            $value = array(
                "tag"=>$primary,
            );
            $req_prep->execute($value);
            return true;
        }
        catch (PDOException $e) {
            echo $e->getMessage();

        }

    }

    public static function update($data){
        $table_name = static::$object;
        $primary_key= static::$primary;

        $sql = "UPDATE ". $table_name ." SET ";
        foreach ($data as $key => $value){
            $sql .= $key. " =:" . $key . ",";
        }
        $sql = rtrim($sql,',');
        $sql .= " WHERE " . $primary_key . "=:" .$primary_key;
        try {
            $req_prep = Model::$pdo->prepare($sql);
            $req_prep->execute($data);
            return true;
        }
        catch (PDOException $e) {
            if($e->getCode()==23000){
                return false;
            }else {
                echo $e->getMessage();
            }
            die();
        }

    }

    public static function save($data){
        $table_name = static::$object;
        $sql = "INSERT INTO " . $table_name . " VALUES(";
        $values =array();
        foreach ($data as $key => $value){
            $sql .= ":".$key.",";

        }
        $sql = rtrim($sql,',');
        $sql.=")";
        try {
            $req_prep = Model::$pdo->prepare($sql);
            $req_prep->execute($data);
            return true;
        }
        catch (PDOException $e) {
            if($e->getCode()==23000){
                return false;
            }else {
                echo $e->getMessage();
            }
            die();
        }
    }


}

Model::Init();
?>