<?php if (!empty($resultat)) { ?>
    <section class="resultats">
        <h2>Resultats trobats:</h2>
        <ul>
            <?php foreach ($resultat as $producte): ?>
                <li>
                    <h3><a href="#" onclick="carrega(<?php printar($producte['id']) ?>,'producte')">
                            <?php printar($producte['nom']) ?></a> - <?php printar($producte['preu']) ?> €</h3>
                    <p><?php printar($producte['descripció']) ?></p>
                </li>
            <?php endforeach; ?>
        </ul>
    </section>
<?php } else { ?>
    <p>No s'han trobat productes que coincideixin amb la cerca.</p>
<?php } ?>