<?php
require_once(MODEL.'I_Acteur.php');
class Enseignant implements I_Acteur{
    private $id;
    private $nom;
    private $postNom;
    private $prenom;
    private $bdd;
    private $pwd;

    public function __construct(){
        $this->bdd = new PDO("mysql:host=localhost;dbname=tfc", "root", "");
    }

    public function setAttribut($prenom, $pwd):void{
        $this->prenom = $prenom;
        $this->pwd = $pwd;
    }

    //cette méthode vérifie l'authentification
    public function checkAuthentification():bool{
        $requette = $this->bdd->prepare("SELECT * FROM enseignant WHERE prenom = ? AND pwd = ?");
        $requette->execute([$this->prenom, $this->pwd]);

        $trouver = $requette->fetchAll();
        
        if(count($trouver) != 0)
            return true;
        return false;
    }
    public function getResultat():array{
        
    }
}