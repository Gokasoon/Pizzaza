<?php
require_once("./model/Dessert.php");
require_once("./controller/controllerObjet.php");


class controllerDessert extends controllerObjet{
    protected static string $classe = "Dessert";
    protected static string $identifiant = "Id_Produit";

    protected static array $champs = array(
        "Id_Produit" => ["text", "identifiant"],
        "nom_produit" => ["text","nom"],
        "type_produit" => ["text","type"],
        "prix_produit" => ["decimal","prix"],
        "quantité" => ["decimal","quantité"]
    );
}

?>