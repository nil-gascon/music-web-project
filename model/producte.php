<?php
function getProducte($connexio)
{

    $producteId = $_GET['producte_id'] ?? null;

    $sql = "SELECT * FROM producte WHERE id = $1 ORDER BY id";

    $consulta = pg_prepare($connexio, "sql", $sql);
    $consulta = pg_execute($connexio, "sql", array($producteId));
    $resultat = pg_fetch_all($consulta);
    pg_close($connexio);
    return $resultat[0];
}
