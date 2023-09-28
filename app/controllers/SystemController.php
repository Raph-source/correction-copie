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

                        $cheminTexte = STORAGE.'sortie';
                        //générer le texte
                        shell_exec("tesseract $image $cheminTexte");

                        //récuperation du texte de la copie et du modele
                        $tableauReponseCopie= file($cheminTexte.'.txt');
                        $tableauReponseModel = file(STORAGE.'modele/modele.txt');
                        
                        //récuperation du code de l'élève
                        $codeEleve = str_replace('CODE ', '', $tableauReponseCopie[7]);
                        $codeEleve = intval($codeEleve);
                        $codeEleve = strval($codeEleve);

                        //CORRECTION DE LA COPIE
                        //niveau question
                        $coteDifficile = 0;
                        $coteMoyenne = 0;
                        $coteFacile = 0;

                        $pointObetenue = 0;
                        for($i = 24; $i <= 26; $i++){
                            for($j = 8; $j <= 10  ; $j++){
                                if($tableauReponseCopie[$i][0] == $tableauReponseModel[$j][0]){
                                    
                                    $reponseCopie = strtoupper($tableauReponseCopie[$i][2]);
                                    $reponseModel = strtoupper($tableauReponseModel[$j][2]);

                                    if($reponseCopie == $reponseModel){
                                        //teste du niveau de la question
                                        if(intval($tableauReponseModel[$j][4]) === 5){
                                            $coteDifficile += intval($tableauReponseModel[$j][4]);
                                        }
                                        else if(intval($tableauReponseModel[$j][4]) === 3){
                                            $coteMoyenne += intval($tableauReponseModel[$j][4]);
                                        }
                                        else{
                                            $coteFacile += intval($tableauReponseModel[$j][4]);
                                        }
                                    }
                                }
                            }
                        }
                       //insertion dans la bdd
                       $this->model->cotation->setAttribut($codeEleve, $coteMoyenne, $coteFacile, $coteDifficile);
                       //tester si la copie est conforme
                       if($this->model->cotation->save()){
                            $notif = "Correction réussi";
                            require_once(VIEW.'inspecteur/chargerCopie.php');
                       }
                       else{
                            $notif = "Erreur lors de la correction. Rassuerez-vous que la copie soit conforme";
                            require_once(VIEW.'inspecteur/chargerCopie.php');
                       }                    
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