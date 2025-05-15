<?php
require_once __DIR__ . '/../model/connectaBd.php';
require_once __DIR__ . '/../model/categories.php';

$connexio = connectarBD();
$categories = getCategories($connexio);

require __DIR__ . '/../views/header.php';
