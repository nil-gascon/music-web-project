<section class="productes">
    <p id="missatge-cistella"></p>
    <?php if (!empty($productes)) { ?>
        <h2><?php printar($productes[0]['categoria_nom']) ?></h2>
        <ul class="producte-list">
            <?php foreach ($productes as $producte): ?>
                <li id="p<?php printar($producte['producte_id']) ?>">
                    <a href="#" onclick="carrega(<?php printar($producte['producte_id']) ?>,'producte');">
                        <img src="<?php printar($producte['imatge']) ?>"
                            alt="<?php printar($producte['producte_nom']) ?>">
                        <div>
                            <?php printar($producte['producte_nom']) ?> - <?php printar($producte['preu']) ?> €
                        </div>
                    </a>
                    <button class="afegir-cistella"
                        onclick="afegirALaCistella(<?php printar($producte['producte_id']) ?>,
                            <?php printar($producte['preu']) ?>,1)">Afegir a la cistella
                    </button>
                </li>
            <?php endforeach; ?>
        <?php } else { ?>
            <h2>No hi ha productes disponibles</h2>
        <?php } ?>
        </ul>
</section>