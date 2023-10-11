
<?php
$title = "Home";
$style = ASSETS_CSS.'admin/home.css';
require_once(HEADER);
?>
<div class="container">
    <div class="content">
        <h3>Kelasi <span>App</span></h3>

        <div class="text">
            <p>Espace <br> Adminitracteur</p>
            <p>Ajouter des écoles</p>
            <p>Affecter un élève à une école</p>
        </div>
    </div>
    <div class="option">
        <h3>Choisissez <span>une option :</span></h3>
        <div class="action">
            <div class="cards">
                <a href="ajouter-ecole">
                <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-home-plus" width="46" height="46" viewBox="0 0 24 24" stroke-width="1.5" stroke="#00abfb" fill="none" stroke-linecap="round" stroke-linejoin="round">
                    <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                    <path d="M19 12h2l-9 -9l-9 9h2v7a2 2 0 0 0 2 2h5.5" />
                    <path d="M9 21v-6a2 2 0 0 1 2 -2h2a2 2 0 0 1 2 2" />
                    <path d="M16 19h6" />
                    <path d="M19 16v6" />
                </svg>
                <span>ajouter <br> une école</span>
                </a>
            </div>
            <div class="cards">
                <a href="">
                <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-user-plus" width="44" height="44" viewBox="0 0 24 24" stroke-width="1.5" stroke="#00abfb" fill="none" stroke-linecap="round" stroke-linejoin="round">
                        <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                        <path d="M8 7a4 4 0 1 0 8 0a4 4 0 0 0 -8 0" />
                        <path d="M16 19h6" />
                        <path d="M19 16v6" />
                        <path d="M6 21v-2a4 4 0 0 1 4 -4h4" />
                    </svg>

                    <span>affecter <br> un élève</span> 
                </a>
            </div>
            
        </div>
        <?php
            if(isset($notif)) echo $notif;
        ?>
    </div>
</div>
<?php
            if(isset($notif)) echo $notif;
            require_once(FOOTER);
        ?>

