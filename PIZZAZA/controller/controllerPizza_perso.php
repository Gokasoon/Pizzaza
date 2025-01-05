<?php
require_once("./model/Pizza_perso.php");
require_once("./controller/controllerObjet.php");


class controllerPizza_perso extends controllerObjet{
    protected static string $classe = "Pizza_perso";
    protected static string $identifiant = "Id_pizza_perso";
}

?>