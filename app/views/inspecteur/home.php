
<?php
$title = "Home";
$style = ASSETS_CSS.'admin/home.css';
require_once(HEADER);
?>
<div class="container">
    <div class="content">
        <h3>Kelasi <span>App</span></h3>

        <div class="text">
            <p>Espace <br> Inspecteur</p>
            <p>Planifier test</p>
            <p>Charger un model</p>
            <p>charger la copie</p>
            <p>Voir Evaluation</p>
        </div>
    </div>
    <div class="option">
        <h3>Choisissez <span>une option :</span></h3>
        <div class="action">
            <div class="cards">
                <a href="planifier-test">
                <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-calendar-plus" width="44" height="44" viewBox="0 0 24 24" stroke-width="1.5" stroke="#00abfb" fill="none" stroke-linecap="round" stroke-linejoin="round">
                    <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                    <path d="M12.5 21h-6.5a2 2 0 0 1 -2 -2v-12a2 2 0 0 1 2 -2h12a2 2 0 0 1 2 2v5" />
                    <path d="M16 3v4" />
                    <path d="M8 3v4" />
                    <path d="M4 11h16" />
                    <path d="M16 19h6" />
                    <path d="M19 16v6" />
                </svg>
                <span>planifier <br> test</span>
                </a>
            </div>
            <div class="cards">
                <a href="charger-model">
                <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-book-upload" width="44" height="44" viewBox="0 0 24 24" stroke-width="1.5" stroke="#00abfb" fill="none" stroke-linecap="round" stroke-linejoin="round">
                <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                <path d="M14 20h-8a2 2 0 0 1 -2 -2v-12a2 2 0 0 1 2 -2h12v5" />
                <path d="M11 16h-5a2 2 0 0 0 -2 2" />
                <path d="M15 16l3 -3l3 3" />
                <path d="M18 13v9" />
                </svg>

                    <span>charger <br> model</span> 
                </a>
            </div>
        </div>

        <div class="action" >
            <div class="cards" style="padding-left: 3.5em;">
                <a href="charger-la-copie">
                <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-news" width="44" height="44" viewBox="0 0 24 24" stroke-width="1.5" stroke="#00abfb" fill="none" stroke-linecap="round" stroke-linejoin="round">
                    <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                    <path d="M16 6h3a1 1 0 0 1 1 1v11a2 2 0 0 1 -4 0v-13a1 1 0 0 0 -1 -1h-10a1 1 0 0 0 -1 1v12a3 3 0 0 0 3 3h11" />
                    <path d="M8 8l4 0" />
                    <path d="M8 12l4 0" />
                    <path d="M8 16l4 0" />
                    </svg>
                <span>charger la <br> copie</span>
                </a>
            </div>
            <div class="cards " >
                <a href="voir-evaluation">
                <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-eye" width="44" height="44" viewBox="0 0 24 24" stroke-width="1.5" stroke="#00abfb" fill="none" stroke-linecap="round" stroke-linejoin="round">
                <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                <path d="M10 12a2 2 0 1 0 4 0a2 2 0 0 0 -4 0" />
                <path d="M21 12c-2.4 4 -5.4 6 -9 6c-3.6 0 -6.6 -2 -9 -6c2.4 -4 5.4 -6 9 -6c3.6 0 6.6 2 9 6" />
                </svg>

                    <span>Voir <br> évaluation</span> 
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

