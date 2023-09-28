<?php
$title = "Home";
$style = ASSETS_CSS.'enseignant/home.css';
require_once(HEADER);
?>
<h1>Home enseignant</h1>
<table border=1>
    <thead>
        <tr>
            <th>Nom</th>
            <th>Post-nom</th>
            <th>Prénom</th>
            <th>Point obtenu</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach($trouver as $valeur):?>
            <tr>
                <td><?php echo $valeur['nomEleve']?></td>
                <td><?php echo $valeur['postNomEleve']?></td>
                <td><?php echo $valeur['prenomEleve']?></td>
                <td><?php echo $valeur['pointEleve']?></td>
            </tr>
        <?php endforeach?>
    </tbody>    
</table>
<?php
if(isset($notif)) echo $notif;
require_once(FOOTER);
?>