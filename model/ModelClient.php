<?php
require_once('Model.php');
class ModelClient extends Model {

  private $idClient;
  private $nom;
  private $prenom;
  private $mail;
  private $password;
  private static $cpt=0;
  protected static $object='Clients';
  protected static $class = 'Client';
  protected static $primary = 'idClient';

  public function getIdClient()
  {
    return $this->idClient;
  }

  public function setIdClient($idClient)
  {
    $this->idClient = $idClient;
  }

  public function getNom()
  {
    return $this->nom;
  }

  public function setNom($nom)
  {
    $this->nom = $nom;
  }

  public function getPrenom()
  {
    return $this->prenom;
  }

  public function setPrenom($prenom)
  {
    $this->prenom = $prenom;
  }

  public function getMail()
  {
    return $this->mail;
  }

  public function setMail($mail)
  {
    $this->mail = $mail;
  }

  public function getPassword()
  {
    return $this->password;
  }

  public function setPassword($password)
  {
    $this->password = $password;
  }

  public static function getCpt(){
    self::$cpt++;
    return self::$cpt;
  }

  public function __construct($i = NULL, $n = NULL, $p = NULL, $m = NULL, $pass = NULL){
    if (!is_null($i) && !is_null($n)  && !is_null($p) && !is_null($m) && !is_null($pass)) {
      // Si aucun de $m, $c et $i sont nuls,
      // c'est forcement qu'on les a fournis
      // donc on retombe sur le constructeur à 3 arguments
      $this->idClient = $i;
      $this->nom = $n;
      $this->prenom = $p;
      $this->mail = $m;
      $this->password = $pass;
    }
  }

  // une methode d'affichage.
  public function afficher() {
    echo "Client d'id $this->idClient, de nom $this->nom, de prénom $this->prenom, dont le mail est $this->mail et de mot de passe $this->password<br>";
  }


}
?>

