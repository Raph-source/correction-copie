<?php
$title = "Home";
$style = ASSETS_CSS.'inspecteur/chargerModel.css';
require_once(HEADER);
if(isset($notif))
    echo $notif;
?>
<div>
   <form action="formulaire-charger-model" method="post" enctype="multipart/form-data">
        <label for="modele">Selection le model</label>
        <input type="file" name="modele" id=""><br>
        <input type="submit" value="Charger"><br>
   </form>
</div>
<?php
if(isset($notif)) echo $notif;
require_once(FOOTER);
