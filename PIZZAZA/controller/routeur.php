<?php

    $obj = "Accueil";

    $objs = ["Accueil", "Pizza", "Boisson", "Dessert", "Client", "Gestionnaire", "gens", "Ingredient", "Alerte", "contient", "Produit", "Commande", "est_dans", "autre_produit", "paiement"];

    if( isset( $_GET["objet"]) && in_array($_GET["objet"], $objs)) {
        $obj = $_GET["objet"];
    }

    $act = "displayAllDispo";
    $acts = ["displayAll", "displayOne", "displayAllDispo", "displayConnectionForm", "displayUpdateForm", "displayCreationForm", "displayAlerte", "displayCA", "connect", "disconnect", "update", "delete", "create", "createAccount", "addToCart"];
   
    $id = "";

    if( isset( $_GET["action"]) && in_array($_GET["action"], $acts)) {
        $act = $_GET["action"];
    }

    if (isset($_GET["id"])) {
        $id = $_GET["id"];
    }



    $controller = "controller".ucfirst($obj);
    require_once("./controller/$controller.php");
    require_once("./config/connexion.php");
    connexion::connect();

    
    $controller::$act();
    




?>
