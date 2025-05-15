<?php

require __DIR__ . '/../model/connectaBd.php';
require __DIR__ . '/../model/les_meves_compres.php';

$connexio = connectarBD();
$resultat = llistat_comandes($connexio);

require __DIR__ . '/../views/les_meves_compres.php';
