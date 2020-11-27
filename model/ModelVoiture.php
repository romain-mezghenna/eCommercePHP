<?php
require_once('Model.php');
class ModelVoiture {
  private $marque;
  private $modele;
  private $idVoiture;
  private $statut;
  private $annee;
  private $prix;

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
  public function setanee($annee2) {
    date_default_timezone_set('UTC');
    if($annee2 <= date("Y") ){
       $this->annee = $annee2;
     }
  }
  public function setId($id2) {
    $this->idVoiture = $id2;
  }

  public function setStatut($statut2) {
    $this->statut = $statut2;
  }

  // La syntaxe ... = NULL signifie que l'argument est optionel
  // Si un argument optionnel n'est pas fourni,
  //  alors il prend la valeur par défaut, NULL dans notre cas
  public function __construct($mo = NULL, $ma = NULL, $i = NULL, $a = NULL, $p = NULL){
    if (!is_null($mo) && !is_null($ma) && !is_null($i) && !is_null($a) && !is_null($p)) {
      // Si aucun de $m, $c et $i sont nuls,
      // c'est forcement qu'on les a fournis
      // donc on retombe sur le constructeur à 3 arguments
      $this->marque = $ma;
      $this->modele = $mo;
      $this->prix = $p;
      $this->idVoiture = $i;
      $this->annee = $a;
      $this->statut = 'A';
    }
  }

  // une methode d'affichage.
  public function afficher() {
    echo "Voiture d'id $this->idVoiture, de modele $this->modele, de marque $this->marque, dont le prix est $this->prix, d'année $this->annee et de statut $this->statut <br>";
  }

  public static function getAllVoitures() {
    $rep = Model::$pdo->query('Select * from voitures');
    $rep->setFetchMode(PDO::FETCH_CLASS, 'ModelVoiture');;
    return $rep->fetchAll();
  }

//  public static function getVoitureByImmat($immat) {
//    $sql = "SELECT * from voitures WHERE immatriculation=:nom_tag";
//    // Préparation de la requête
//    $req_prep = Model::$pdo->prepare($sql);
//
//    $values = array(
//        "nom_tag" => $immat,
//      //nomdutag => valeur, ...
//    );
//    // On donne les valeurs et on exécute la requête
//    $req_prep->execute($values);
//
//    // On récupère les résultats comme précédemment
//    $req_prep->setFetchMode(PDO::FETCH_CLASS, 'ModelVoiture');
//    $tab_voit = $req_prep->fetchAll();
//    // Attention, si il n'y a pas de résultats, on renvoie false
//    if (empty($tab_voit))
//      return false;
//    return $tab_voit[0];
//  }

  public function save(){
    $sql = "INSERT INTO voitures VALUES (:idVoiture,:modele, :marque, :prix, :annee, :statut)";
    try {
      $req_prep = Model::$pdo->prepare($sql);
      $value = array(
          "idVoiture"=>$this->idVoiture,
          "modele"=>$this->modele,
          "marque"=>$this->marque,
          "prix"=>$this->prix,
          "annee"=>$this->annee,
          "statut"=>$this->statut,
      );
      $req_prep->execute($value);
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
?>

