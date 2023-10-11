
<?php
$title = "Home";
$style = ASSETS_CSS.'admin/home.css';
$style1 = ASSETS_CSS.'enseignant/home.css';
require_once(HEADER);
?>
<div class="container">
    <div class="content">
        <h3>Kelasi <span>App</span></h3>

        <div class="text">
            <p>Espace <br> Enseignant</p>
            <p>Voir la liste des élèves</p>
            <p>Et leurs cotes</p>
        </div>
    </div>
    <div class="option">
        <div class="action">
            <table>
                    <thead>
                        <tr>
                            <th>Nom</th>
                            <th>Post-nom</th>
                            <th>Prénom</th>
                            <th>Question faciles</th>
                            <th>Question moyennes</th>
                            <th>Question difficiles</th>
                            <th>Total</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach($trouver as $valeur):?>
                            <tr>
                                <td><?php echo $valeur['nomEleve']?></td>
                                <td><?php echo $valeur['postNomEleve']?></td>
                                <td><?php echo $valeur['prenomEleve']?></td>
                                <td><?php echo $valeur['coteFacile']?></td>
                                <td><?php echo $valeur['coteMoyenne']?></td>
                                <td><?php echo $valeur['coteDifficile']?></td>
                                <?php
                                    //somme des trois côte
                                    $total = $valeur['coteFacile'] + $valeur['coteMoyenne'] + $valeur['coteDifficile'];
                                ?>
                                <td><?php echo $total?></td>
                            </tr>
                        <?php endforeach?>
                    </tbody>    
                </table>
                <?php
                if(isset($notif)) echo $notif;
                require_once(FOOTER);
                ?>
            
        </div>
    </div>
</div>
<?php
            if(isset($notif)) echo $notif;
            require_once(FOOTER);
        ?>

