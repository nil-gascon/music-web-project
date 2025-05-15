<?php
function getProducte($connexio, $id)
{

    $sql = "SELECT * FROM producte WHERE id = $1 ORDER BY id";

    $consulta = pg_prepare($connexio, $id, $sql);
    $consulta = pg_execute($connexio, $id, array($id));
    $resultat = pg_fetch_all($consulta);

    return $resultat[0];
}

function carregaCistella($connexio)
{
    $total = 0;
    $res = [];

    foreach ($_SESSION['cistella'] as $id_producte => $detalls) {
        $p = [];
        $producte = getProducte($connexio, $id_producte);
        $p['imatge'] = $producte['imatge'];
        $p['nom'] = $producte['nom'];
        $quantitat = $p['quantitat'] = $detalls['quantitat'];
        $preu = $p['preu'] = $detalls['preu'];
        $total_producte = $p['total_producte'] = $quantitat * $preu;
        $total += $total_producte;
        $res[$id_producte] = $p;
    }

    pg_close($connexio);
    return array($total, $res);
}
