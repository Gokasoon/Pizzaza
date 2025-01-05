<?php
require_once("objet.php");
class Client extends objet{

    // attributs
    protected static string $identifiant = "login_client";
    protected int $Id_Client;
    protected string $nom_client;
    protected string $prenom_client;
    protected string $mail_client;
    protected string $tel_client;
    protected string $login_client;
    protected string $mdp_client;
    protected bool $isAdmin;
    protected int $Id_Adresse;
    protected static string $classe = "Client";
    protected static string $mdp = "mdp_client";
    protected static array $tableauSelect = array("Id_Client", "CONCAT(prenom_client, ' ', nom_client)");


    


    // constructeur
    public function __construct($Id_Client = NULL, $nom_client = NULL, $prenom_client = NULL, $mail_client = NULL, $tel_client = NULL, $login_client = NULL, $mdp_client = NULL, $isAdmin = NULL, $Id_Adresse = NULL){
      if (!is_null($login_client)){
        $this->Id_Client = $Id_Client;
        $this->nom_client = $nom_client;
        $this->prenom_client = $prenom_client;
        $this->mail_client = $mail_client;
        $this->tel_client = $tel_client;
        $this->login_client = $login_client;
        $this->mdp_client = $mdp_client;
        $this->isAdmin = $isAdmin;
        $this->Id_Adresse = $Id_Adresse;
      }
    }

    public function getId(){ return $this->login_client; }
    public static function getIdentifiant(){ return self::$identifiant; }
    public static function getClasso(){ return self::$classe; }

    public function isAdmin(){ return $this->isAdmin == 1; }

    public function affichable() {return !self::isAdmin();}
    public function getMdp(){ return $this->mdp_client; }
    public function getNom(){ return $this->nom_client; }
    public function getPrenom(){ return $this->prenom_client; }
    public function getMail(){ return $this->mail_client; }
    public function getTel(){ return $this->tel_client; }

    public static function checkMDP($l, $m) {
      $classe = static::$classe;
      $identifiant = static::$identifiant;
      $mdp = static::$mdp;

      $query = "SELECT * FROM $classe WHERE $identifiant = :login AND $mdp = :mdp ;";
      $res = connexion::pdo()->prepare($query);
      $tags = array(':login' => $l, ':mdp' => $m);
      $res->execute($tags);
      $res->setFetchMode(PDO::FETCH_CLASS, $classe);
      $client = $res->fetch();
      return $client !== false;
  }
  

}

?>