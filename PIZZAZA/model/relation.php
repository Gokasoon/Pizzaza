<?php

class relation{

    protected static string $classe;
    protected static string $identifiant;

    // getter et setter generique
    public function get($attribut) {return $this->$attribut;}
    public function set($attribut, $valeur) : void {$this->$attribut = $valeur;}


    public static function getAll(){
        $classeRecup = static::$classe;
        $identifiant = static::$identifiant;
        $query = "SELECT * FROM $classeRecup ORDER BY $identifiant;";
        $res = connexion::pdo()->query($query);
        $res->setFetchmode(PDO::FETCH_CLASS, $classeRecup);
        $tab = $res->fetchAll();
        return $tab;
      }

}

?>