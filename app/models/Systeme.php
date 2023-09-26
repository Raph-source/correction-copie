<?php
require_once(MODEL.'Enseignant.php');
class Systeme{
    private $bdd;
    public $enseignant;
    public function __construct(){
        $this->bdd = new PDO("mysql:host=localhost;dbname=tfc", "root", "");
        $this->enseignant = new Enseignant();
    }

    public function checkEnseignant($pseudo, $pwd):bool{
        $requete = $this->bdd->prepare("SELECT * FROM enseignant WHERE prenom = ? AND password = ?");
        $requete->execute([$pseudo, $pwd]);
        $trouver = $requete->fetchAll();

        if(count($trouver) != 0)
            return true;
        return false;

    }

    public function checkInspecteur($pseudo, $pwd):bool{
        $requete = $this->bdd->prepare("SELECT * FROM inspecteur WHERE nom = ? AND password = ?");
        $requete->execute([$pseudo, $pwd]);
        $trouver = $requete->fetchAll();

        if(count($trouver) != 0)
            return true;
        return false;

    }
}