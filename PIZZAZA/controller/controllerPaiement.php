<?php
require_once("./model/paiement.php");
require_once("./controller/controllerObjet.php");


class controllerPaiement extends controllerObjet{
    protected static string $identifiant = "Id_Commande";
    protected int $Id_Commande;
    protected string $type_paiement;
    protected ?int $num_CB;
    protected ?int $cryptogramme;
    protected ?string $date_paiement;
    protected ?string $heure_paiement;
    protected ?float $montant;
    protected ?string $date_peremption;
    protected ?int $Id_Client;

    protected static string $classe = "paiement";

    protected static array $champs = array(
        "Id_Commande" => ["text", "identifiant"],
        "numCB" => ["number","numCB"],
        "cryptogramme" => ["number","cryptogramme"],
        "date_peremption" => ["number","date peremption"]
    );


    public static function displayUpdateForm(){
        $champs = static::$champs;
        $classe = static::$classe;
        $identifiant = static::$identifiant;
        $title = "Pizzaza - Paiement";
        if (isset($_GET[$identifiant])) {
            $lui = $_GET[$identifiant];
           
            include("./view/debut.php");
            include("./view/menu.php");
            $res = $classe::getOne($lui);
            include("./view/paiement/formulaireModification.php");
            include("./view/fin.html");
           
        } else {
            echo "pas d'identifiant écrit";
        }
    }

    public static function update(){
        $champs = static::$champs;
        $donnees = array();
        $title = "Pizzaza - Paiement effectué";
        foreach($_GET as $cle => $valeur){
            if ($valeur == "null"){
                $valeur = null;
            }
            if($cle != "objet" && $cle != "action"){
                $donnees[$cle] = $valeur;
            }
        }

        $classe = static::$classe;
        $classe::update($donnees);
        include("./view/debut.php");
        include("./view/menu.php");
        echo "<h2 class='Esp2'>Paiement effectué</h2>";
        echo "<p class='Esp' style='color:white;'>Votre commande est en cours de préparation</p>";
        include("./view/fin.html");
        unset($_SESSION["Id_Commande"]);
    }
   
}

?>