<?php
$title = "Authentification";
$style = ASSETS_CSS.'authentification.css';
require_once(HEADER);
?>
<form action="formulaire-authentification-admin" method="post">
    <input type="text" name="pseudo" id="" placeholder="Entrez votre pseudo"><br>
    <input type="text" name="pwd" id="" placeholder="Entrez votre mot de passe"><br>
    <input type="submit" value="valider">
</form>

<?php
if(isset($notif)) 
    echo $notif;
require_once(FOOTER);
?>