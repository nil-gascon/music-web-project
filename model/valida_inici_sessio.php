<?php
require __DIR__ . '/connectaBd.php';
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

if ($_SERVER["REQUEST_METHOD"] === "POST") {

    $email = $_POST['email'];
    $password = $_POST['password'];

    $connexio = connectarBD();

    $sql = "SELECT * FROM usuari WHERE email = $1";
    $consulta = pg_prepare($connexio, "consulta_usuari", $sql);
    $resultat = pg_execute($connexio, "consulta_usuari", array($email));

    $usuari = pg_fetch_all($resultat)[0];

    if (password_verify($password, $usuari['password'])) {
        $_SESSION['id'] = $usuari['id'];
        $_SESSION['inici_sessio'] = true;

        pg_close($connexio);
        header("Location: http://tdiw-j2.deic-docencia.uab.cat");
        exit();
    } else {
        pg_close($connexio);
        die("Contrasenya incorrecta.");
    }
}
