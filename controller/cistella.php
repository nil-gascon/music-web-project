<?php
require_once __DIR__ . '/../model/connectaBd.php';
require_once __DIR__ . '/../model/cistella.php';

$connexio = connectarBD();
$resultat = carregaCistella($connexio);

require __DIR__ . '/../views/cistella.php';
