<?php
class Ecole{
    private $bdd;
    private $email;
    public function __construct(){
        $this->bdd = new PDO("mysql:host=localhost;dbname=tfc", "root", "");
    }

    public function setMail($email):void{
        $this->email = $email;
    }
    public function checkEmail():bool{
        $requette = $this->bdd->prepare("SELECT * FROM ecole WHERE email = ?");
        $requette->execute([$this->email]);

        $trouver = $requette->fetchAll();

        if(count($trouver) != 0)
            return true;
        return false;
    }

    public function getNom():string{
        $requette = $this->bdd->prepare("SELECT nom FROM ecole WHERE email = ?");
        $requette->execute([$this->email]);
        
        $trouver = $requette->fetch();

        return $trouver['nom'];
    }
}