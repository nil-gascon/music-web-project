<?php

session_start();
if (!isset($_SESSION['id'])) {
    $_SESSION['id'] = hexdec(bin2hex(random_bytes(16))) + 10000;
}
if (!isset($_SESSION['inici_sessio'])) {
    $_SESSION['inici_sessio'] = false;
}
if (!isset($_SESSION['cistella'])) {
    $_SESSION['cistella'] = [];
}
function printar($string)
{
    echo htmlentities($string, ENT_QUOTES | ENT_HTML5, 'UTF-8');
}


$accio = $_GET['accio'] ?? null;

switch ($accio) {
    case 'categories':
        require __DIR__ . '/controller/llistar_categories.php';
        break;
    case 'llistat':
        require __DIR__ . '/controller/llistar_productes.php';
        break;
    case 'producte':
        require __DIR__ . '/controller/detallar_producte.php';
        break;
    case 'cistella':
        require __DIR__ . '/controller/cistella.php';
        break;
    case 'iniciar_sessio':
        require __DIR__ . '/controller/iniciar_sessio.php';
        break;
    case 'registre':
        require __DIR__ . '/controller/registre.php';
        break;
    case 'registre2':
        require __DIR__ . '/controller/registre2.php';
        break;
    case 'efectuar_comanda':
        require __DIR__ . '/controller/efectuar_comanda.php';
        break;
    case 'tancar_sessio':
        require __DIR__ . '/controller/tancar_sessio.php';
        break;
    case 'editar_perfil':
        require __DIR__ . '/controller/editar_perfil.php';
        break;
    case 'les_meves_compres':
        require __DIR__ . '/controller/les_meves_compres.php';
        break;
    case 'cerca':
        require __DIR__ . '/controller/cerca.php';
        break;
    case 'preview':
        require __DIR__ . '/controller/preview_cistella.php';
        break;
    default:
        require __DIR__ . '/controller/inici.php';
        break;
}
