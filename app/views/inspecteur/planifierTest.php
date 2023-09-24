<?php
$title = "Home";
$style = ASSETS_CSS.'inspecteur/home.css';
require_once(HEADER);
?>
<form action="formulaire-notication" method="post">
    <input type="mail" name="email"><br>
    <input type="date" name="date" id=""><br>
    <input type="submit" value="valider"><br>
</form>
<?php
if(isset($notif)) echo $notif;
require_once(FOOTER);
?>