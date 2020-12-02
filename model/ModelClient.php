<?php
require_once('Model.php');
class ModelClient {

  private $idClient;
  private $nom;
  private $prenom;
  private $mail;
  private $password;
  private static $cpt;

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

  public function __construct($n = NULL, $p = NULL, $m = NULL, $pass = NULL){
    if (!is_null($n) && !is_null($p) && !is_null($m) && !is_null($pass)) {
      // Si aucun de $m, $c et $i sont nuls,
      // c'est forcement qu'on les a fournis
      // donc on retombe sur le constructeur à 3 arguments
      $this->idClient = self::$cpt;
      self::$cpt ++;
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

  public static function getAllClient() {
    $rep = Model::$pdo->query('Select * from Clients');
    $rep->setFetchMode(PDO::FETCH_CLASS, 'ModelClient');;
    return $rep->fetchAll();
  }

  public function save(){
    $sql = "INSERT INTO Clients VALUES (:idClient, :nom, :prenom, :mail, :password)";
    try {
      $req_prep = Model::$pdo->prepare($sql);
      $value = array(
          "idClient"=>$this->idClient,
          "nom"=>$this->nom,
          "prenom"=>$this->prenom,
          "mail"=>$this->mail,
          "password"=>$this->password,
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

