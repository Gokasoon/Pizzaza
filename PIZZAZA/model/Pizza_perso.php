<?php
require_once("objet.php");
class Pizza_perso extends objet{

    // attributs
    protected static string $identifiant = "Id_pizza_perso";
    protected int $Id_pizza_perso;
    protected float $prix_perso;
    protected static string $classe = "Pizza_perso";


    // constructeur
    public function __construct(int $Id_pizza_perso = NULL, float $prix_perso = NULL){
      if (!is_null($Id_pizza_perso)){
        $this->Id_pizza_perso = $Id_pizza_perso;
        $this->prix_perso = $prix_perso;
      }
    }

    // toString
    public function __toString(){
      return "PizzaPerso $this->Id_pizza_perso  $this->prix_perso €";
    }

}

?>