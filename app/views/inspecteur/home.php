<?php
$title = "Home";
$style = ASSETS_CSS.'inspecteur/home.css';
require_once(HEADER);
?>
<h1>Home inspecteur</h1>
<div>
    <a href="planifier-test">planifier test</a><br>
    <a href="charger-la-copie">charger la copie</a><br>
    <a href="voir-evaluation">voir évaluation</a><br>
</div>
<?php
if(isset($notif)) echo $notif;
require_once(FOOTER);
?>