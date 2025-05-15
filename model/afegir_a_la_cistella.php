<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}


if (isset($_POST['id_producte'])) {
    $id_producte = $_POST['id_producte'];
    $quantitat = $_POST['quantitat'];
    $preu = $_POST['preu'];


    if (isset($_SESSION['cistella'][$id_producte])) {
        if (is_numeric($quantitat)) {
            if ($_SESSION['cistella'][$id_producte]['quantitat'] + $quantitat > 0) {
                $_SESSION['cistella'][$id_producte]['quantitat'] += $quantitat;
            }
        } else {
            unset($_SESSION['cistella'][$id_producte]);
        }
    } else {
        $_SESSION['cistella'][$id_producte] = [
            'quantitat' => $quantitat,
            'preu' => $preu
        ];
    }

    echo json_encode([
        'estat' => 'èxit',
        'missatge' => 'Producte gestionat correctament a la cistella.'
    ]);
} else {
    echo json_encode([
        'estat' => 'error',
        'missatge' => 'Error en afegir el producte a la cistella.'
    ]);
}
