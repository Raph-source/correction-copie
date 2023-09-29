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
        $requette = $this->bdd->prepare("SELECT * FROM enseignant WHERE prenom = ? AND password = ?");
        $requette->execute([$this->prenom, $this->pwd]);

        $trouver = $requette->fetchAll();
        
        if(count($trouver) != 0)
            return true;
        return false;
    }

    private function setId(){
        $requete = $this->bdd->prepare("SELECT id FROM enseignant WHERE prenom = :prenom AND password = :password");
        $requete->bindParam(':prenom', $this->prenom);
        $requete->bindParam(':password', $this->pwd);
        $requete->execute();

        $trouver = $requete->fetch();
        $this->id = $trouver['id'];
    }
    public function getResultat():array{
        Enseignant::setId();
        $requete = $this->bdd->prepare("SELECT el.nom nomEleve, el.postNom postNomEleve, el.prenom prenomEleve, 
                    ct.cotFac coteFacile, ct.cotMoy coteMoyenne, ct.cotDiff coteDifficile
                    FROM cotation AS ct INNER JOIN eleve AS el
                    ON ct.codeEleve = el.code
                    INNER JOIN classe AS cl ON el.idClasse = cl.id
                    INNER JOIN enseignant AS en ON cl.id = en.idClasse
                    WHERE en.id = :idEnseignant");
        $requete->bindParam(':idEnseignant',$this->id);
        $requete->execute();

        $trouver = $requete->fetchAll();

        return $trouver;
    }
}