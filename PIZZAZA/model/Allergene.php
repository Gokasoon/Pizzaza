<?php
require_once("objet.php");
class Allergene extends objet{

    // attributs
    protected static string $identifiant = "Id_Allergene";
    protected int $Id_Allergene;
    protected string $nom_allergene;
    protected static string $classe = "Allergene";


    // constructeur
    public function __construct(int $Id_Allergene = NULL, string $nom_allergene = NULL){
      if (!is_null($Id_Allergene)){
        $this->Id_Allergene = $Id_Allergene;
        $this->nom_allergene = $nom_allergene;
      }
    }

    // toString
    public function __toString(){
      return "Allergene $this->Id_Allergene $this->nom_allergene";
    }

}

?>