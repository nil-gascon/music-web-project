<!DOCTYPE html>
<html lang="ca">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>N&S Music</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="funcionsJavaScript.js"></script>
    <link rel="stylesheet" href="styles.css">
    <link rel="icon" type="image/png" href="/img/favicon.png">
</head>

<body>
    <?php require __DIR__ . '/../controller/header.php'; ?>
    <div id="cos">
        <h1>Formulari de Registre</h1>
        <form action="/model/valida_registrar.php" class=cos method="POST">

            <label for="nom">Nom <span class="required">*</span></label>
            <input type="text" id="nom" name="nom" maxlength="30" required pattern="[A-Za-zÀ-ÿ\s]+" title="Només caràcters i espais">

            <label for="correu">Adreça de correu electrònic <span class="required">*</span></label>
            <input type="email" id="correu" name="correu" required>

            <label for="password">Password <span class="required">*</span></label>
            <input type="password" id="password" name="password" required pattern="[A-Za-z0-9]+" title="Camp alfanumèric">

            <label for="adreca">Adreça</label>
            <input type="text" id="adreca" name="adreca" maxlength="30">

            <label for="poblacio">Població</label>
            <input type="text" id="poblacio" name="poblacio" maxlength="30">

            <label for="codi_postal">Codi Postal <span class="required">*</span></label>
            <input type="text" id="codi_postal" name="codi_postal" required pattern="^\d{5}$" title="Ha de contenir exactament 5 dígits">

            <button type="submit">Registrar-se</button>
        </form>
    </div>
    <?php require __DIR__ . '/../controller/footer.php'; ?>
</body>

</html>