<?php
require_once('Model.php');

class ModelCommande extends Model
{
    private $idCommande;
    private $montant;
    private $idclient;
    protected static $object = 'Commande'; // nom de la table dans la BD
    protected static $class = 'Commande'; // nom du fichier sans 'Model'
    protected static $primary = 'idCommande'; // ID de la table


    public function getIdCommande()
    {
        return $this->idCommande;
    }


    public function setIdCommande($idCommande)
    {
        $this->IDCommande = $idCommande;
    }


    public function getMontant()
    {
        return $this->montant;
    }


    public function setMontant($montant)
    {
        $this->montant = $montant;
    }




    public function getIdclient()
    {
        return $this->idclient;
    }


    public function __construct($i = NULL, $m = NULL,$idclient = NULL){
        if (!is_null($i) && !is_null($m)  && !is_null($idclient)) {
            $this->idCommande = $i;
            $this->montant = $m;

            $this->idclient=$idclient;
        }
    }

    public function afficher(){ // une fonction d'affichage
        echo "La commande d'id " .$this->idCommande . " pour un montant de " . $this->montant . "€";
    }

    public static function saveCar($data){
        $sql = "INSERT INTO `Transactions` (`idCommande`, `immatriculation`, `quantite`) VALUES (:idCommande, :immatriculation, :qte)";
        try {
            $req_prep = Model::$pdo->prepare($sql);
            $req_prep->execute($data);
            return true;

        }
        catch (PDOException $e) {
            echo $e->getMessage();
            return false;

        }
    }

    public function getCars(){
        $sql = "SELECT immatriculation as immatriculation, quantite as qte FROM Transactions T JOIN Commande C ON C.idCommande = T.idCommande WHERE C.idCommande=" . $this->idCommande;
        try {
            $req_prep = Model::$pdo->prepare($sql);
            $req_prep->execute();
            $req_prep->setFetchMode(PDO::FETCH_OBJ);
            $tab = $req_prep->fetchAll();
            $tabcars = array();
            foreach ($tab as $k){
               $tabcars[$k->immatriculation]=$k->qte;
            }
            return $tabcars;

        }
        catch (PDOException $e) {
            echo $e->getMessage();
            return false;

        }
    }





}