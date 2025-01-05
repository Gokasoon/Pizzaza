<?php
require_once("Produit.php");
class Dessert extends Produit
{

  // attributs
  protected static string $identifiant = "Id_Produit";
  protected int $Id_Produit;
  protected string $nom_produit;
  protected string $type_produit;
  protected float $prix_produit;
  protected ?string $image;
  protected int $quantité;
  protected static string $classe = "Dessert";


  // constructeur
  public function __construct(int $Id_Produit = NULL, string $nom_produit = NULL, string $type_produit = NULL, float $prix_produit = NULL, int $quantité = NULL, string $image = NULL)
  {
    if (!is_null($Id_Produit) && $type_produit == 'Dessert') {
      $this->Id_Produit = $Id_Produit;
      $this->nom_produit = $nom_produit;
      $this->type_produit = $type_produit;
      $this->prix_produit = $prix_produit;
      $this->quantité = $quantité;
      $this->image = $image;
    }
  }

  // toString
  public function __toString()
  {
    return "Produit $this->Id_Produit $this->type_produit $this->nom_produit $this->prix_produit € stock : $this->quantité";
  }

  // getters
  public function getId()
  {
    return $this->Id_Produit;
  }
  public function getNom()
  {
    return $this->nom_produit;
  }
  public function getPrix()
  {
    return $this->prix_produit;
  }
  public function getImg()
  {
    return $this->image;
  }
  public function getQt()
  {
    return $this->quantité;
  }

  public function getAllergenes()
  {
    $query = "SELECT nom_allergene FROM Allergene A 
                INNER JOIN peut_contenirV2 PC ON A.Id_Allergene = PC.Id_Allergene
                INNER JOIN Produit P ON PC.Id_Produit = P.Id_Produit
                WHERE P.Id_Produit = :id_tag;";
    $res = connexion::pdo()->prepare($query);
    $tags = array("id_tag" => $this->Id_Produit);
    try {
      $res->execute($tags);
      $res->setFetchmode(PDO::FETCH_ASSOC);
      $tab = $res->fetchAll();
      return $tab;
    } catch (PDOException $e) {
      echo $e->getMessage();
      return null;
    }
  }


  public static function create($tab)
  {
    $query = "INSERT INTO Produit (nom_produit, type_produit, prix_produit, quantité, image) VALUES ('" . $tab["nom_produit"] . "', 'Dessert' ," . $tab["prix_produit"] . ", " . $tab["quantité"] . ", './img/dessert.png')";
    echo $query;

    try {
      $res = connexion::pdo()->query($query);
    } catch (PDOException $e) {
      echo $e->getMessage();
    }
  }

}

?>