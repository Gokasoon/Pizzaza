<?php
require_once("relation.php");
class contient_perso extends relation{

    // attributs
    protected static string $identifiant = "Id_pizza_perso";
    protected int $Id_pizza_perso;
    protected int $Id_Ingredient;
    protected float $quantité_perso;
    protected static string $classe = "contient_perso";

    
    // constructeur
    public function __construct(int $Id_pizza_perso = NULL, int $Id_Ingredient = NULL, float $quantité_perso = NULL){
      if (!is_null($Id_pizza_perso)) {
          $this->Id_pizza_perso = $Id_pizza_perso;
          $this->Id_Ingredient = $Id_Ingredient;
          $this->quantité_perso = $quantité_perso;
      }
  }
  

    // toString
    public function __toString(){
      $ingredient = Ingredient::getOne($this->Id_Ingredient);
  
      $ingredientName = $ingredient->get("nom_ingredient");
  
      return "PizzaPerso $this->Id_pizza_perso contient $this->quantité_perso kg de $ingredientName";
    }

}

?>