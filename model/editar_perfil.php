<?php

function obtenirUsuari($connexio, $userId)
{
    $consulta = "SELECT * FROM usuari WHERE id = $1";
    $stmt = pg_prepare($connexio, "consulta_usuari", $consulta);
    $resultat = pg_execute($connexio, "consulta_usuari", [$userId]);
    return pg_fetch_assoc($resultat);
}

function actualitzarUsuari($connexio, $userId, $nom, $email, $password, $adreca, $poblacio, $codi_postal, $rutaImatge)
{

    $params = [$nom, $email];
    $sql = "UPDATE usuari SET nom = $1, email = $2";

    if ($password !== null) {
        $sql .= ", password = $3";
        $params[] = password_hash($password, PASSWORD_DEFAULT);
    }

    if ($rutaImatge !== null) {
        $sql .= ", imatge = $" . count($params) + 1;
        $params[] = $rutaImatge;
    }

    if ($adreca !== null) {
        $sql .= ", adreça = $" . count($params) + 1;
        $params[] = $adreca;
    }

    if ($poblacio !== null) {
        $sql .= ", població = $" . count($params) + 1;
        $params[] = $poblacio;
    }

    if ($codi_postal !== null) {
        $sql .= ", codi_postal = $" . count($params) + 1;
        $params[] = $codi_postal;
    }

    $sql .= " WHERE id = $" . count($params) + 1;
    $params[] = $userId;
    pg_prepare($connexio, "actualitzar_usuari", $sql);
    $res = pg_execute($connexio, "actualitzar_usuari", $params);
    pg_close($connexio);
    return $res;
}
