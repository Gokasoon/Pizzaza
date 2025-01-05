<?php
require_once("./model/Alerte.php");
require_once("./model/Ingredient.php");
require_once("./model/Produit.php");
require_once("./model/Gestionnaire.php");
require_once("./controller/controllerObjet.php");


class controllerAlerte extends controllerObjet{
    protected static string $classe = "Alerte";
    protected static string $identifiant = "Id_Alerte";
    protected static array $champs = array(
        "Id_Alerte" => ["number","identifiant"],
        "seuil_alerte" => ["decimal","seuil"],
        "Id_Ingredient" => ["number","Ingredient"],
        "Id_Produit" => ["number","Produit"],
        "Id_Gestionnaire" => ["number","gestionnaire"]
    );  

    protected static array $champsIngr = array(
        "Id_Alerte" => ["number","identifiant"],
        "seuil_alerte" => ["decimal","seuil"],
        "nom_ingredient" => ["text","ingr"],
        "quantité" => ["decimal","qt"]
    );

    protected static array $champsProd = array(
        "Id_Alerte" => ["number","identifiant"],
        "seuil_alerte" => ["decimal","seuil"],
        "nom_produit" => ["text","prod"],
        "quantité" => ["decimal","qt"]
    );


    public static function displayAll() {
        $classeRecup = static::$classe;
        $identifiant = static::$identifiant;
        $title = "Pizzaza - ".$classeRecup;
        $champs = self::$champs;
        $tab = $classeRecup::getAll();
        $lienModifOk = true;
        $lienSupprOk = true;
        $lienAjoutOk = true;
        include("./view/debut.php");
        include("./view/menu.php");
        include("./view/list.php");
        echo "<div><button id='B'><a href='index.php?objet=Alerte&action=displayAlerte'>Voir les alertes déclenchées</a></button></div>";
        include("./view/fin.html");
    }

    public static function displayAllDispo() {
        $classeRecup = static::$classe;
        $identifiant = static::$identifiant;
        $title = "Pizzaza - ".$classeRecup;
        $champs = self::$champs;
        $tab = $classeRecup::getAll();
        $lienModifOk = true;
        $lienSupprOk = true;
        $lienAjoutOk = true;
        include("./view/debut.php");
        include("./view/menu.php");
        include("./view/list.php");
        echo "<div><button id='B'><a href='index.php?objet=Alerte&action=displayAlerte'>Voir les alertes déclenchées</a></button></div>";
        include("./view/fin.html");
    }


    public static function displayCreationForm(){
        $champs = static::$champs;
        $classe = static::$classe;
        $identifiant = static::$identifiant;
        $title = "Creation d'une alerte";
        $selectIngr = Ingredient::getSelect();
        $selectProd = Produit::getSelect();
        $selectGest = Gestionnaire::getSelect();
        include("./view/debut.php");
        include("./view/menu.php");
        include("./view/Alerte/formulaireCreation.php");
        include("./view/fin.html");
    }

    public static function displayUpdateForm(){
        $champs = static::$champs;
        $classe = static::$classe;
        $identifiant = static::$identifiant;
        $title = "Pizzaza - Modification d'une alerte";
        if (isset($_GET[$identifiant])) {
            $lui = $_GET[$identifiant];
           
            include("./view/debut.php");
            include("./view/menu.php");
            $res = $classe::getOne($lui);
            $selectIngr = Ingredient::getSelected($res);
            $selectProd = Produit::getSelected($res);
            $selectGest = Gestionnaire::getSelected($res);
            include("./view/Alerte/formulaireModification.php");
            include("./view/fin.html");
           
        } else {
            echo "pas d'identifiant écrit";
        }
    }

    
}

?>