<?php
require_once("objet.php");
class autre_produit extends objet{

    // attributs
    protected static string $identifiant = "Id_Commande";
    protected int $Id_Produit;
    protected int $Id_Commande;
    protected int $quantité;
    protected static string $classe = "autre_produit";

    
    // constructeur
    public function __construct(int $Id_Commande = NULL, int $Id_Produit = NULL, int $quantité = NULL){
      if (!is_null($Id_Commande)){
        $this->Id_Commande = $Id_Commande;
        $this->Id_Produit = $Id_Produit;
        $this->quantité = $quantité;
      }
    }

    // toString
    public function __toString(){
      $prod = Produit::getOne($this->Id_Produit);
      $prodName = $prod->get("nom_produit");
  
      return "Commande $this->Id_Commande contient $prodName x $this->quantité";
    }

    public static function create($tab)
{
    $sql = "SELECT * FROM autre_produit WHERE Id_Commande = " . $tab[0] . " AND Id_Produit = " . $tab[1];
    $rep = connexion::pdo()->query($sql);
    $rep->setFetchMode(PDO::FETCH_CLASS, 'autre_produit');
    $tabo = $rep->fetchAll();
    if (count($tabo) > 0) {
        $sql = "UPDATE autre_produit SET quantité = quantité + 1 WHERE Id_Commande = " . $tab[0] . " AND Id_Produit = " . $tab[1];
        try {
            connexion::pdo()->query($sql);
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
        return;
    } else {
        $sql = "INSERT INTO autre_produit (Id_Commande, Id_Produit, quantité) VALUES (" . $tab[0] . ", " . $tab[1] . ", 1)";
        try {
            connexion::pdo()->query($sql);
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }
}

    public static function delete($tab)
    {
      $sql = "DELETE FROM autre_produit WHERE Id_Commande = " . $tab[0] . " AND Id_Produit = " . $tab[1];
      try {
        connexion::pdo()->query($sql);
      } catch (PDOException $e) {
        echo $e->getMessage();
      }
    }

}

?>