<?php
require_once("./model/Produit.php");
require_once("./model/Boisson.php");
require_once("./model/Dessert.php");
require_once("./controller/controllerObjet.php");


class controllerProduit extends controllerObjet{
    protected static string $classe = "Produit";
    protected static string $identifiant = "Id_Produit";

    protected static array $champs = array(
        "Id_Produit" => ["text", "identifiant"],
        "nom_produit" => ["text","nom"],
        "type_produit" => ["text","type"],
        "prix_produit" => ["decimal","prix"],
        "quantité" => ["decimal","quantite"]
    );

    public static function displayAllDispo() {
        $classeRecup = (rand(0, 1) == 0) ? "Boisson" : "Dessert";
        $identifiant = static::$identifiant;
        $title = "Pizzaza - " . $classeRecup;
        $tab = $classeRecup::getAllDispo();
    
        include("./view/debut.php");
        include("./view/menu.php");
        include("./view/grid.php");
        include("./view/fin.html");
    }
    
}

?>