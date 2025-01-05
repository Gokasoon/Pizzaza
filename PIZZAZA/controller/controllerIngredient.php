<?php
require_once("./model/Ingredient.php");
require_once("./controller/controllerObjet.php");


class controllerIngredient extends controllerObjet{
    protected static string $classe = "Ingredient";
    protected static string $identifiant = "Id_Ingredient";
    protected static array $champs = array(
        "Id_Ingredient" => ["number", "identifiant"],
        "nom_ingredient" => ["text","nom"],
        "quantité" => ["decimal","quantité"],
        "prix_kilo"=> ["decimal","prix_kilo"]
    );


    public static function displayAllDispo() {
        $classeRecup = static::$classe;
        $title = "Pizzaza - Ingredient";
        $identifiant = static::$identifiant;
        $champs = static::$champs;
        include("./view/debut.php");
        include("./view/menu.php");
        $tab = $classeRecup::getAll();
        $lienModifOk = true;
        $lienSupprOk = true;
        $lienAjoutOk = true;
        include("./view/list.php");
        include("./view/fin.html");
    }

    public static function displayAll(){
        self::displayAllDispo();
    }

    public static function displayCreationForm(){
        $champs = static::$champs;
        $classe = static::$classe;
        $identifiant = static::$identifiant;
        $title = "Creation Ingredient";
        include("./view/debut.php");
        include("./view/menu.php");
        include("./view/Ingredient/formulaireCreation.php");
        include("./view/fin.html");
    }
}

?>