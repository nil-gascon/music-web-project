<div class="container carret-cont">
    <h1>La teva cistella</h1>
    <table class="carret-taula">
        <thead>
            <tr>
                <th>Producte</th>
                <th>Preu/unitat</th>
                <th>Quantitat</th>
                <th>Total</th>
                <th>Accions</th>
            </tr>
        </thead>
        <tbody>
            <?php
            foreach ($resultat[1] as $id_producte => $detalls) { ?>
                <tr data-id="<?php printar($id_producte) ?>">
                    <td>
                        <div class="detall-prod">
                            <img src="<?php printar($detalls['imatge']) ?>"
                                alt="<?php printar($detalls['nom']) ?>" class="imatge-prod">
                            <span><?php printar($detalls['nom']) ?></span>
                        </div>
                    </td>
                    <td><?php printar($detalls['preu']) ?> €</td>
                    <td>
                        <input type="number" value="<?php printar($detalls['quantitat']) ?>" min="1" class="quantitat-prod"
                            onchange="afegirALaCistella(<?php printar($id_producte) ?>,
                            <?php printar($detalls['preu']) ?>,this.value - <?php (int)printar($detalls['quantitat']) ?>);
                                    carrega('cistella');">
                    </td>
                    <td><?php printar($detalls['total_producte']) ?> €</td>
                    <td>
                        <button class="boto-eliminar"
                            onclick="afegirALaCistella(<?php printar($id_producte) ?>,
                                    <?php printar($detalls['preu']) ?>,'E');
                                carrega('cistella');">Eliminar</button>
                    </td>
                </tr>
            <?php } ?>
        </tbody>
    </table>
    <div class="carret">
        <h3>Resum de la Comanda</h3>
        <p><strong>Subtotal:</strong> <?php printar($resultat[0]) ?> €</p>
        <p><strong>Enviament:</strong> Gratuït</p>
        <p><strong>Total:</strong> <?php printar($resultat[0]) ?> €</p>
        <?php if (isset($_SESSION['inici_sessio']) && $_SESSION['inici_sessio']): ?>
            <button id="checkoutButton" class="boto-checkout"
                onclick="this.classList.add('loading'); this.disabled=true;
                carrega('efectuar_comanda');actualitzar_previw_cistella()">
                <span class="button-text">Procedir al Pagament</span>
                <span class="spinner"></span>
            </button>
        <?php else: ?>
            <button class="boto-checkout" disabled title="Inicia sessió per continuar">Procedir al Pagament</button>
        <?php endif; ?>
    </div>
    <button class="boto-buidar" onclick="buidaCistella()">Buidar Cistella</button>
</div>