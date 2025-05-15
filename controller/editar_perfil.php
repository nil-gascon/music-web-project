<?php
require_once __DIR__ . '/../model/connectaBd.php';
require_once __DIR__ . '/../model/editar_perfil.php';

$connexio = connectarBD();

require_once __DIR__ . '/../views/editar_perfil.php';
