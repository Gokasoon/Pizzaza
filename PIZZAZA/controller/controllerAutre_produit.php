<?php
require_once("./model/autre_produit.php");
require_once("./controller/controllerObjet.php");


class controllerAutre_produit extends controllerObjet{
    protected static string $identifiant = "Id_Commande";
    protected int $Id_Produit;
    protected int $Id_Commande;
    protected int $quantité;
    protected static string $classe = "autre_produit";
    protected static array $champs = array(
        "Id_Commande" => ["number", "identifiant"],
        "Id_Produit" => ["number","id_produit"],
        "quantité" => ["number","quantite"]
    );


    public static function delete() {
        $classeRecup = static::$classe;
        $lui = array($_GET["Id_Commande"], $_GET["Id_Produit"]);
        $classeRecup::delete($lui);
        $controller = "controller".ucfirst($classeRecup);
        if ($classeRecup == "est_dans" || $classeRecup == "autre_produit"){
            controllerCommande::displayUpdateForm();
        } else {
            $controller::displayAllDispo();                    
        }
        
    }
    
   
}

?>