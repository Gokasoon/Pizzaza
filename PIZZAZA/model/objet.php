<?php

class objet
{

  protected static string $classe;
  protected static string $identifiant;
  protected static array $tableauSelect;

  // getter
  public function get($attribut)
  {
    return $this->$attribut;
  }
  public function set($attribut, $valeur): void
  {
    $this->$attribut = $valeur;
  }
  public function getClasse()
  {
    return static::$classe;
  }



  public static function getAll()
  {
    $classeRecup = static::$classe;
    if ($classeRecup == "Boisson" || $classeRecup == "Dessert") {
      $classe = "Produit";
      $query = "SELECT * FROM $classe WHERE type_produit = '" . $classeRecup . "';";
    } else {
      $query = "SELECT * FROM $classeRecup;";
    }
    $res = connexion::pdo()->query($query);
    $res->setFetchmode(PDO::FETCH_CLASS, $classeRecup);
    $tab = $res->fetchAll();
    foreach ($tab as $key => $obj) {
      foreach ($obj as $property => $value) {
        if ($value === null) {
          $tab[$key]->$property = 0;
        }
      }
    }
    return $tab;
  }

  public static function getAllDispo()
  {
    $classeRecup = static::$classe;

    $query = "SELECT * FROM " . $classeRecup . "Dispo ;";

    $res = connexion::pdo()->query($query);
    $res->setFetchmode(PDO::FETCH_CLASS, $classeRecup);
    $tab = $res->fetchAll();
    return $tab;
  }

  public static function getOne($id)
  {
    // on recup le nom de la table
    $classeRecup = static::$classe;
    if ($classeRecup == "Boisson" || $classeRecup == "Dessert") {
      $classeRecup = "Produit";
    }
    // on recupere l'identifiant de la table
    $identifiant = static::$identifiant;
    // on construit la requete avec un tag 
    // qui remplace la valeur de l'identifiant
    $query = "SELECT * FROM $classeRecup WHERE $identifiant = :id_tag;";
    // on lance la methode prepare dessus
    $res = connexion::pdo()->prepare($query);
    // on cree le tableau contenant le tag et sa valeur
    $tags = array("id_tag" => $id);

    try {
      // on execute la requete prep
      $res->execute($tags);
      // on recupere le resultat selon la classe recup
      $res->setFetchmode(PDO::FETCH_CLASS, $classeRecup);
      // on recup l'elt (le seul du tableau)
      $elt = $res->fetch();
      return $elt;

    } catch (PDOException $e) {
      echo $e->getMessage();
      return null;
    }
  }

  public static function getAlli($id)
  {
    $classeRecup = static::$classe;
    $identifiant = static::$identifiant;
    if ($classeRecup == "Boisson" || $classeRecup == "Dessert") {
      $classe = "Produit";
      $query = "SELECT * FROM $classe WHERE type_produit = '" . $classeRecup . "' AND $identifiant = :id_tag;";
    } else {
      $query = "SELECT * FROM $classeRecup WHERE $identifiant = :id_tag;";
    }

    $res = connexion::pdo()->prepare($query);
    // on cree le tableau contenant le tag et sa valeur
    $tags = array("id_tag" => $id);
    $res->execute($tags);
    $res->setFetchmode(PDO::FETCH_CLASS, $classeRecup);
    $tab = $res->fetchAll();
    foreach ($tab as $key => $obj) {
      foreach ($obj as $property => $value) {
        if ($value === null) {
          $tab[$key]->$property = 0;
        }
      }
    }
    return $tab;
  }

  public static function getRandom($count)
  {
    $classeRecup = static::$classe;
    $identifiant = static::$identifiant;


    $query = "SELECT * FROM " . $classeRecup . "Dispo ORDER BY RAND() LIMIT $count;";


    $res = connexion::pdo()->query($query);

    try {
      $res->execute();
      $res->setFetchmode(PDO::FETCH_CLASS, $classeRecup);
      $tab = $res->fetchAll();

      return array('tab' => $tab, 'identifiant' => $identifiant);
    } catch (PDOException $e) {
      echo $e->getMessage();
      return null;
    }
  }

  public static function update($tab)
  {
    $classeRecup = static::$classe;
    $query = "UPDATE $classeRecup SET ";
    $whereClause = "";

    foreach ($tab as $cle => $valeur) {
      if ($cle == $classeRecup::$identifiant) {
        $whereClause = " WHERE $cle=:$cle";
      } else {
        $columnName = ($cle === 'quantite') ? 'quantité' : $cle;
        $query .= "$columnName=:$cle, ";
      }
    }

    $query = rtrim($query, ', ');
    $query .= $whereClause;

    $res = connexion::pdo()->prepare($query);

    try {
      $res->execute($tab);
    } catch (PDOException $e) {
      echo $e->getMessage();
    }
  }


  public static function getSelect()
  {
    $classe = static::$classe;
    $identifiant = static::$identifiant;
    $tableauSelect = static::$tableauSelect;

    if ($classe == "Gestionnaire") {
      $query = "SELECT $tableauSelect[0], $tableauSelect[1]";
    } else if (count($tableauSelect) == 2) {
      $query = "SELECT $identifiant, $tableauSelect[1]";
    } else {
      $query = "SELECT $identifiant, CONCAT($tableauSelect[1] , ', ', $tableauSelect[2])";
    }
    $query .= " FROM $classe;";

    try {
      $res = connexion::pdo()->prepare($query);
      $res->setFetchmode(PDO::FETCH_NUM);
      $res->execute();
      $tab = $res->fetchAll();
    } catch (PDOException $e) {
      echo $e->getMessage();
    }

    $select = "<select name=\"$tableauSelect[0]\">";
    $select .= "<option selected value='null'></option>";
    foreach ($tab as $row) {

      $select .= "<option value='$row[0]'>$row[1]</option>";
    }
    $select .= "</select>";

    return $select;
  }



  public static function getSelected($lui)
  {
    $classe = static::$classe;
    $identifiant = static::$identifiant;
    $tableauSelect = static::$tableauSelect;
    $luiClasse = $lui::$classe;
    $luiId = $luiClasse::$identifiant;
    $luiIdValue = $lui->getId();

    $q = "SELECT " . $tableauSelect[0] . " FROM $luiClasse WHERE $luiId = '$luiIdValue';";
    try {
      $res2 = connexion::pdo()->query($q);
      $res2->setFetchmode(PDO::FETCH_NUM);
      $res2->execute();
      $v = $res2->fetchAll();
    } catch (PDOException $e) {
      echo $e->getMessage();
    }

    if (isset($v[0][0])) {
      $q2 = "SELECT $identifiant, " . $tableauSelect[1] . " FROM $classe WHERE $identifiant = '" . $v[0][0] . "';";
      try {
        $res2 = connexion::pdo()->query($q2);
        $res2->setFetchmode(PDO::FETCH_NUM);
        $res2->execute();
        $v = $res2->fetchAll();
      } catch (PDOException $e) {
        echo $e->getMessage();
      }
    }

    if (count($tableauSelect) == 2) {
      $query = "SELECT $identifiant, $tableauSelect[1]";
    } else {
      $query = "SELECT $identifiant, CONCAT($tableauSelect[1] , ', ', $tableauSelect[2])";
    }
    $query .= " FROM $classe;";

    try {
      $res = connexion::pdo()->prepare($query);
      $res->setFetchmode(PDO::FETCH_NUM);
      $res->execute();
      $tab = $res->fetchAll();
    } catch (PDOException $e) {
      echo $e->getMessage();
    }

    $select = "<select name=\"$tableauSelect[0]\">";
    if (isset($v[0][0])) {
      $select .= "<option selected value=" . $v[0][0] . "> " . $v[0][1] . "</option>";
    } else {
      $select .= "<option selected value='null'></option>";
    }
    foreach ($tab as $row) {
      if ((isset($v[0][0]) && $row[0] != $v[0][0]) || !isset($v[0][0])) {
        $select .= "<option value='$row[0]'>$row[1]</option>";
      }
    }
    $select .= "</select>";

    return $select;
  }

  public static function delete($id)
  {
    $classeRecup = static::$classe; // table
    $identifiant = static::$identifiant; // id
    $query = "DELETE FROM $classeRecup WHERE $identifiant = :id_tag;";
    $res = connexion::pdo()->prepare($query); // prepare
    try {
      $res->execute(array("id_tag" => $id)); // exec query w id 

    } catch (PDOException $e) {
      echo $e->getMessage();
    }
  }

  // public static function create($tab)
  // {
  //   var_dump($tab);

  //   foreach ($tab as $cle => $valeur) {
  //     if ($valeur === 'null') {
  //       $tab[$cle] = null;
  //     } elseif (is_numeric($valeur)) {
  //       $tab[$cle] = (float) $valeur;
  //     }
  //   }

  //   var_dump($tab);

  //   $classeRecup = static::$classe;
  //   if ($classeRecup == "Boisson" || $classeRecup == "Dessert") {
  //     $classeRecup = "Produit";
  //   }
  //   $columns = implode(", ", array_keys($tab));
  //   $columnPlaceholders = ":" . implode(", :", array_keys($tab));

  //   $query = "INSERT INTO $classeRecup ($columns) VALUES ($columnPlaceholders)";
  //   $res = connexion::pdo()->prepare($query);

  //   try {
  //     foreach ($tab as $key => $value) {
  //       $res->bindValue(":$key", $value);
  //     }

  //     echo "Query after binding: " . $res->queryString . "\n";

  //     $res->execute();
  //     echo "Number of parameters bound: " . count($tab) . "\n"; 

  //   } catch (PDOException $e) {
  //     echo $e->getMessage();
  //   }

  // }

  public static function create($tab){
     foreach ($tab as $cle => $valeur) {
      if ($valeur === 'null') {
        $tab[$cle] = null;
      } elseif (is_numeric($valeur)) {
        $tab[$cle] = (float) $valeur;
      }
    }
        
    $classeRecup = static::$classe;
    if ($classeRecup == "Boisson" || $classeRecup == "Dessert") {
      $classeRecup = "Produit";
    }
    $query = "INSERT INTO $classeRecup (";
    $query2 = " VALUES (";
    foreach($tab as $cle => $valeur){
        $query .= "$cle, ";
        $query2 .= ":$cle, ";
    }
    $query = substr($query, 0, -2);
    $query2 = substr($query2, 0, -2);
    $query .= ")";
    $query2 .= ")";
    $query .= $query2;
    $res = connexion::pdo()->prepare($query);
    try{
        echo "Query after binding: " . $res->queryString . "\n";
        $res->execute($tab);
    } catch (PDOException $e) {
        echo $e->getMessage();
    }
  }




}

?>