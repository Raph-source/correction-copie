<?php
$title = "Charger la copie";
$style = ASSETS_CSS.'Admin/ajoutEcole.css';
require_once(HEADER);
?>
<div class="container">
    
    <div class="card">
        <div class="card-image">
            <h3>Charger la copie</h3>
            <img src="<?php echo ASSETS_IMG."Typing-pana.png" ?>" alt="">
        </div>
        <div class="card-body">
            <div class="click-div">
                <img src="<?php echo ASSETS_IMG."upload.png" ?>" alt="">
                <p>Click ici</p>
            </div>
            <div class="file-list">
                <div class="icon">
                    <img src="<?php echo ASSETS_IMG."papier.png" ?>" alt="">
                </div>
                <span class="nameFile"></span>
            </div>
            <form action="formulaire-charger-copie" method="post" enctype="multipart/form-data" >
<!--                <label for="ecole">Choisissez le fichier excel de l'école</label><br> -->
                <input type="file" name="copie" id="" class="fileInput" hidden><br>
                <input type="submit" value="charger">
            </form>
        </div>
    </div>
    <div class="erreur">
        <?php
            if(isset($notif)) 
            {
                echo'<p>';
                    echo $notif;
                echo'</p>';
            }
        ?>
    </div>
</div>

<?php
    $script = ASSETS_JS."Admin/uploader.js";
    require_once(FOOTER);
?>