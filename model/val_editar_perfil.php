<?php
$filesAbsolutePath = '/home/TDIW/tdiw-j2/public_html/img/usuaris/';
require_once __DIR__ . '/../model/connectaBd.php';
require_once __DIR__ . '/editar_perfil.php';


if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

$connexio = connectarBD();
$userId = $_SESSION['id'];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nom = htmlentities($_POST['nom'], ENT_QUOTES | ENT_HTML5, 'UTF-8');
    $password = !empty($_POST['password']) ? htmlentities($_POST['password'], ENT_QUOTES | ENT_HTML5, 'UTF-8') : null;
    $adreca = !empty($_POST['adreca']) ? htmlentities($_POST['adreca'] ?? '', ENT_QUOTES | ENT_HTML5, 'UTF-8') : null;
    $poblacio = !empty($_POST['poblacio']) ? htmlentities($_POST['poblacio'] ?? '', ENT_QUOTES | ENT_HTML5, 'UTF-8') : null;
    $codi_postal = !empty($_POST['codi_postal']) ? htmlentities($_POST['codi_postal'], ENT_QUOTES | ENT_HTML5, 'UTF-8') : null;
    $email = $_POST['email'];
    $imatge = null;
    if (isset($_FILES['imatge'])) {
        $imatge = !empty($_FILES['imatge']) ? $_FILES['imatge'] : null;
    }
    $rutaImatge = null;


    if ($imatge['error'] === 0) {
        $nomFitxer = $userId . '.' . pathinfo($imatge['name'], PATHINFO_EXTENSION);
        $destinacio = $filesAbsolutePath . $nomFitxer;

        $fitxers = scandir($filesAbsolutePath);

        foreach ($fitxers as $fitxer) {
            if (strpos($fitxer, $userId) === 0) {
                $camí_complet = $filesAbsolutePath . $fitxer;

                if (is_file($camí_complet)) {
                    if (!unlink($camí_complet)) {
                        die("No s'ha pogut esborrar el fitxer $fitxer.\n");
                    }
                }
            }
        }

        if (move_uploaded_file($_FILES['imatge']['tmp_name'], $destinacio)) {
            $rutaImatge = '/img/usuaris/' . $nomFitxer;
        } else {
            die("ERROR EN PUJAR IMATGE");
        }
    } else {
        if ($imatge['error'] === 1) {
            die("ERROR, mida imatge molt gran");
        }
    }

    if ($imatge['error'] === 4 || $imatge['error'] === 0) {
        actualitzarUsuari($connexio, $userId, $nom, $email, $password, $adreca, $poblacio, $codi_postal, $rutaImatge);
        header("Location: http://tdiw-j2.deic-docencia.uab.cat");
    }
}
pg_close($connexio);
