<?php
require_once('Model.php');
class ModelClient extends Model {

  private $idClient;
  private $nom;
  private $prenom;
  private $mail;
  private $password;
  private static $cpt=0;
  private $admin;
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

  public function getAdmin()
  {
    return $this->admin;
  }



  public function __construct($i = NULL, $n = NULL, $p = NULL, $m = NULL, $pass = NULL,$a = NULL){
    if (!is_null($i) && !is_null($a) && !is_null($n)  && !is_null($p) && !is_null($m) && !is_null($pass)) {
      // Si aucun de $m, $c et $i sont nuls,
      // c'est forcement qu'on les a fournis
      // donc on retombe sur le constructeur à 3 arguments
      $this->idClient = $i;
      $this->nom = $n;
      $this->prenom = $p;
      $this->mail = $m;
      $this->password = $pass;
      $this->admin = $a;
    }
  }

  // une methode d'affichage.
  public function afficher() {
    echo "Client d'id $this->idClient, de nom $this->nom, de prénom $this->prenom, dont le mail est $this->mail et de mot de passe $this->password";
    if($this->admin){
      echo " est un administrateur <br>";
    } else {
      echo "<br>";
    }
  }

  public static function checkPassword($login,$hached){
    $sql = "SELECT COUNT(*) as nb FROM Clients WHERE mail=:login AND password=:hached";
    try {
      $values = array("login" => $login, "hached" => $hached);
      $req_prep = Model::$pdo->prepare($sql);
      $req_prep->execute($values);
      $req_prep->setFetchMode(PDO::FETCH_OBJ);
      $tab = $req_prep->fetchAll();
      $return =(int) $tab[0]->nb;
      if($return==0){
        return false;
      } else {
        return true;
      }

    }
    catch (PDOException $e) {
      echo $e->getMessage();

    }
  }

  public static function getClientbyMail($mail){
    $sql = "SELECT *  FROM Clients WHERE mail=:login";
    try {
      $values = array("login" => $mail);
      $req_prep = Model::$pdo->prepare($sql);
      $req_prep->execute($values);
      $req_prep->setFetchMode(PDO::FETCH_CLASS,'ModelClient');
      $tab = $req_prep->fetchAll();

      if (empty($tab))
        return false;
      return $tab[0];

    }
    catch (PDOException $e) {
      echo $e->getMessage();

    }
  }


}
?>

