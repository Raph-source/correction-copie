<?php
require_once('I_ActeurController.php');
require_once(MODEL.'AdminEcole.php');
require_once(MODEL.'Eleve.php');
class AdminEcoleController implements I_ActeurController{
    private $eleve;
    private $enseignant;
    private $model;

    public function __construct(){
        $this->model = new AdminEcole();
    }

    public function getAuthInspecteur(){
        require_once(VIEW.'admin/authentification.php');
    }

    public function authentification():void{
        if(!empty($_POST['pseudo']) && !empty($_POST['pwd'])){
            $pseudo = htmlspecialchars($_POST['pseudo']);
            $pwd = htmlspecialchars($_POST['pwd']);

            $this->model->setAttribut($pseudo, $pwd);
            
            if($this->model->checkAuthentification()){
                require_once(VIEW.'admin/home.php');
            }
            else{
                $formulaire = "admin";
                $notif = "le pseudo ou le mot de passe est incorrect";
                require_once(VIEW.'admin/authentification.php');
            }
        }
        else{
            $formulaire = "admin";
            $notif = "pas des champs vide svp !!!";
            require_once(VIEW.'admin/authentification.php');
        }
    }
    public function ajouterEnseignant(){
        $this->enseignant = new Enseignant();
    }
    public function ajouterEleve(){
    
    }
}