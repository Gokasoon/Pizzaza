<?php
require_once("objet.php");
class gens extends objet{

    protected static string $classe;
    protected static string $identifiant;
    protected static string $mdp;


    public static function checkMDP($l, $m) {
        $classe = static::$classe;
        $identifiant = static::$identifiant;
        $mdp = static::$mdp;

        $query = "SELECT * FROM $classe WHERE $identifiant = :login AND $mdp = :mdp ;";
        $res = connexion::pdo()->prepare($query);
        $tags = array(':login' => $l, ':mdp' => $m);
        $res->execute($tags);
        $res->setFetchMode(PDO::FETCH_CLASS, $classe);
        $client = $res->fetch();
        return $client !== false;
    }

}

?>