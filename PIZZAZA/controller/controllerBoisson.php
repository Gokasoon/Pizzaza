<?php
require_once("./model/Boisson.php");
require_once("./controller/controllerObjet.php");


class controllerBoisson extends controllerObjet{
    protected static string $classe = "Boisson";
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