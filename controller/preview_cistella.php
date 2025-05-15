<?php
require_once __DIR__ . '/../model/preview_cistella.php';
$resultat = calcularPreview();
require __DIR__ . '/../views/preview_cistella.php';
