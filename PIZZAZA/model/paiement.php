<?php
require_once("objet.php");
class paiement extends objet
{

  // attributs
  protected static string $identifiant = "Id_Commande";
  protected int $Id_Commande;
  protected string $type_paiement;
  protected ?int $numCB;
  protected ?int $cryptogramme;
  protected ?string $date_paiement;
  protected ?string $heure_paiement;
  protected ?float $montant;
  protected ?string $date_peremption;
  protected ?int $Id_Client;

  protected static string $classe = "paiement";

  // constructeur
  public function __construct(int $Id_Commande = NULL, string $type_paiement = NULL, int $numCB = NULL, int $cryptogramme = NULL, string $date_paiement = NULL, string $heure_paiement = NULL, float $montant = NULL, string $date_peremption = NULL, int $Id_Client = NULL)
  {
    if (!is_null($Id_Commande)) {
      $this->Id_Commande = $Id_Commande;
      $this->type_paiement = $type_paiement;
      $this->numCB = $numCB;
      $this->cryptogramme = $cryptogramme;
      $this->date_paiement = $date_paiement;
      $this->heure_paiement = $heure_paiement;
      $this->montant = $montant;
      $this->date_peremption = $date_peremption;
      $this->Id_Client = $Id_Client;
    }
  }

  // toString
  public function __toString()
  {
    return "Paiement $this->Id_Commande $this->type_paiement $this->numCB $this->cryptogramme $this->date_paiement $this->heure_paiement $this->montant $this->date_peremption $this->Id_Client";
  }

  public static function updatePaiement(int $Id_Commande)
  {
    $sql = "CALL updatePaiementMontant($Id_Commande)";
    connexion::pdo()->query($sql);
  }

  public function getId()
  {
    return $this->Id_Commande;
  }

  public static function update($tab)
  {
      $query = "UPDATE paiement SET numCB=:numCB, cryptogramme=:cryptogramme, date_peremption=:date_peremption, date_paiement=CURRENT_DATE, heure_paiement=CURRENT_TIME WHERE Id_Commande=:Id_Commande";
      $res = connexion::pdo()->prepare($query);
      try {
        $res->execute($tab);
      } catch (PDOException $e) {
        echo $e->getMessage();
      }
  }

}

?>