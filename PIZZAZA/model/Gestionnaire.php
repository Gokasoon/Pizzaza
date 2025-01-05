<?php
require_once("objet.php");
class Gestionnaire extends objet{

    // attributs
    protected static string $identifiant = "login_gestionnaire";
    protected int $Id_Gestionnaire;
    protected string $nom_gestionnaire;
    protected string $prenom_gestionnaire;
    protected string $mail_gestionnaire;
    protected string $tel_gestionnaire;
    protected string $login_gestionnaire;
    protected string $mdp_gestionnaire;
    protected static string $classe = "Gestionnaire";
    protected static string $mdp = "mdp_gestionnaire";

    protected static array $tableauSelect = array("Id_Gestionnaire", "login_gestionnaire");

    


    // constructeur
    public function __construct($Id_Gestionnaire = NULL, $nom_gestionnaire = NULL, $prenom_gestionnaire = NULL, $mail_gestionnaire = NULL, $tel_gestionnaire = NULL, $login_gestionnaire = NULL, $mdp_gestionnaire = NULL){
      if (!is_null($login_gestionnaire)){
        $this->Id_Gestionnaire = $Id_Gestionnaire;
        $this->nom_gestionnaire = $nom_gestionnaire;
        $this->prenom_gestionnaire = $prenom_gestionnaire;
        $this->mail_gestionnaire = $mail_gestionnaire;
        $this->tel_gestionnaire = $tel_gestionnaire;
        $this->login_gestionnaire = $login_gestionnaire;
        $this->mdp_gestionnaire = $mdp_gestionnaire;
      }
    }

    public function getId(){ return $this->login_gestionnaire; }
    public static function getIdentifiant(){ return self::$identifiant; }
    public static function getClasso(){ return self::$classe; }

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

  public static function getCAJ(){ 
    $sql = "SELECT chiffreAffairesJournalier(CURDATE()) as CAJ";
    $res = connexion::pdo()->query($sql);
    $res->setFetchMode(PDO::FETCH_ASSOC);
    $tab = $res->fetchAll();
    return $tab[0]["CAJ"];
  }

  public static function getCAH(){ 
    $sql = "SELECT chiffreAffairesHebdomadaire(CURDATE()) as CAH";
    $res = connexion::pdo()->query($sql);
    $res->setFetchMode(PDO::FETCH_ASSOC);
    $tab = $res->fetchAll();
    return $tab[0]["CAH"];
  }

  public static function getCAM(){ 
    $sql = "SELECT chiffreAffairesMensuel(CURDATE()) as CAM";
    $res = connexion::pdo()->query($sql);
    $res->setFetchMode(PDO::FETCH_ASSOC);
    $tab = $res->fetchAll();
    return $tab[0]["CAM"];
  }

  public static function create($tab)
{
  $query = "INSERT INTO Gestionnaire (login_gestionnaire, mdp_gestionnaire, prenom_gestionnaire, nom_gestionnaire, mail_gestionnaire, tel_gestionnaire) 
            VALUES (:login, :mdp, :prenom, :nom, :mail, :tel)";

  $values = array(
    ":login" => $tab["login_gestionnaire"],
    ":mdp" => $tab["mdp_gestionnaire"],
    ":prenom" => $tab["prenom_gestionnaire"],
    ":nom" => $tab["nom_gestionnaire"],
    ":mail" => $tab["mail_gestionnaire"],
    ":tel" => $tab["tel_gestionnaire"]
  );

  try {
    $res = connexion::pdo()->prepare($query);
    $res->execute($values);
  } catch (PDOException $e) {
    echo $e->getMessage();
  }
}

  

}

?>