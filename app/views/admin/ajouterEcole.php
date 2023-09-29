<?php
$title = "ajout école";
$style = ASSETS_CSS.'ajoutEcole.css';
require_once(HEADER);
?>
<form action="formulaire-ajout-ecole" method="post" enctype="multipart/form-data">
    <label for="ecole">Choisissez le fichier excel de l'école</label><br>
    <input type="file" name="ecole" id=""><br>
    <input type="submit" value="valider">
</form>

<?php
if(isset($notif)) 
    echo $notif;
require_once(FOOTER);
?>