<?php
require_once("./model/contient.php");
require_once("./model/Ingredient.php");
require_once("./controller/controllerObjet.php");


class controllerContient extends controllerObjet{
    protected static string $identifiant = "Id_Pizza";
    protected int $Id_Pizza;
    protected int $Id_Ingredient;
    protected float $quantité;
    protected static string $classe = "contient";
    protected static array $champs = array(
      "Id_Pizza" => ["number","identifiant"],
      "Id_Ingredient" => ["number","Ingredient"],
      "quantité" => ["decimal","quantité"]
  );

    public static function displayCreationForm(){
        $champs = static::$champs;
        $classe = static::$classe;
        $identifiant = static::$identifiant;
        $title = "Pizzaza - Ajout d'ingredient à une pizza";
        include("./view/debut.php");
        include("./view/menu.php");
        $selectIngr = Ingredient::getSelect();
        include("./view/contient/formulaireCreation.php");
        include("./view/fin.html");
    }

    public static function displayUpdateForm(){
        $champs = static::$champs;
        $classe = static::$classe;
        $identifiant = static::$identifiant;
        $title = "Pizzaza - Modification d'un ingredient d'une pizza";
        if (isset($_GET[$identifiant])) {
            $lui = $_GET[$identifiant];
           
            include("./view/debut.php");
            include("./view/menu.php");
            $res = $classe::getOne($lui);
            include("./view/contient/formulaireModification.php");
            include("./view/fin.html");
           
        } else {
            echo "pas d'identifiant écrit";
        }
    }

   
}

?>