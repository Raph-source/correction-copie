<?php
    class Routeur{
        private $request;//l'url demandé

        //le tableau des URLs, controleurs et leurs méthodes
        private $allRequest;
       
        public function __construct($request){
            $this->request = $request;
            $this->allRequest = [
                'AdminEcoleController' => [
                    'motCleAdmin' => 'getAuthInspecteur',
                    'formulaire-authentification-admin' => 'authentification'
                ],
    
                'InspecteurController' => [
                    'planifier-test' => 'getFormNotifier',
                    'formulaire-notication' => 'planifierTest',
                    'charger-la-copie' => 'getFormChargerCopie',
                    'voir-evaluation' => 'voirEvaluation'
                    
                ],

                'SystemController' => [
                    'formulaire-authentification' => 'authentification',
                    'system' => 'getAcceuil',
                    'formulaire-charger-copie' => 'scannerCopie'
                ]
            ];
        }
        //cette fonction renvoi au controleur demandé
        public function goToController(){
            //inclusion des controleurs
            require_once(CONTROLLER.'AdminEcoleController.php');
            require_once(CONTROLLER.'SystemController.php');
            require_once(CONTROLLER.'InspecteurController.php');
            
            //instantiation du controleur et déclanchement de la méthode
            $_404 = true;
            foreach($this->allRequest as $controller => $url_controller){
                if(key_exists($this->request, $url_controller)){
                    $methode = $url_controller[$this->request];
                    $classeController = new $controller();//instantiation du controleur
                    $classeController->$methode();//déclanchement de la méthode
                    $_404 = false;

                    break;
                }
            }

            if($_404)
                echo 'Erreur 404';
        }   
    }