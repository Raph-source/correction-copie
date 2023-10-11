
<?php
$title = "Authentification";
$style = ASSETS_CSS.'admin/authentification.css';
$style1 = ASSETS_CSS.'index.css';
require_once(HEADER);
?>
<div class="container">
    <div class="form">
        <h3>Kelasis<span>App</span>
        </h3>
        <form action="formulaire-authentification" method="post">
            <input type="text" name="pseudo" id="" placeholder="Entrez votre pseudo"><br>
            <input type="password" name="pwd" id="" placeholder="Entrez votre mot de passe"><br>
            <input type="submit" value="Valider">
            <?php
                
                if(isset($notif)) {
                    echo "<p>";
                    echo $notif;
                    echo "</p>";
                }
            ?>
        </form>
    </div>
</div>

<?php
require_once(FOOTER);
?>