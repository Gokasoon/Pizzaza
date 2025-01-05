<?php
require_once("./model/session.php");
require_once("./model/Alerte.php");
require_once("./model/Client.php");
require_once("./model/Gestionnaire.php");
require_once("./model/Ingredient.php");
require_once("./model/Produit.php");
require_once("./model/Commande.php");
require_once("./model/est_dans.php");
require_once("./model/autre_produit.php");
require_once("./controller/controllerClient.php");
require_once("./controller/controllerAlerte.php");
require_once("./controller/controllerPizza.php");
require_once("./controller/controllerCommande.php");
class controllerObjet {

    protected static string $classe;
    protected static string $identifiant;
    protected static array $champs;

    public static function displayAll() {
        $classeRecup = static::$classe;
        $identifiant = static::$identifiant;
        $title = "Pizzaza - ".$classeRecup;
        $tab = $classeRecup::getAll();
        include("./view/debut.php");
        include("./view/menu.php");
        include("./view/grid.php");
        include("./view/fin.html");
    }

    public static function displayAllDispo() {
        $classeRecup = static::$classe;
        $identifiant = static::$identifiant;
        $title = "Pizzaza - ".$classeRecup;
        $tab = $classeRecup::getAllDispo();
        include("./view/debut.php");
        include("./view/menu.php");
        include("./view/grid.php");
        include("./view/fin.html");
    }

    public static function displayOne(){
        $classeRecup = static::$classe;
        if ($classeRecup == "Boisson" || $classeRecup == "Dessert"){
            $classeRecup = "Produit";
        }
        $identifiant = static::$identifiant;
        if (isset($_GET[$identifiant])) {
            $lui = $_GET[$identifiant];
            $res = $classeRecup::getOne($lui);
            $title = "Pizzaza - ".$res->getNom();
            if ($classeRecup == "Pizza") {
                $ingredients = $res->getIngredients();
            }
            $allergenes = $res->getAllergenes();

            include("./view/debut.php");
            include("./view/menu.php");
            include("./view/details.php");
            include("./view/fin.html");
            
        } else {
            echo "pas d'identifiant écrit";
        }        
    }

    public static function displayUpdateForm(){
        $champs = static::$champs;
        $classe = static::$classe;
        $identifiant = static::$identifiant;
        $title = "modification ".$classe;
        if (isset($_GET[$identifiant])) {
            $lui = $_GET[$identifiant];
            
            include("./view/debut.php");
            include("./view/menu.php");
            $res = $classe::getOne($lui);
            include("./view/formulaireModification.php");
            include("./view/fin.html");
           
        } else {
            echo "pas d'identifiant écrit";
        }
    }

    public static function displayAlerte(){ 
        $classeRecup = static::$classe;
        $title = "Pizzaza - Alerte";
        $identifiant = static::$identifiant;
        $champs = ControllerAlerte::$champsIngr;
        include("./view/debut.php");
        include("./view/menu.php");
        $tab = Alerte::getAlerteIngr();
        $lienModifOk = false;
        $lienSupprOk = false;
        $lienAjoutOk = false;
        include("./view/list.php");
        $champs = ControllerAlerte::$champsProd;
        $tab = Alerte::getAlerteProd();
        include("./view/list.php");
        echo "<div><button id='B'><a href='index.php?objet=Alerte&action=displayAll'>Voir toutes les alertes</a></button></div>";
        include("./view/fin.html");
    }


    public static function update(){
        $champs = static::$champs;
        $donnees = array();

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
        $controller = "controller".ucfirst($classe);
        if ($classe == "Client" || $classe == "Gestionnaire") {
            $controller::displayUpdateForm(); 
        } else if (!isset($_SESSION['login_gestionnaire'])){
            $controller::displayAllDispo();
        } else {
            $controller::displayAll();
        }
    }

    public static function create(){
        $champs = static::$champs;
        $classe = static::$classe;
        $donnees = array();
        foreach($_GET as $cle => $valeur){
            if($cle != "objet" && $cle != "action"){
                if($cle == 'quantite'){
                    $donnees['quantité'] = $valeur;
                } else {
                    $donnees[$cle] = $valeur;
                }
            }
        }
        if ($classe == "Alerte"){
            if (!isset($donnees['Id_Ingredient'])) {
                $donnees['Id_Ingredient'] = null;
            }
            if (!isset($donnees['Id_Produit'])) {
                $donnees['Id_Produit'] = null;
            }
        }   
        $classe::create($donnees);
        $controller = "controller".ucfirst($classe);
        if (isset($_SESSION['login_gestionnaire']) && $_GET['action'] == "create" && isset($_GET["Id_Pizza"])){
            controllerPizza::displayUpdateForm();
        } else {
            $controller::displayAllDispo();
        }
    }

    public static function delete() {
        $classeRecup = static::$classe;
        $identifiant = static::$identifiant;
        if (isset($_GET[$identifiant])) {
            $lui = $_GET[$identifiant];
            $classeRecup::delete($lui);
            $controller = "controller".ucfirst($classeRecup);
            if ($classeRecup == "est_dans" || $classeRecup == "autre_produit"){
                controllerCommande::displayUpdateForm();
            } else {
                $controller::displayAllDispo();                    
            }
        } else {
            echo "pas d'identifiant écrit";
        }
    }

    public static function displayCreationForm(){
        $champs = static::$champs;
        $classe = static::$classe;
        $identifiant = static::$identifiant;
        $title = "création ".$classe;
        include("./view/debut.php");
        include("./view/menu.php");
        include("./view/formulaireCreation.php");
        include("./view/fin.html");        
    }

    public static function addToCart(){
        $classeRecup = static::$classe;
        if (isset($_SESSION["Id_Commande"])){
            // TODO create est_dans si pizza sinon si produit create autre_produit
            if ($classeRecup == "Pizza"){
                est_dans::create(array($_SESSION["Id_Commande"], $_GET["Id_Pizza"]));
            } else {
                autre_produit::create(array($_SESSION["Id_Commande"], $_GET["Id_Produit"]));
            }
            controllerCommande::displayUpdateForm();


        } else {
            $_SESSION["Id_Commande"] = Commande::create(array());
            // TODO create est_dans si pizza sinon si produit create autre_produit
            if ($classeRecup == "Pizza"){
                est_dans::create(array($_SESSION["Id_Commande"], $_GET["Id_Pizza"]));
            } else {
                autre_produit::create(array($_SESSION["Id_Commande"], $_GET["Id_Produit"]));
            }
            controllerCommande::displayUpdateForm();



        }
    }

    


}

?>