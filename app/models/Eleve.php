<?php
class Eleve{
    private $nom;
    private $postNom;
    private $prenom;
    private $code;
    private $bdd;

    public function __construct($nom, $postNom, $prenom, $code){
        $this->bdd = new PDO("mysql:host=localhost;dbname=tfc", "root", "");
        $this->nom = $nom;
        $this->postNom = $postNom;
        $this->prenom = $prenom;
        $this->code = $code;
    }
    public function save(){

    }
}