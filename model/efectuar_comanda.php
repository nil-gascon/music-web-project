<?php
function getProducte($connexio, $id)
{

    $sql = "SELECT * FROM producte WHERE id = $1 ORDER BY id";

    $consulta = pg_prepare($connexio, "sql", $sql);
    $consulta = pg_execute($connexio, "sql", array($id));
    $resultat = pg_fetch_all($consulta);

    return $resultat[0];
}

function efectuarComanda($connexio)
{

    if (isset($_SESSION['cistella']) && is_array($_SESSION['cistella'])) {
        $longitud = count($_SESSION['cistella']);
        if ($longitud > 0) {
            $total = 0;
            $usuari_id = $_SESSION['id'] ?? null;

            if ($usuari_id === null) {
                die("Error: Usuari no identificat.");
            }

            foreach ($_SESSION['cistella'] as $id_producte => $detalls) {
                $quantitat = $detalls['quantitat'];
                $preu = $detalls['preu'];
                $total += $quantitat * $preu;
            }

            $data_creacio = date('Y-m-d H:i:s');

            $sql_comanda = "INSERT INTO comanda (data_creació, número_elements, import_total, usuari_id) 
                        VALUES ($1, $2, $3, $4) RETURNING id";

            $consulta_comanda = pg_prepare($connexio, "insert_comanda", $sql_comanda);
            if (!$consulta_comanda) {
                die("Error en preparar la consulta: " . pg_last_error($connexio));
            }

            $resultat_comanda = pg_execute($connexio, "insert_comanda", array($data_creacio, $longitud, $total, $usuari_id));
            if (!$resultat_comanda) {
                die("Error en executar la consulta: " . pg_last_error($connexio));
            }

            $comanda_id = pg_fetch_result($resultat_comanda, 0, 'id');

            $sql_linia_comanda = "INSERT INTO linia_comanda (nom_producte, quantitat, preu_unitari, preu_total, comanda_id, producte_id) 
                              VALUES ($1, $2, $3, $4, $5, $6)";

            $consulta_linia = pg_prepare($connexio, "insert_linia_comanda", $sql_linia_comanda);
            if (!$consulta_linia) {
                die("Error en preparar la consulta: " . pg_last_error($connexio));
            }

            foreach ($_SESSION['cistella'] as $id_producte => $detalls) {
                $producte = getProducte($connexio, $id_producte);
                if (!$producte) {
                    die("Error: No s'ha trobat el producte amb ID $id_producte.");
                }

                $nom_producte = $producte['nom'];
                $quantitat = $detalls['quantitat'];
                $preu_unitari = $detalls['preu'];
                $preu_total = $quantitat * $preu_unitari;

                $resultat_linia = pg_execute($connexio, "insert_linia_comanda", array(
                    $nom_producte,
                    $quantitat,
                    $preu_unitari,
                    $preu_total,
                    $comanda_id,
                    $id_producte
                ));

                if (!$resultat_linia) {
                    die("Error en inserir la línia de comanda: " . pg_last_error($connexio));
                }
            }

            pg_close($connexio);
            unset($_SESSION['cistella']);
            return true;
        }
        pg_close($connexio);
        return false;
    } else {
        pg_close($connexio);
        return false;
    }
}
