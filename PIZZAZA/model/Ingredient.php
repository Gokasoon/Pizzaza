<?php
require_once("objet.php");
class Ingredient extends objet
{

  // attributs
  protected static string $identifiant = "Id_Ingredient";
  protected int $Id_Ingredient;
  protected string $nom_ingredient;
  protected float $quantité;
  protected float $prix_kilo;
  protected static string $classe = "Ingredient";
  protected static array $tableauSelect = array("Id_Ingredient", "nom_ingredient");



  // constructeur
  public function __construct(int $Id_Ingredient = NULL, string $nom_ingredient = NULL, float $prix_kilo = NULL, float $quantité = NULL)
  {
    if (!is_null($Id_Ingredient)) {
      $this->Id_Ingredient = $Id_Ingredient;
      $this->nom_ingredient = $nom_ingredient;
      $this->quantité = $quantité;
      $this->prix_kilo = $prix_kilo;
    }
  }

  // toString
  public function __toString()
  {
    return "Ingredient $this->Id_Ingredient $this->nom_ingredient $this->prix_kilo € stock : $this->quantité kg";
  }

  public function getId()
  {
    return $this->Id_Ingredient;
  }
  public function getNom()
  {
    return $this->nom_ingredient;
  }
  public static function getIdentifiant()
  {
    return self::$identifiant;
  }
  public static function getClasso()
  {
    return self::$classe;
  }

  public static function create($tab)
  {
    $query = "INSERT INTO Ingredient (nom_ingredient, prix_kilo, quantité) VALUES ('" . $tab["nom_ingredient"] . "', " . $tab["prix_kilo"] . ", " . $tab["quantité"] . ")";
    echo $query;

    try {
      $res = connexion::pdo()->query($query);
    } catch (PDOException $e) {
      echo $e->getMessage();
    }
  }



}

?>