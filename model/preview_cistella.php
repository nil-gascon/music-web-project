<?php

function calcularPreview()
{
    $total = 0;
    $q = 0;

    foreach ($_SESSION['cistella'] as $id_producte => $detalls) {
        $quantitat = $detalls['quantitat'];
        $preu = $detalls['preu'];
        $total_producte = $quantitat * $preu;
        $total += $total_producte;
        $q += $quantitat;
    }
    return array($total, $q);
}
