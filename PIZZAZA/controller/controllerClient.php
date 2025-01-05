<?php
require_once("./model/Client.php");
require_once("./model/Adresse.php");
require_once("./model/session.php");
require_once("./controller/controllerObjet.php");
require_once("./controller/controllerGens.php");
require_once("./controller/controllerAdresse.php");

class controllerClient extends controllerObjet{
    protected static string $classe = "Client";
    protected static string $identifiant = "login_client";
    protected static array $champs = array(
        "login_client" => ["text", "identifiant"],
        "mdp_client" => ["password", "mot de passe"],
        "nom_client" => ["text","nom"],
        "prenom_client" => ["text","prénom"],
        "mail_client" => ["email","mail"],
        "tel_client"=> ["text","téléphone"],
        "reduc_client" => ["number","reduc"],
        "Id_Adresse" => ["text","adresse"]
    );


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
            $selectAdr = Adresse::getSelected($res);    // TODO
            include("./view/Client/formulaireModification.php");
            include("./view/fin.html");
           
        } else {
            echo "pas d'identifiant écrit";
        }
    }


    public static function createAccount(){
        $title = "Création d'un compte";
        $donneesA = array();
        $donneesC = array();
        $champsAdresse = array_keys(controllerAdresse::getChamps());
        foreach ($_GET as $cle => $valeur) {
            if ($cle != "objet" && $cle != "action") {
                if (in_array($cle, $champsAdresse)) {
                    $donneesA[$cle] = $valeur;
                } else {
                    $donneesC[$cle] = $valeur;
                }
            }
        }
        Adresse::create($donneesA);  
        $id = Adresse::searchId($donneesA);
        $donneesC["Id_Adresse"] = $id;
        Client::create($donneesC);  
        controllerGens::connect();
    }

    public static function update(){
        $donneesA = array();
        $donneesC = array();
        $champsAdresse = array_keys(controllerAdresse::getChamps());
        foreach ($_GET as $cle => $valeur) {
            if ($cle != "objet" && $cle != "action") {
                if (in_array($cle, $champsAdresse)) {
                    $donneesA[$cle] = $valeur;
                } else {
                    $donneesC[$cle] = $valeur;
                }
            }
        }
        Adresse::create($donneesA);  
        $id = Adresse::searchId($donneesA);
        $donneesC["Id_Adresse"] = $id;
        Client::update($donneesC);  
        controllerClient::displayUpdateForm();
    }

    

}

?>