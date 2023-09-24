<?php
$title = "Home";
$style = ASSETS_CSS.'admin/home.css';
require_once(HEADER);
?>
<h1>Home admin</h1>
<div>
    <a href="">Créer un compte</a><br>
    <a href="">configurer une école</a><br>
    <a href="">affecter un élève</a><br>
</div>
<?php
if(isset($notif)) echo $notif;
require_once(FOOTER);
?>