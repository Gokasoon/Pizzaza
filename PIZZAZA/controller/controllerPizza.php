<?php
require_once("./model/Pizza.php");
require_once("./model/contient.php");
require_once("./controller/controllerObjet.php");


class controllerPizza extends controllerObjet{
    protected static string $classe = "Pizza";
    protected static string $identifiant = "Id_Pizza";

    protected static array $champs = array(
        "Id_Pizza" => ["text", "identifiant"],
        "nom_pizza" => ["text","nom"],
        "prix_pizza" => ["decimal","prix"]
    );

    public static function displayCreationForm(){
        $champs = static::$champs;
        $classe = static::$classe;
        $identifiant = static::$identifiant;
        $title = "Creation d'une pizza";
        include("./view/debut.php");
        include("./view/menu.php");
        include("./view/Pizza/formulaireCreation.php");
        include("./view/fin.html");
    }

    public static function displayUpdateForm(){
        $champs = static::$champs;
        $classe = static::$classe;
        $identifiant = static::$identifiant;
        $title = "Pizzaza - Modification d'une pizza";
        if (isset($_GET[$identifiant])) {
            $lui = $_GET[$identifiant];
           
            include("./view/debut.php");
            include("./view/menu.php");
            $res = $classe::getOne($lui);
            include("./view/Pizza/formulaireModification.php");
            include("./view/fin.html");
           
        } else {
            echo "pas d'identifiant écrit";
        }
    }
}

?>