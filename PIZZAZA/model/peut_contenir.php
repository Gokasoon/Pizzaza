<?php
require_once("relation.php");
class peut_contenir extends relation{

    // attributs
    protected static string $identifiant = "Id_Ingredient";
    protected int $Id_Allergene;
    protected int $Id_Ingredient;
    protected static string $classe = "peut_contenir";

    
    
    // constructeur
    public function __construct(int $Id_Allergene = NULL, int $Id_Ingredient = NULL){
      if( !is_null($Id_Allergene)){
        $this->Id_Allergene = $Id_Allergene;
        $this->Id_Ingredient = $Id_Ingredient;
      }  
    }

    // toString
    public function __toString(){
      $allergene = Allergene::getOne($this->Id_Allergene);
      $ingredient = Ingredient::getOne($this->Id_Ingredient);
  
      $allergeneName= $allergene->get("nom_allergene");
      $ingredientName = $ingredient->get("nom_ingredient");
  
      return "$ingredientName peut contenir des traces de $allergeneName";

    }

}

?>