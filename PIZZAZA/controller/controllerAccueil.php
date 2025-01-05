<?php
require_once("./model/Pizza.php");
require_once("./model/Boisson.php");
require_once("./model/Dessert.php");


class controllerAccueil {
    

    public static function displayAllDispo() {

        $title = "Pizzaza - Accueil";
        include("./view/debut.php");
        include("./view/menu.php");
        
        echo "<h2>Nos pizzas du moment :</h2>";
        $resultPizza = Pizza::getRandom(3); 
        $tab = $resultPizza['tab'];
        $identifiant = $resultPizza['identifiant'];
        $classe = "Pizza";
        include("./view/grid.php");
        
        echo "<h2>Nos boissons du moment :</h2>";
        $resultBoisson = Boisson::getRandom(3); 
        $tab = $resultBoisson['tab'];
        $identifiant = $resultBoisson['identifiant'];
        $classe = "Boisson";
        include("./view/grid.php");
        
        echo "<h2>Nos desserts du moment :</h2>";
        $resultDessert = Dessert::getRandom(3); 
        $tab= $resultDessert['tab'];
        $identifiant = $resultDessert['identifiant'];
        $classe = "Dessert";
        include("./view/grid.php");
    
        include("./view/fin.html");
    }
    

}

?>