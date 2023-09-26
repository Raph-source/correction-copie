<?php
ini_set('display_errors', 'ON');
error_reporting(E_ALL);

$host = $_SERVER['HTTP_HOST'];
$root = $_SERVER['DOCUMENT_ROOT'];

define('HOST', '//'.$host.'/MemoireWighens/');//lien absolu du projet
define('ROOT', $root.'/MemoireWighens/');//adresse absolue du projet

//adresse absolue vers les fichiers app (controllers, models, views) 
define('CONTROLLER', ROOT.'app/controllers/');
define('MODEL', ROOT.'app/models/');
define('VIEW', ROOT.'app/views/');

//adresse absolue vers le header et le footer
define('HEADER', ROOT.'app/views/header.php');
define('FOOTER', ROOT.'app/views/footer.php');

//adresse absolue vers routeur
define('ROUTEUR', ROOT.'routeur/routeur.php');

//chemin absolu vers les assets css
define('ASSETS_CSS', HOST.'assets/css/');

//chemin absolu vers les assets js
define('ASSETS_JS', HOST.'assets/js/');

//chemin absolue vers le dossier bibliotheque
define("BIBLIOTHEQUE", ROOT.'bibliotheque/');

define("UPLOADS", ROOT.'uploads/');

define("STORAGE", ROOT.'storage/');