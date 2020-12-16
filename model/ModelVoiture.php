<?php
require_once('Model.php');
class ModelVoiture extends Model {
  private $marque;
  private $modele;
  private $immatriculation;
  private $statut;
  private $annee;
  private $prix;
  private $imagelink;
  protected static $object = 'Voitures'; // nom de la table dans la BD
  protected static $class = 'Voiture'; // nom du fichier sans 'Model'
  protected static $primary = 'immatriculation'; // nom de la clé primaire de la table dans la BD

  public function getMarque() {
       return $this->marque;  
  }

  public function getAnnee() {
    return $this->annee;
  }

  public function getModele() {
    return $this->modele;
  }

  public function getStatut() {
    return $this->statut;
  }

  public function getPrix()
  {
    return $this->prix;
  }


  public function getImmatriculation()
  {
    return $this->immatriculation;
  }

  public function getImagelink()
  {
    return $this->imagelink;
  }


  public function setImagelink($imagelink)
  {
    $this->imagelink = $imagelink;
  }




  public function setPrix($prix2)
  {
    $this->prix = $prix2;
  }

  public function setMarque($marque2) {
       $this->marque = $marque2;
  }
  public function setModele($modele2) {
       $this->modele = $modele2;
  }
  public function setAnnee($annee2) {
    date_default_timezone_set('UTC');
    if($annee2 <= date("Y") ){
       $this->annee = $annee2;
     }
  }

  public function setStatut($statut2) {
    $this->statut = $statut2;
  }

  // La syntaxe ... = NULL signifie que l'argument est optionel
  // Si un argument optionnel n'est pas fourni,
  //  alors il prend la valeur par défaut, NULL dans notre cas
  //modele,marque,immatriculation,année,prix,imagelink
  public function __construct($mo = NULL, $ma = NULL, $i = NULL, $a = NULL, $p = NULL,$image = NULL){
    if (!is_null($mo) && !is_null($ma) && !is_null($i) && !is_null($a) && !is_null($p) && !is_null($image)) {
      // Si aucun de $m, $c et $i sont nuls,
      // c'est forcement qu'on les a fournis
      // donc on retombe sur le constructeur à 3 arguments
      $this->marque = $ma;
      $this->modele = $mo;
      $this->prix = $p;
      $this->immatriculation = $i;
      $this->annee = $a;
      $this->statut = 'A';
      $this->imagelink = $image;
    }
  }

  public function afficher()
  {
    echo "<div class=\"container\">
            <a>
            <img src=\"images/$this->immatriculation.jpg\">
        </a>
            <p class=\"description\">
                Immatriculation $this->immatriculation<br>
                 Modele $this->modele<br>
                  Marque $this->marque<br>
                   Prix $this->prix<br>
                    Année $this->annee<br>
<br>
            </p>
            <a href=\"index.php?controller=panier&action=add&immatriculation=" . htmlspecialchars($this->immatriculation) . "\">Ajouter cette voiture à votre panier </a>
        </div>";
  }

}
?>

