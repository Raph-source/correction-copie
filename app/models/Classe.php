<?php
class Classe{
    private $bdd;
    public function __construct(){
        $this->bdd = new PDO("mysql:host=localhost;dbname=tfc", "root", "");
    }

    public function save($tabeauClasse, $idEcole):bool{
        try{
            foreach($tabeauClasse as $classe){
                $requete = $this->bdd->prepare("INSERT INTO classe(nom, idEcole) 
                                                VALUES (:nom, :idEcole)");
                $requete->bindParam(':nom', $classe);
                $requete->bindParam(':idEcole', $idEcole);
                $requete->execute();
            }
            
            return true;
        }
        catch(Exception $e){
            return false;
        }
    }
    public function getId($code):int{
        $requette = $this->bdd->prepare("SELECT id FROM ecole WHERE code = :code");
        $requette->bindParam(':code',$code);
        $requette->execute();

        $trouver = $requette->fetch();

        return $trouver['id'];
    }
}