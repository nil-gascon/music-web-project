<section class="detall-producte">
    <p id="missatge-cistella"></p>
    <div class="detall-container">
        <div class="imatge-producte">
            <img src="<?php printar($producte['imatge']) ?>" alt="<?php printar($producte['nom']) ?>">
        </div>
        <div class="informacio-producte">
            <h1><?php printar($producte['nom']) ?></h1>
            <p class="descripcio"><?php printar($producte['descripció']) ?></p>
            <p class="preu">Preu: <?php printar($producte['preu']) ?>€</p>
            <label for="quantitat-<?php printar($producte['id']) ?>">Quantitat:</label>
            <input type="number" id="q" value="1" min="1">
            <button type="submit" class="boton-afegir"
                onclick="afegirALaCistella(<?php printar($producte['id']) ?>,
                    <?php printar($producte['preu']) ?>, document.getElementById('q').value);">Afegir a la cistella</button>
        </div>
    </div>
</section>