<?php
require_once("objet.php");
class Pizza extends objet{

    // attributs
    protected static string $identifiant = "Id_Pizza";
    protected int $Id_Pizza;
    protected string $nom_pizza;
    protected float $prix_pizza;
    protected ?string $image;
    protected static string $classe = "Pizza";


    // constructeur
    public function __construct(int $Id_Pizza = NULL, string $nom_pizza = NULL, float $prix_pizza = NULL, string $image = NULL){
      if (!is_null($Id_Pizza)){
        $this->Id_Pizza = $Id_Pizza;
        $this->nom_pizza = $nom_pizza;
        $this->prix_pizza = $prix_pizza;
        $this->image = $image;
      }
    }

    // toString
    public function __toString(){
      return "Pizza $this->Id_Pizza $this->nom_pizza $this->prix_pizza €";
    }

    // getters
    public function getId() {return $this->Id_Pizza;}
    public function getNom() {return $this->nom_pizza;}
    public function getPrix() {return $this->prix_pizza;}
    public function getImg() {return $this->image;}

    public function getIngredients(){
      $query = "SELECT nom_ingredient FROM Ingredient I 
                INNER JOIN contient C ON I.Id_Ingredient = C.Id_Ingredient
                WHERE C.Id_Pizza = :id_tag;";
      $res = connexion::pdo()->prepare($query);
      $tags = array("id_tag" => $this->Id_Pizza);
      try{
        $res->execute($tags);
        $res->setFetchmode(PDO::FETCH_ASSOC);
        $tab = $res->fetchAll();
        return $tab;
      } catch (PDOException $e) {
        echo $e->getMessage();
        return null;
      }
    }

    public function getAllergenes(){
      $query = "SELECT DISTINCT nom_allergene FROM Allergene A 
                INNER JOIN peut_contenir PC ON A.Id_Allergene = PC.Id_Allergene
                INNER JOIN Ingredient I ON PC.Id_Ingredient = I.Id_Ingredient
                INNER JOIN contient C ON I.Id_Ingredient = C.Id_Ingredient
                WHERE C.Id_Pizza = :id_tag;";
      $res = connexion::pdo()->prepare($query);
      $tags = array("id_tag" => $this->Id_Pizza);
      try{
        $res->execute($tags);
        $res->setFetchmode(PDO::FETCH_ASSOC);
        $tab = $res->fetchAll();
        return $tab;
      } catch (PDOException $e) {
        echo $e->getMessage();
        return null;
      } 
    }

    public static function create($tab)
  {
    $query = "INSERT INTO Pizza (nom_pizza, prix_pizza, image) VALUES ('" . $tab["nom_pizza"] . "', " . $tab["prix_pizza"] . ", './img/pizza.png')";
    echo $query;

    try {
      $res = connexion::pdo()->query($query);
    } catch (PDOException $e) {
      echo $e->getMessage();
    }
  }

}

?>