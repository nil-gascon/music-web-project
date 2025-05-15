<?php
require __DIR__ . '/../model/connectaBd.php';
require __DIR__ . '/../model/efectuar_comanda.php';

$connexio = connectarBD();
$correcte = efectuarComanda($connexio);

if ($correcte) {
    require __DIR__ . '/../views/comanda_correcte.php';
} else {
    require __DIR__ . '/../views/error_comanda.php';
}
