<?php
function getProductes($connexio)
{

    $categoriaId = $_GET['categoria_id'] ?? null;
    $sql = "SELECT 
                p.id AS producte_id, 
                p.nom AS producte_nom, 
                c.nom AS categoria_nom, 
                p.categoria_id, 
                p.descripció, 
                p.imatge, 
                p.stock, 
                p.preu 
            FROM 
                producte p
            INNER JOIN 
                categoria c 
            ON 
                p.categoria_id = c.id
            WHERE 
                p.categoria_id = $1
            ORDER BY 
                p.id";
    $consulta = pg_prepare($connexio, "sql", $sql);
    $consulta = pg_execute($connexio, "sql", array($categoriaId));
    $resultat = pg_fetch_all($consulta);
    pg_close($connexio);
    return $resultat;
}
