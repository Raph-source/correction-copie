<?php
class Cotation{
    private $codeEleve;
    private $coteMoyenne;
    private $coteFacile;
    private $coteDifficile;
    private $total;
    private $bdd;

    public function __construct(){
        $this->bdd = new PDO("mysql:host=localhost;dbname=tfc", "root", "");
    }
    public function setAttribut($codeEleve, $coteMoyenne, $coteFacile, $coteDifficile){
        $this->codeEleve = $codeEleve;
        $this->coteMoyenne = $coteMoyenne;
        $this->coteFacile = $coteFacile;
        $this->coteDifficile = $coteDifficile;
        $this->total = $coteMoyenne + $coteFacile + $coteDifficile;
    }
    //cette méthode permet d'enregistrer une cotation
    public function save():bool{
        try{
            $requete = $this->bdd->prepare("INSERT INTO cotation(codeEleve, cotFac,	cotMoy, cotDiff, total) 
            VALUES (:codeEleve, :coteFacile, :coteMoyenne, :coteDifficile, :total)");

            $requete->bindParam(':codeEleve', $this->codeEleve);
            $requete->bindParam(':coteFacile', $this->coteFacile);
            $requete->bindParam(':coteMoyenne', $this->coteMoyenne);
            $requete->bindParam(':coteDifficile', $this->coteDifficile);
            $requete->bindParam(':total', $this->total);

            $requete->execute();
            
            return true;
        }
        catch(Exception $e){
            return false;
        }

    }
}