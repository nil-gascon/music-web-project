<header class="header">
    <audio id="musica_fons" loop>
        <source src="audio/musica.mp3" type="audio/mpeg">
    </audio>
    <div class="logocentrar">
        <a href="#" onclick="carrega('categories')">
            <img src="img/logo.png" alt="N&S Music" class="logo">
        </a>
        <div class="eslogan">Where Music Begins</div>
    </div>
    <nav class="menu">
        <div class="opcio_menu">
            <a href="#" onclick="carrega('categories')">Productes</a>
            <div class="categories_desplegables">
                <?php
                foreach ($categories as $categoria): ?>
                    <a href="#" onclick="carrega(<?php printar($categoria['id']) ?>,'categoria');">
                        <?php printar($categoria['nom']) ?>
                    </a>
                <?php endforeach; ?>
            </div>
        </div>
        <div class="buscador">
            <input type="text" placeholder="Busca els productes..." class="intro_buscador"
                onkeydown="if(event.key === 'Enter') carrega(this.value,'cerca')">
        </div>
        <div class="opcio_menu compte_menu">
            <a href="#" id="compte-btn">Compte</a>
            <div class="menu_desplegable" id="menu-compte" style="display: none;">

            </div>
        </div>
        <div class="opcio_menu">
            <a href="#" onclick="carrega('cistella');">Cistella</a>
            <p id="quantitatIpreu">
                <?php
                require __DIR__ . '/../controller/preview_cistella.php';
                ?>
            </p>
        </div>
    </nav>
</header>