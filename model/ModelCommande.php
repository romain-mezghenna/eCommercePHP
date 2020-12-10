<?php
require_once('Model.php');

class ModelCommande extends Model
{
    private $idCommande;
    private $montant;
    private $date;
    protected static $object = 'Commande'; // nom de la table dans la BD
    protected static $class = 'Commande'; // nom du fichier sans 'Model'
    protected static $primary = 'idCommande';


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


    public function getDate()
    {
        return $this->date;
    }


    public function setDate($date)
    {
        $this->date = $date;
    } // nom de la clé primaire de la table dans la BD


    public function __construct($i = NULL, $m = NULL, $d = NULL){
        if (!is_null($i) && !is_null($m)  && !is_null($d)) {
            $this->idCommande = $i;
            $this->montant = $m;
            $this->date = $d;
        }
    }

    public function afficher(){ // une fonction d'affichage
        echo "La commande d'id " .$this->idCommande . " pour un montant de " . $this->montant . "€" . " effectué le " . $this->date;
    }



}