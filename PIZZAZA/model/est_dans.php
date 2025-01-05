<?php
require_once("objet.php");
class est_dans extends objet
{

  // attributs
  protected static string $identifiant = "Id_Commande";
  protected int $Id_estDans;
  protected int $Id_Commande;
  protected int $Id_Pizza;
  protected ?bool $pret;
  protected static string $classe = "est_dans";



  // constructeur
  public function __construct(int $Id_estDans = NULL, int $Id_Commande = NULL, int $Id_Pizza = NULL, bool $pret = NULL)
  {
    if (!is_null($Id_estDans)) {
      $this->Id_estDans = $Id_estDans;
      $this->Id_Commande = $Id_Commande;
      $this->Id_Pizza = $Id_Pizza;
      $this->pret = $pret;
    }
  }

  // toString
  public function __toString()
  {
    $pizza = Pizza::getOne($this->Id_Pizza);
    $pizzaName = $pizza->get("nom_pizza");

    return "Commande $this->Id_Commande contient $pizzaName pret : $this->pret";
  }

  public static function create($tab)
  {
    $sql = "INSERT INTO est_dans (Id_Commande, Id_Pizza) VALUES (" . $tab[0] . ", " . $tab[1] . ")";
    try {
      connexion::pdo()->query($sql);
    } catch (PDOException $e) {
      echo $e->getMessage();
    }
  }

  public static function delete($tab)
    {
      $sql = "DELETE FROM est_dans WHERE Id_estDans = " . $tab[0];
      try {
        connexion::pdo()->query($sql);
      } catch (PDOException $e) {
        echo $e->getMessage();
      }
    }

  

}

?>