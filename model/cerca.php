<?php

function cerca($connexio)
{
    $resultat = null;

    if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['valor'])) {
        $cerca = $_GET['valor'];

        if (!empty($cerca)) {
            $patroCerca = '%' . $cerca . '%';
            $sql = "SELECT id, nom, descripció, preu
                    FROM producte
                    WHERE nom ILIKE $1 OR descripció ILIKE $1
                    ORDER BY nom";
            $consulta = pg_prepare($connexio, 'sql', $sql);
            $consulta = pg_execute($connexio, 'sql', array($patroCerca));
            $resultat = pg_fetch_all($consulta);
        }
    }
    pg_close($connexio);
    return $resultat;
}
