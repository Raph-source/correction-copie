<?php
$title = "ajout école";
$style = ASSETS_CSS.'Admin/ajoutEcole.css';
require_once(HEADER);
?>
<div class="container">
    
    <div class="card">
        <div class="card-image">
            <h3>Uploader un Fichier Excel</h3>
            <img src="<?php echo ASSETS_IMG."4202055.jpg" ?>" alt="">
        </div>
        <div class="card-body">
            <div class="click-div">
                <img src="<?php echo ASSETS_IMG."upload.png" ?>" alt="">
                <p>Click ici</p>
            </div>
            <div class="file-list">
                <div class="icon">
                    <img src="<?php echo ASSETS_IMG."xlsx (1).png" ?>" alt="">
                </div>
                <span class="nameFile"></span>
            </div>
            <form action="formulaire-ajout-ecole" method="post" enctype="multipart/form-data" >
<!--                <label for="ecole">Choisissez le fichier excel de l'école</label><br> -->
                <input type="file" name="ecole" id="" class="fileInput" hidden><br>
                <input type="submit" value="valider">
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