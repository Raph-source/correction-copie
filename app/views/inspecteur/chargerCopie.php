<?php
$title = "Home";
$style = ASSETS_CSS.'inspecteur/home.css';
require_once(HEADER);
if(isset($notif))
    echo $notif;
?>
<div>
   <form action="formulaire-charger-copie" method="post" enctype="multipart/form-data">
        <label for="copie">Selection la copie</label>
        <input type="file" name="copie" id=""><br>
        <input type="submit" value="Charger"><br>
   </form>
</div>
<?php
if(isset($notif)) echo $notif;
require_once(FOOTER);
