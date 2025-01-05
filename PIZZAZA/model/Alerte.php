<?php
require_once("objet.php");
class Alerte extends objet{

    // attributs
    protected static string $identifiant = "Id_Alerte";
    protected int $Id_Alerte;
    protected float $seuil_alerte;
    protected ?int $Id_Produit;
    protected string $Id_Gestionnaire;
    protected ?int $Id_Ingredient;
    protected static string $classe = "Alerte";

    


    // constructeur
    public function __construct(int $Id_Alerte = NULL, float $seuil_alerte = NULL, int $Id_Produit = NULL, string $Id_Gestionnaire = NULL, int $Id_Ingredient = NULL){
      if (!is_null($Id_Alerte)){
        $this->Id_Alerte = $Id_Alerte;
        $this->seuil_alerte = $seuil_alerte;
        $this->Id_Produit = $Id_Produit;
        $this->Id_Gestionnaire = $Id_Gestionnaire;
        $this->Id_Ingredient = $Id_Ingredient;
      }
    }

    public function getId(){ return $this->Id_Alerte; }

    public static function getAlerteProd(){
        $classeRecup = static::$classe;
        $query = "SELECT * FROM alertesproduits ;";
        
        $res = connexion::pdo()->query($query);
        $res->setFetchmode(PDO::FETCH_CLASS, $classeRecup);
        $tab = $res->fetchAll();
        foreach ($tab as $key => $obj) {
            foreach ($obj as $property => $value) {
                if ($value === null) {
                    $tab[$key]->$property = 0;
                }
            }
        }
        return $tab;
    }

    public static function getAlerteIngr(){
        $classeRecup = static::$classe;
        $query = "SELECT * FROM alertesingredients ;";
        
        $res = connexion::pdo()->query($query);
        $res->setFetchmode(PDO::FETCH_CLASS, $classeRecup);
        $tab = $res->fetchAll();
        foreach ($tab as $key => $obj) {
            foreach ($obj as $property => $value) {
                if ($value === null) {
                    $tab[$key]->$property = 0;
                }
            }
        }
        return $tab;
    }
    
}

?>