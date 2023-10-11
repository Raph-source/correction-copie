
<?php
    $title = "planifier test";
    $style = ASSETS_CSS.'admin/authentification.css';
    $style1 = ASSETS_CSS.'inspecteur/home.css';
    require_once(HEADER);
?>
<div class="container">
    <div class="form">
        <h3>Kelasis<span>App</span>
        </h3>
        <form action="formulaire-notication" method="post">
            <h3>Planifier un test</h3>
            <input type="mail" name="email" placeholder="Entrer votre Adresse mail"><br>
            <input type="date" name="date" id=""><br>
            <input type="submit" value="valider"><br>
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