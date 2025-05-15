<?php

require __DIR__ . '/../model/connectaBd.php';
require __DIR__ . '/../model/cerca.php';

$connexio = connectarBD();
$resultat = cerca($connexio);

require __DIR__ . '/../views/cerca.php';
