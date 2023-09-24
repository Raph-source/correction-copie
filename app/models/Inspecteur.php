<?php
require_once(MODEL.'I_Acteur.php');
class Inspecteur implements I_Acteur{
    private $bdd;
    private $nom;
    private $pwd;
    public $ecole;
    public function __construct(){
        $this->bdd = new PDO("mysql:host=localhost;dbname=tfc", "root", "");
        $this->ecole = new Ecole();
    }

    public function setAttribut($nom, $pwd):void{
        $this->nom = $nom;
        $this->pwd = $pwd;
    }

    //cette méthode vérifie l'authentification
    public function checkAuthentification():bool{
        $requette = $this->bdd->prepare("SELECT * FROM inspecteur WHERE nom = ? AND pwd = ?");
        $requette->execute([$this->nom, $this->pwd]);

        $trouver = $requette->fetchAll();

        if(count($trouver) != 0)
            return true;
        return false;
    }
    //la méthode retourne tout les évaluations
    public function getAllEvaluation():array{
        $requete = $this->bdd->query('SELECT * FROM evaluation AS ev 
        INNER JOIN ecole AS ec ON ev.idEcole = ec.id
        INNER JOIN eleve AS el ON ev.idEleve = el.id');
        
        $trouver = $requete->fetchAll();

        return $trouver;
    }


}