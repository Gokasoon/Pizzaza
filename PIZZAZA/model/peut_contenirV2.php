<?php
require_once("relation.php");
class peut_contenirV2 extends relation{

    // attributs
    protected static string $identifiant = "Id_Produit";
    protected int $Id_Allergene;
    protected int $Id_Produit;
    protected static string $classe = "peut_contenirV2";

    
    
    // constructeur
    public function __construct(int $Id_Allergene = NULL, int $Id_Produit = NULL){
      if (!is_null($Id_Allergene)){
        $this->Id_Allergene = $Id_Allergene;
        $this->Id_Produit = $Id_Produit;
      }
    }

    // toString
    public function __toString(){
      
      $allergene = Allergene::getOne($this->Id_Allergene);
      $prod = Produit::getOne($this->Id_Produit);
  
      $allergeneName= $allergene->get("nom_allergene");
      $prodName = $prod->get("nom_produit");
  
      return "$prodName peut contenir des traces de $allergeneName";
    }

}

?>