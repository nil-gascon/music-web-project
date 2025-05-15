<?php
function getCategories($connexio)
{

    $sql = "SELECT * FROM categoria ORDER BY id";
    $consulta = pg_query($connexio, $sql) or die("Error: (pg_query)" . pg_last_error());
    $resultat = pg_fetch_all($consulta);
    pg_close($connexio);
    return $resultat;
}
