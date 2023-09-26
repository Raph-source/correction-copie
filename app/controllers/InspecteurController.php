<?php
//importation de phpmailer
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require_once('I_ActeurController.php');
require_once(MODEL.'Inspecteur.php');
class InspecteurController implements I_ActeurController{
    private $model;
    public function __construct(){
        $this->model = new Inspecteur();
    }
    public function authentification():void{
        if(!empty($_POST['nom']) && !empty($_POST['pwd'])){
            $nom = htmlspecialchars($_POST['nom']);
            $pwd = htmlspecialchars($_POST['pwd']);

            $this->model->setAttribut($nom, $pwd);
            
            if($this->model->checkAuthentification()){
                require_once(VIEW.'inspecteur/home.php');
            }
            else{
                $formulaire = "inspecteur";
                $notif = "le pseudo ou le mot de passe est incorrect";
                require_once(VIEW.'authentification.php');
            }
        }
        else{
            $formulaire = "inspecteur";
            $notif = "pas des champs vide svp !!!";
            require_once(VIEW.'authentification.php');
        }
    }

    public function getFormNotifier(){
        require_once(VIEW.'inspecteur/planifierTest.php');
    }

    public function planifierTest(){
        if(!empty($_POST['email']) && !empty($_POST['date'])){
            $email = $_POST['email'];
            $date = $_POST['date'];

            $this->model->ecole->setMail($email);
            //verification de l'existance du de l'adresse mail
            if($this->model->ecole->checkEmail()){
                $nomEcole = $this->model->ecole->getNom();
                //l'envoi du mail
                if(InspecteurController::notifier($email, $nomEcole, $date)){
                    $notif = "notification envoyée avec succès à l'école ".$nomEcole."<br>";
                }
                else{
                    $notif = "échec verifier votre connexion internet";
                }
                require_once(VIEW.'inspecteur/planifierTest.php');
            }
            else{
                $notif = "adresse email non reconnue";
                require_once(VIEW.'inspecteur/planifierTest.php');
            }
        }
        else{
            $notif = "pas des champs vide svp !!!";
            require_once(VIEW.'inspecteur/planifierTest.php');
        }
    }
    //récuperation de du formulaire de chargement de la copie
    public function getFormChargerCopie(){
        require_once(VIEW.'inspecteur/chargerCopie.php');
    }

    //cette méthode permet d'envoyer un mail à une école
    private function notifier($email, $nomEcole, $date):bool{

        $sujet = "notification de l'inspecteur";
        $message = "<p>cher administrateur de l'école <strong> ".$nomEcole." </strong>, <br>
                    nous tenons à vous informer que l'inspecteur passera à votre école le ".$date."<br>Merci";
        //importation de PHPMailer
        require BIBLIOTHEQUE.'PHPmailer/src/Exception.php';
        require BIBLIOTHEQUE.'PHPmailer/src/PHPMailer.php';
        require BIBLIOTHEQUE.'PHPMailer/src/SMTP.php'
;
        $mail = new PHPMailer(true);

        try {
            
            //$mail->SMTPDebug = SMTP::DEBUG_SERVER;                      
            $mail->isSMTP();                                           
            $mail->Host       = 'smtp.gmail.com';                     
            $mail->SMTPAuth   = true;                                  
            $mail->Username   = 'raphilunga00@gmail.com';             
            $mail->Password   = 'ftznsrdvogjtkgxp';                  
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;         
            $mail->Port       = 465; 
            //recuperation de l'adresse mail de l'admin
            $mail->setFrom('raphilunga00@gmail.com', 'raph');
            $mail->addAddress($email, '');      
            
            $mail->isHTML(true);                                  
            $mail->Subject = $sujet;
            $mail->Body    = $message;

            $mail->send();
            return true;
            //return true;
        } catch (Exception $e) {
             return false;
        }
    }

    public function voirEvaluation(){
        $trouver = $this->model->getAllEvaluation();

        require_once(VIEW.'inspecteur/voirEvaluation.php');
    }
    
    public function getFormChargerModel(){
        require_once VIEW.'inspecteur/chargerModel.php';
    }
    
    public function chargerModel(){
        //verifier les données
        if(!empty($_FILES['modele'])){
            if($_FILES['modele']['size'] <= 8000000){
                if($_FILES['modele']['error'] == 0){
                    //réperation de l'extension de l'image
                    $extension = pathinfo($_FILES['modele']['name'], PATHINFO_EXTENSION);
                    $extensionEligigle = ['jpeg', 'PNG', 'png'];
                    if(in_array($extension, $extensionEligigle)){
                        //uploader l'image
                        $modele = $_FILES['modele']['tmp_name'];
                        //générer le texte
                        $cheminDuTexte = STORAGE.'/modele/modele';
                        shell_exec("tesseract $modele $cheminDuTexte");
                        
                        $tableau= file($cheminDuTexte.'.txt');
                        var_dump($tableau) ; exit;

                        $notif = "le modele à été sauvegardé avec succès";
                        require_once(VIEW.'inspecteur/chargerModel.php');
                    }
                    else{
                        $notif = "la photo dois être au format <strong>png</strong>";
                        require_once(VIEW.'inspecteur/chargerModel.php');
                    }
                }
                else{
                    $notif = "la photo contient des erreurs";
                    require_once(VIEW.'inspecteur/chargerModel.php');
                }
            }
            else{
                $notif = "la taille est trop grande";
                require_once(VIEW.'inspecteur/chargerModel.php');
            }
        }
        else{
            $notif = "veuillez choisi une copie";
            require_once(VIEW.'inspecteur/chargerModel.php');
        }
    }
}