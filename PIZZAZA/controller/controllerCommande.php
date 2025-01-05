<?php
require_once("./model/Commande.php");
require_once("./model/est_dans.php");
require_once("./model/autre_produit.php");
require_once("./model/paiement.php");
require_once("./controller/controllerObjet.php");


class controllerCommande extends controllerObjet{
    protected static string $identifiant = "Id_Commande";
    protected int $Id_Commande;
    protected string $date_commande;
    protected string $etat_commande;
    protected string $methode_paiement;
    protected string $heure_commande;
    protected static string $classe = "Commande";


    public static function displayUpdateForm(){
        $classe = static::$classe;
        $identifiant = static::$identifiant;
        $title = "Pizzaza - Mon Panier";
        if (isset($_SESSION["Id_Commande"])) {
            $lui = $_SESSION["Id_Commande"];
           
            include("./view/debut.php");
            include("./view/menu.php");
            $pizzas = est_dans::getAlli($lui); 
            $produits = autre_produit::getAlli($lui); 
            include("./view/panier.php");    
            include("./view/fin.html");
           
        } else {
            include("./view/debut.php");
            include("./view/menu.php");
            echo "<h2 class='Esp' >Panier vide</h2>";
            include("./view/fin.html");
        }
    }

   
}

?>