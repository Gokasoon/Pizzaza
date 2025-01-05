<?php
require_once("./model/Gestionnaire.php");
require_once("./model/Client.php");
require_once("./controller/controllerObjet.php");


class controllerGestionnaire extends controllerObjet{
    protected static string $classe = "Gestionnaire";
    protected static string $identifiant = "login_gestionnaire";
    protected static array $champs = array(
        "login_gestionnaire" => ["text", "identifiant"],
        "mdp_gestionnaire" => ["password", "mot de passe"],
        "nom_gestionnaire" => ["text","nom"],
        "prenom_gestionnaire" => ["text","prénom"],
        "mail_gestionnaire" => ["email","mail"],
        "tel_gestionnaire"=> ["text","téléphone"]
    );

    public static function displayAllDispo() {
        $classeRecup = static::$classe;
        $title = "les " .$classeRecup. "s";
        $identifiant = static::$identifiant;
        $champs = static::$champs;
        include("./view/debut.php");
        include("./view/menu.php");
        $tab = $classeRecup::getAll();
        $lienModifOk = false;
        $lienSupprOk = true;
        $lienAjoutOk = true;
        include("./view/list.php");
        include("./view/fin.html");
    }

    public static function displayUpdateForm(){
        $champs = static::$champs;
        $classe = static::$classe;
        $identifiant = static::$identifiant;
        $title = "Pizzaza - Mon Profil";
        if (isset($_GET[$identifiant])) {
            $lui = $_GET[$identifiant];
            include("./view/debut.php");
            include("./view/menu.php");
            $res = $classe::getOne($lui);
            if (is_object($res)){
                include("./view/formulaireModification.php");
                include("./view/fin.html");
            } else {
                echo "pas d'identifiant écrit";
            }
        } else {
            echo "pas d'identifiant écrit";
        }
    }

    public static function displayCA(){
        $title = "Pizzaza - CA";
        include("./view/debut.php");
        include("./view/menu.php");

        $CAJ = Gestionnaire::getCAJ();
        $CAH = Gestionnaire::getCAH();
        $CAM = Gestionnaire::getCAM();
        
        echo "<h2 class='margeh2'>Chiffre d'affaires journalier</h2>";
        echo "<p class='CA'>".$CAJ."€</p>";

        echo "<h2>Chiffre d'affaires hebdomadaire</h2>";
        echo "<p class='CA'>".$CAH."€</p>";

        echo "<h2>Chiffre d'affaires mensuel</h2>";
        echo "<p class='CA'>".$CAM."€</p>";

        include("./view/fin.html");
    }

    public static function displayCreationForm(){
        $champs = static::$champs;
        $classe = static::$classe;
        $identifiant = static::$identifiant;
        $title = "création d'un Gestionnaire";
        include("./view/debut.php");
        include("./view/menu.php");
        $selectClient = Client::getSelect();
        include("./view/Gestionnaire/formulaireCreation.php");
        include("./view/fin.html");        
    }

    public static function create(){
        $classe = static::$classe;
        $donnees = array();
        $id = $_GET["Id_Client"];
        $client = Client::getOne($id);
        $donnees["login_gestionnaire"] = $client->getId();
        $donnees["mdp_gestionnaire"] = $client->getMdp();
        $donnees["nom_gestionnaire"] = $client->getNom();
        $donnees["prenom_gestionnaire"] = $client->getPrenom();
        $donnees["mail_gestionnaire"] = $client->getMail();
        $donnees["tel_gestionnaire"] = $client->getTel();
        $classe::create($donnees);
        $controller = "controller".ucfirst($classe);
        if (isset($_SESSION['login_gestionnaire']) && $_GET['action'] == "create" && isset($_GET["Id_Pizza"]) && isset($_GET["Id_Ingredient"])){
            controllerPizza::displayUpdateForm();
        } else {
            $controller::displayAllDispo();
        }
    }


    
    
}

?>