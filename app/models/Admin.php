<?php
require_once(MODEL.'I_Acteur.php');
require_once(MODEL.'Ecole.php');
require_once(MODEL.'Classe.php');
class Admin implements I_Acteur{
    private $bdd;
    private $pseudo;
    private $pwd;
    public $ecole;
    public $classe;
    
    public function __construct(){
        $this->bdd = new PDO("mysql:host=localhost;dbname=tfc", "root", "");
        $this->ecole = new Ecole();
        $this->classe = new Classe();
    }

    public function setAttribut($pseudo, $pwd):void{
        $this->pseudo = $pseudo;
        $this->pwd = $pwd;
    }

    //cette méthode vérifie l'authentification
    public function checkAuthentification():bool{
        $requette = $this->bdd->prepare("SELECT * FROM admin WHERE pseudo = ? AND password = ?");
        $requette->execute([$this->pseudo, $this->pwd]);

        $trouver = $requette->fetchAll();

        if(count($trouver) != 0)
            return true;
        return false;
    }
}