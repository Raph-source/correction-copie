<?php
//inclusion de la bibliothèque PhpSpreadsheet
use PhpOffice\PhpSpreadsheet\Reader\Xls\Style\Border;
require_once BIBLIOTHEQUE.'vendor/autoload.php';
use PhpOffice\PhpSpreadsheet\IOFactory;

require_once('I_ActeurController.php');
require_once(MODEL.'Admin.php');
require_once(MODEL.'Eleve.php');
class AdminController implements I_ActeurController{
    private $eleve;
    private $enseignant;
    private $model;

    public function __construct(){
        $this->model = new Admin();
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

    public function getFormAjoutEcole(){
        require_once VIEW.'admin/ajouterEcole.php';
    }
    public function ajouterEcole(){
        //vérification des champs
        if(isset($_FILES['ecole'])){
            //vérification de la taille du fichier
            if($_FILES['ecole']['size'] <= 8000000){
                //vérifier que le fichier ne soit pas erronné
                if($_FILES['ecole']['error'] === 0){
                    //vérificaion de l'extension
                    $extention = pathinfo($_FILES['ecole']['name'], PATHINFO_EXTENSION);
                    if($extention === 'xlsx'){
                        move_uploaded_file($_FILES['ecole']['tmp_name'], UPLOADS.$_FILES['ecole']['name']);
                        try{
                            $fichierExcel = IOFactory::load(UPLOADS.$_FILES['ecole']['name']);
                            $feuille = $fichierExcel->getActiveSheet();
                        }
                        catch(Exception $e){
                            $notif = "Erreur lors de l'ouverture du fichier excel. Veuilliez recommencer";
                            require_once VIEW.'admin/ajouterEcole.php'; exit;
                        }

                        //RECUPERATION DES DONNEES DU FICHIER EXCEL
                        
                        // -récupération des données de l'école
                        $nomEcole = $feuille->getCellByColumnAndRow(1, 1)->getValue();
                        $codeEcole = $feuille->getCellByColumnAndRow(2, 1)->getValue();
                        $province = $feuille->getCellByColumnAndRow(3, 1)->getValue();

                        // -récupération des classes
                        $tabeauClasse = [];
                        $collone = 4;
                        $i = 0;
                       
                        while($feuille->getCellByColumnAndRow($collone, 1)->getValue() != NULL){
                            $tabeauClasse[$i] = $feuille->getCellByColumnAndRow($collone, 1)->getValue();
                            $i++;
                            $collone++;
                        }
                        // -récuperation des enseignants
                        $tabeauEnseignant = [];
                        $collone = 4;
                        $i = 0;
                        while($feuille->getCellByColumnAndRow($collone, 2)->getValue() !== NULL){
                            $tabeauEnseignant[$i] = $feuille->getCellByColumnAndRow($collone, 2)->getValue();
                            $i++;
                       
                            $collone++;
                        }
                        
                        // -récuperation des éleves
                        $nombreClasse = $collone - 4;
                        $tableauEleve = [];
                        
                        $collone = 4;//collone de début
                        $j = 0;
                        while($nombreClasse != 0){
                            $ligne = 3;
                            $eleves = [];
                            $i = 0;

                            while($feuille->getCellByColumnAndRow($collone, $ligne)->getValue() !== NULL){
                                $eleves[$i] = $feuille->getCellByColumnAndRow($collone, $ligne)->getValue();
                                $ligne++;
                                $i++;
                            }
                            
                            $tableauEleve[$j] = $eleves;//tout les éleve d'une classe
                            
                            $collone++;//changer la colonne
                            $j++;

                            $nombreClasse--;
                        }

                        var_dump($tableauEleve); exit;
                        //INSERTION DANS LA BDD
                        //     -insertion de l'école
                        if($this->model->ecole->save($nomEcole, $codeEcole, $province)){
                            $idEcole = $this->model->ecole->getId($codeEcole);
                            // -insertion des classes
                            if($this->model->classe->save($tabeauClasse, $idEcole)){
                                $notif = "Ecole ajouter avec succès";
                                require_once VIEW.'admin/ajouterEcole.php';
                            }
                            else{
                                $notif = "Erreur lors de l'insertion des classes. Veuillez recommencer";
                                require_once VIEW.'admin/ajouterEcole.php';
                            }

                            
                        }
                        else{
                            $notif = "Erreur lors de l'insertion de l'école. Veuillez recommencer";
                            require_once VIEW.'admin/ajouterEcole.php';
                        }
                    }
                    else{
                        $notif = "selection qu'un fichier au format 'xlsx'";
                        require_once VIEW.'admin/ajouterEcole.php';
                    }
                }
                else{
                    $notif = "le fichier contient des erreurs";
                    require_once VIEW.'admin/ajouterEcole.php';
                }
            }
            else{
                $notif = "la taille du fichier est trop grande";
                require_once VIEW.'admin/ajouterEcole.php';
            }
        }
        else{
            $notif = "pas des champs vide svp!!!";
            require_once VIEW.'admin/ajouterEcole.php';
        }
    }
}