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

    public function save($nom, $code, $province):bool{
        try{
            $requete = $this->bdd->prepare("INSERT INTO ecole(nom, code, province)
            VALUES(:nom, :code, :province)");
            $requete->bindParam(':nom', $nom);
            $requete->bindParam(':code', $code);
            $requete->bindParam(':province', $province);
            $requete->execute();

            return true;
        }catch(Exception $e){
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