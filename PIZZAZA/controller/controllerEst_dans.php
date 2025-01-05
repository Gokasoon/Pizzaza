<?php
require_once("./model/est_dans.php");
require_once("./controller/controllerObjet.php");


class controllerEst_dans extends controllerObjet{
    protected static string $identifiant = "Id_Commande";
    protected int $Id_estDans;
    protected int $Id_Commande;
    protected int $Id_Pizza;
    protected ?bool $pret;
    protected static string $classe = "est_dans";
    protected static array $champs = array(
        "Id_estDans" => ["number", "identifiant"],
        "Id_Commande" => ["number","id_commande"],
        "Id_Pizza" => ["number","id_pizza"]
    );

    public static function delete() {
        $classeRecup = static::$classe;
        $lui = array($_GET["Id_estDans"]);
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