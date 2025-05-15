<div class="carret-cont">
    <h1>Detall de les Comandes</h1>

    <?php
    $comandes = [];
    foreach ($resultat as $item) {
        $comanda_id = $item['comanda_id'];
        if (!isset($comandes[$comanda_id])) {
            $comandes[$comanda_id] = [
                'data_creació' => $item['data_creació'],
                'número_elements' => $item['número_elements'],
                'import_total' => $item['import_total'],
                'productes' => []
            ];
        }
        $comandes[$comanda_id]['productes'][] = [
            'producte_id' => $item['producte_id'],
            'nom_producte' => $item['nom_producte'],
            'quantitat' => $item['quantitat'],
            'preu_unitari' => $item['preu_unitari'],
            'preu_total' => $item['preu_total']
        ];
    }

    foreach ($comandes as $comanda_id => $detalls) { ?>
        <section>
            <h2>Comanda ID: <?php echo $comanda_id ?></h2>
            <p><strong>Data de Creació:</strong> <?php echo $detalls['data_creació']; ?></p>
            <p><strong>Nombre d'Elements:</strong> <?php echo $detalls['número_elements']; ?></p>
            <p><strong>Import Total:</strong> <?php echo $detalls['import_total']; ?> €</p>

            <table class="carret-taula">
                <thead>
                    <tr>
                        <th>Producte</th>
                        <th>Quantitat</th>
                        <th>Preu Unitari (€)</th>
                        <th>Preu Total (€)</th>
                    </tr>
                </thead>
                <tbody>

                    <?php foreach ($detalls['productes'] as $producte) { ?>
                        <tr>
                            <td><a href="#" onclick="CarregaProducte(<?php echo $producte['producte_id']; ?>);"><?php echo $producte['nom_producte']; ?></a></td>
                            <td><?php echo $producte['quantitat']; ?></td>
                            <td><?php echo $producte['preu_unitari']; ?></td>
                            <td><?php echo $producte['preu_total']; ?></td>
                        </tr>
                    <?php } ?>

                </tbody>
            </table>
        </section> <br>
    <?php } ?>

</div>