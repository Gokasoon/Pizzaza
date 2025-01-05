<?php
require_once("objet.php");
class Adresse extends objet{

    // attributs
    protected static string $identifiant = "Id_Adresse";
    protected int $Id_Adresse;
    protected int $numero_rue;
    protected string $nom_rue;
    protected string $nom_ville;
    protected int $CP_ville;
    protected ?string $infos_supp;
    protected static string $classe = "Adresse";
    protected static array $tableauSelect = array("Id_Adresse", "CONCAT(numero_rue, ' ', nom_rue, ' ', nom_ville, ' ', CP_ville)");

    


    // constructeur
    public function __construct(int $Id_Adresse = NULL, int $numero_rue = NULL, string $nom_rue = NULL, string $nom_ville = NULL, int $CP_ville = NULL, string $infos_supp = NULL){
      if (!is_null($Id_Adresse)){
        $this->Id_Adresse = $Id_Adresse;
        $this->numero_rue = $numero_rue;
        $this->nom_rue = $nom_rue;
        $this->nom_ville = $nom_ville;
        $this->CP_ville = $CP_ville;
        $this->infos_supp = $infos_supp;
        
      }
    }

    public function getId(){ return $this->Id_Adresse; }


    public static function searchID($tab){
      $sql = "SELECT Id_Adresse FROM Adresse WHERE numero_rue = :numero_rue AND nom_rue = :nom_rue AND nom_ville = :nom_ville AND CP_ville = :CP_ville";
      $req_prep = connexion::pdo()->prepare($sql);
      $req_prep->execute($tab);
      $req_prep->setFetchMode(PDO::FETCH_CLASS, 'Adresse');
      $tab = $req_prep->fetchAll();
      if (empty($tab)){
        return NULL;
      } else {
        return $tab[0]->getId();
      }
    } 

  

}

?>