<?php
$title = "Home";
$style = ASSETS_CSS.'enseignant/home.css';
require_once(HEADER);
?>
<h1>Home enseignant</h1>
<table>
    <?php 
        foreach($trouver as $valeur){
            //à faire
        }
    ?>
</table>
<?php
if(isset($notif)) echo $notif;
require_once(FOOTER);
?>