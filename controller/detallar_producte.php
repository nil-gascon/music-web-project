<?php

require_once __DIR__ . '/../model/connectaBd.php';
require_once __DIR__ . '/../model/producte.php';

$connexio = connectarBD();
$producte = getProducte($connexio);

require __DIR__ . '/../views/detall_producte.php';
