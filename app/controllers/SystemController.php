<?php
require_once(MODEL.'Systeme.php');
class SystemController{
    private $model;

    public function __construct(){
        $this->model = new Systeme();
    }

    public function authentification(){
        if(!empty($_POST['pseudo']) && !empty($_POST['pwd'])){
            $pseudo = $_POST['pseudo'];
            $pwd = $_POST['pwd'];

            if($this->model->checkEnseignant($pseudo, $pwd)){
                session_start();
                $_SESSION['pseudo'] = $pseudo;
                $_SESSION['pwd'] = $pwd;

                $this->model->enseignant->setAttribut($pseudo, $pwd);
                $trouver = $this->model->enseignant->getResultat();

                require_once(VIEW.'enseignant/home.php');
            }
            else if($this->model->checkInspecteur($pseudo, $pwd)){
                require_once(VIEW.'inspecteur/home.php');
            }
            else{
                $notif = 'peudo ou mot de passe incorrect !!!';
                require_once(VIEW.'index.php');
            }

        }
        else{
            $notif = 'pas des champs vides svp !!!';
            require_once(VIEW.'index.php');
        }
    }
    public function scannerCopie(){
        //verifier les données
        if(!empty($_FILES['copie'])){
            if($_FILES['copie']['size'] <= 8000000){
                if($_FILES['copie']['error'] == 0){
                    //réperation de l'extension de l'image
                    $extension = pathinfo($_FILES['copie']['name'], PATHINFO_EXTENSION);
                    $extensionEligigle = ['jpeg', 'PNG', 'png'];
                    if(in_array($extension, $extensionEligigle)){
                        //charger l'image
                        $image = $_FILES['copie']['tmp_name'];
                        //Sauvegarde l'image
                        $cheminTexte = STORAGE.'sortie';
                        //générer le texte
                        shell_exec("tesseract $image $cheminTexte");
                        
                        $tableau= file($cheminTexte.'.txt');
                        var_dump($tableau) ; exit;
                    }
                    else{
                        $notif = "la photo dois être au format <strong>png</strong>";
                        require_once(VIEW.'inspecteur/chargerCopie.php');
                    }
                }
                else{
                    $notif = "la photo contient des erreurs";
                    require_once(VIEW.'inspecteur/chargerCopie.php');
                }
            }
            else{
                $notif = "la taille est trop grande";
                require_once(VIEW.'inspecteur/chargerCopie.php');
            }
        }
        else{
            $notif = "veuillez choisi une copie";
            require_once(VIEW.'inspecteur/chargerCopie.php');
        }  
    }
    public function getAcceuil(){
        require_once(ROOT.'app/views/index.php');
    }

}