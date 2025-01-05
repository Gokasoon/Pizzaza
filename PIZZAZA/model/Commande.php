<?php
require_once("objet.php");
class Commande extends objet{

    // attributs
    protected static string $identifiant = "Id_Commande";
    protected int $Id_Commande;
    protected string $date_commande;
    protected string $etat_commande;
    protected string $methode_paiement;
    protected string $heure_commande;
    protected static string $classe = "Commande";

    // constructeur
    public function __construct(int $Id_Commande = NULL, string $date_commande = NULL, string $etat_commande = NULL, string $methode_paiement = NULL, string $heure_commande = NULL){
      if (!is_null($Id_Commande)){
        $this->Id_Commande = $Id_Commande;
        $this->date_commande = $date_commande;
        $this->etat_commande = $etat_commande;
        $this->methode_paiement = $methode_paiement;
        $this->heure_commande = $heure_commande;
      }
    }

    // toString
    public function __toString(){
      return "Commande $this->Id_Commande $this->date_commande $this->heure_commande $this->etat_commande $this->methode_paiement";
    }

    public static function create($tab){ 
      $sql = "INSERT INTO Commande (date_commande, etat_commande, methode_paiement, heure_commande) VALUES (CURRENT_DATE, 'non payée', 'CB', CURRENT_TIME)";
      try{
        $rep = connexion::pdo()->query($sql);
      } catch (PDOException $e) {
        echo $e->getMessage();
      }
      try {
        $sql = "SELECT Id_Commande FROM Commande WHERE date_commande = CURRENT_DATE AND heure_commande = CURRENT_TIME";
        $rep = connexion::pdo()->query($sql);
        $rep->setFetchMode(PDO::FETCH_CLASS, 'Commande');
        $tab = $rep->fetchAll();
        return $tab[0]->Id_Commande;
      } catch (PDOException $e) {
        echo $e->getMessage();
        return null;
      }
    }

    

    

}

?>