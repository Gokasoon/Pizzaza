<?php
require_once("./model/Gestionnaire.php");
require_once("./model/Client.php");
require_once("./model/session.php");
require_once("./controller/controllerObjet.php");
require_once("./controller/controllerAccueil.php");
require_once("./controller/controllerGestionnaire.php");
require_once("./controller/controllerAlerte.php");


class controllerGens extends controllerObjet
{
    protected static string $classe;
    protected static string $identifiant;
    protected static array $champs;

    public static function displayConnectionForm()
    {
        $title = "Connexion";
        include("./view/debut.php");
        include("./view/menu.php");
        include("./view/formulaireConnexion.html");
        include("./view/fin.html");
    }

    public static function displayChoix()
    {
        $title = "Choix du compte";
        $choix = 1;
        include("./view/debut.php");
        include("./view/menu.php");
        include("./view/choix.php");
        include("./view/fin.html");
    }

    public static function connect()
    {   
        if (isset($_GET["login"])) {
            $id = $_GET["login"];
        } else if (isset($_GET["login_client"])) {
            $id = $_GET["login_client"];
        } else if (isset($_GET["login_gestionnaire"])) {
            $id = $_GET["login_gestionnaire"];
        }
        if (isset($_GET["mdp"])) {
            $mdp = $_GET["mdp"];
        } else if (isset($_GET["mdp_client"])) {
            $mdp = $_GET["mdp_client"];
        } else if (isset($_GET["mdp_gestionnaire"])) {
            $mdp = $_GET["mdp_gestionnaire"];
        }
        $client = false;
        $gest = false;
        if (!isset($_GET["clientOK"]) && !isset($_GET["gestOK"])) {
            if (Client::checkMDP($id, $mdp)) {
                $client = true;
            }
            if (Gestionnaire::checkMDP($id, $mdp)) {
                $gest = true;
            }
            if ($gest && $client) {
                self::displayChoix();
            } else {
                if ($client) {
                    $_SESSION[Client::getIdentifiant()] = $id;
                    if (isset($_SESSION["Id_Commande"])){
                        unset($_SESSION["Id_Commande"]);
                    }
                    $elt = Client::getOne($id);
                    if ($elt::getClasso() == "Client") {
                        if ($elt->isAdmin()) {
                            $_SESSION["isAdmin"] = 1;
                            controllerGestionnaire::displayAllDispo();
                        } else {
                            controllerAccueil::displayAllDispo();
                        }
                    }
                } else if ($gest) {
                    $_SESSION[Gestionnaire::getIdentifiant()] = $id;
                    if (isset($_SESSION["Id_Commande"])){
                        unset($_SESSION["Id_Commande"]);
                    }
                    controllerAlerte::displayAlerte();
                } else {
                    self::displayConnectionForm();
                }
            }
        } else {
            if (isset($_GET["clientOK"])) {
                $_SESSION[Client::getIdentifiant()] = $id;
                if (isset($_SESSION["Id_Commande"])){
                    unset($_SESSION["Id_Commande"]);
                }
                $elt = Client::getOne($id);
                if ($elt::getClasso() == "Client") {
                    if ($elt->isAdmin()) {
                        $_SESSION["isAdmin"] = 1;
                        controllerGestionnaire::displayAllDispo();
                    } else {
                        controllerAccueil::displayAllDispo();
                    }
                }
            } else if (isset($_GET["gestOK"])) {
                $_SESSION[Gestionnaire::getIdentifiant()] = $id;
                if (isset($_SESSION["Id_Commande"])){
                    unset($_SESSION["Id_Commande"]);
                }
                controllerAlerte::displayAlerte();
            } else {
                self::displayConnectionForm();
            }
        }
    }


    public static function disconnect()
    {
        session_unset();
        session_destroy();
        setcookie(session_name(), '', time() - 1);
        controllerAccueil::displayAllDispo();
    }



}

?>