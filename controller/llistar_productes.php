<?php
require_once __DIR__ . '/../model/connectaBd.php';
require_once __DIR__ . '/../model/productes.php';

$connexio = connectarBD();
$productes = getProductes($connexio);


require __DIR__ . '/../views/llista_productes.php';
