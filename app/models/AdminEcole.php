<?php
require_once(MODEL.'I_Acteur.php');
require_once(MODEL.'Ecole.php');
class AdminEcole implements I_Acteur{
    private $bdd;
    private $pseudo;
    private $pwd;
    
    public function __construct(){
        $this->bdd = new PDO("mysql:host=localhost;dbname=tfc", "root", "");
    }

    public function setAttribut($pseudo, $pwd):void{
        $this->pseudo = $pseudo;
        $this->pwd = $pwd;
    }

    //cette méthode vérifie l'authentification
    public function checkAuthentification():bool{
        $requette = $this->bdd->prepare("SELECT * FROM admin WHERE pseudo = ? AND pwd = ?");
        $requette->execute([$this->pseudo, $this->pwd]);

        $trouver = $requette->fetchAll();

        if(count($trouver) != 0)
            return true;
        return false;
    }
}