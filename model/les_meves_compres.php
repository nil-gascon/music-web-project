<?php

function llistat_comandes($connexio)
{

    $sql = "SELECT 
                *
            FROM 
                comanda c, linia_comanda l
            WHERE
                c.usuari_id = $1 AND 
                c.id = l.comanda_id
            ORDER BY
                l.comanda_id";

    pg_prepare($connexio, "sql", $sql);
    $consulta = pg_execute($connexio, "sql", array($_SESSION['id']));
    $resultat = pg_fetch_all($consulta);
    pg_close($connexio);

    return $resultat;
}
