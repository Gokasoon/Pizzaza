<?php
require_once("objet.php");
class contient extends objet
{

  // attributs
  protected static string $identifiant = "Id_Pizza";
  protected int $Id_Pizza;
  protected int $Id_Ingredient;
  protected float $quantité;
  protected static string $classe = "contient";
  protected static array $champs = array(
    "Id_Pizza" => ["number", "identifiant"],
    "Id_Ingredient" => ["number", "ingr"],
    "quantité" => ["decimal", "qt"]
  );



  // constructeur
  public function __construct(int $Id_Pizza = NULL, int $Id_Ingredient = NULL, float $quantité = NULL)
  {
    if (!is_null($Id_Pizza)) {
      $this->Id_Pizza = $Id_Pizza;
      $this->Id_Ingredient = $Id_Ingredient;
      $this->quantité = $quantité;
    }
  }

  // toString
  public function __toString()
  {
    $pizza = Pizza::getOne($this->Id_Pizza);
    $ingredient = Ingredient::getOne($this->Id_Ingredient);

    $pizzaName = $pizza->get("nom_pizza");
    $ingredientName = $ingredient->get("nom_ingredient");

    return "$pizzaName contient $this->quantité kg de $ingredientName";
  }

  public static function getChamps()
  {
    return self::$champs;
  }
  public static function getId()
  {
    return self::$identifiant;
  }
  public function getIdi()
  {
    return $this->Id_Pizza;
  }
  public function getIngr()
  {
    return $this->Id_Ingredient;
  }
  public static function getClassee()
  {
    return self::$classe;
  }

  public static function displayCreationForm()
  {
    $champs = static::$champs;
    $classe = static::$classe;
    $identifiant = static::$identifiant;
    $title = "Pizzaza - Ajout d'ingredient à une pizza";
    include("./view/debut.php");
    include("./view/menu.php");
    include("./view/contient/formulaireCreation.php");
    include("./view/fin.html");
  }

  public static function create($tab)
  {
    $query = "INSERT INTO contient (Id_Pizza, Id_Ingredient, quantité) VALUES ('" . $tab["Id_Pizza"] . "', " . $tab["Id_Ingredient"] . ", " . $tab["quantité"] . ")";
    echo $query;

    try {
      $res = connexion::pdo()->query($query);
    } catch (PDOException $e) {
      echo $e->getMessage();
    }
  }
}

?>