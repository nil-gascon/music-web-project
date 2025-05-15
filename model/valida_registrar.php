<?php
require __DIR__ . '/connectaBd.php';

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $nom = htmlentities($_POST['nom'], ENT_QUOTES | ENT_HTML5, 'UTF-8');
    $email = $_POST['correu'];
    $password = htmlentities($_POST['password'], ENT_QUOTES | ENT_HTML5, 'UTF-8');
    $adreca = htmlentities($_POST['adreca'] ?? '', ENT_QUOTES | ENT_HTML5, 'UTF-8');
    $imatge = htmlentities($_FILES['imatge']['name'] ?? '', ENT_QUOTES | ENT_HTML5, 'UTF-8');
    $poblacio = htmlentities($_POST['poblacio'] ?? '', ENT_QUOTES | ENT_HTML5, 'UTF-8');
    $codi_postal = htmlentities($_POST['codi_postal'], ENT_QUOTES | ENT_HTML5, 'UTF-8');


    $connexio = connectarBD();


    if (empty($nom)) {
        $errors[] = "El camp nom és obligatori.";
    } elseif (!preg_match("/^[a-zA-Z\s]+$/", $nom)) {
        $errors[] = "El nom només pot contenir caràcters i espais.";
    }

    if (empty($email)) {
        $errors[] = "El camp correu electrònic és obligatori.";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors[] = "L'adreça de correu electrònic no és vàlida.";
    }

    if (empty($password)) {
        $errors[] = "El camp contrasenya és obligatori.";
    } elseif (!preg_match("/^[a-zA-Z0-9]+$/", $password)) {
        $errors[] = "La contrasenya només pot contenir caràcters alfanumèrics.";
    }

    if (strlen($adreca) > 30) {
        $errors[] = "L'adreça no pot superar els 30 caràcters.";
    }

    if (strlen($poblacio) > 30) {
        $errors[] = "La població no pot superar els 30 caràcters.";
    }

    if (empty($codi_postal)) {
        $errors[] = "El camp codi postal és obligatori.";
    } elseif (!preg_match("/^\d{5}$/", $codi_postal)) {
        $errors[] = "El codi postal ha de contenir exactament 5 dígits.";
    }

    if (!empty($errors)) {
        $_SESSION['errors'] = $errors;
        echo $errors;
        echo "<script>
        alert('Hi ha errors en el formulari! Torna a intentar-ho.');
        window.location.href = 'https://tdiw-j2.deic-docencia.uab.cat?accio=registre2';
        </script>";
        exit();
    }

    $hashed_password = password_hash($password, PASSWORD_DEFAULT);


    $sql = "INSERT INTO usuari (email, nom, adreça, imatge, password, població, codi_postal) 
            VALUES ($1, $2, $3, $4, $5, $6, $7)";


    $consulta = pg_prepare($connexio, "sql", $sql);
    if (!$consulta) {
        die("Error en preparar la consulta: " . pg_last_error());
    }

    $resultat = pg_execute($connexio, "sql", array($email, $nom, $adreca, $imatge, $hashed_password, $poblacio, $codi_postal));

    if ($resultat) {
        pg_close($connexio);
        header("Location: http://tdiw-j2.deic-docencia.uab.cat");
        exit();
    } else {
        die("Registre incorrecta.");
    }
}
