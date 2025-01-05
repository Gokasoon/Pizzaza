<?php
require_once("relation.php");
class est_dans_v2 extends relation{

    // attributs
    protected static string $identifiant = "Id_Commande";
    protected int $Id_estDans;
    protected int $Id_Commande;
    protected int $Id_pizza_perso;
    protected bool $pret;
    protected static string $classe = "est_dans_v2";

    
    
    // constructeur
    public function __construct(int $Id_estDans = NULL, int $Id_Commande = NULL, int $Id_pizza_perso = NULL, bool $pret = NULL){
       if(!is_null($Id_estDans)){
        $this->Id_estDans = $Id_estDans;
        $this->Id_Commande = $Id_Commande;
        $this->Id_pizza_perso = $Id_pizza_perso;
        $this->pret = $pret;
       }
    }

    // toString
    public function __toString(){
      return "Commande $this->Id_Commande contient $this->Id_pizza_perso pret : $this->pret";
    }

}

?>