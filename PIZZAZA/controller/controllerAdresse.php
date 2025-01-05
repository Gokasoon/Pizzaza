<?php
require_once("./model/Adresse.php");
require_once("./controller/controllerObjet.php");


class controllerAdresse extends controllerObjet{
    protected static string $classe = "Adresse";
    protected static string $identifiant = "Id_Adresse";
    protected static array $champs = array(
        "numero_rue" => ["number", "numero_rue"],
        "nom_rue" => ["text","nom_rue"],
        "nom_ville" => ["text","nom_ville"],
        "CP_ville" => ["number","CP_ville"],
        "infos_supp" => ["text","infos_supp"]
    );

    public static function getChamps(){
        return self::$champs;
    }

    // public static function displayCreationForm(){
    //     $title = "Creation d'un auteur";
    //     $selectNat = nationalite::getSelect();
    //     if (session::adminConnected() && self::$classe != 'adherent'){
    //         $menu = session::urlMenu();
    //         include($menu);
    //         include("./view/debut.php");
    //         include("./view/auteur/formulaireCreation.php");
    //         include("./view/fin.php");
    //     } else {
    //         $controller = "controller".ucfirst(self::$classe);
    //         $controller::displayAll();
    //     }
        
    // }

    // public static function displayUpdateForm(){
    //     $title = "Modification d'un auteur";
    //     if (isset($_GET[self::$identifiant])) {
    //         $lui = $_GET[self::$identifiant];
    //         $classe = self::$classe;
    //         if ((session::adminConnected() && $classe != 'adherent') || (!session::adminConnected() && $classe == 'adherent' && $lui == $_SESSION['login'])){
    //             include("./view/debut.php");
    //             $menu = session::urlMenu();
    //             include($menu);
    //             $lui = $classe::getOne($lui);
    //             $selectNat = nationalite::getSelected($lui);
    //             $identifiant = self::$identifiant; 
    //             $champs = self::$champs; 
    //             include("./view/auteur/formulaireModification.php");
    //             include("./view/fin.php");
    //         } else {
    //             $controller = "controller".ucfirst($classe);
    //             $controller::displayAll();
    //         }
    //     } else {
    //         echo "pas d'identifiant écrit";
    //     }
    // }

}

?>