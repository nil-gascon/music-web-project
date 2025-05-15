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
        <?php require __DIR__ . '/../controller/llistar_categories.php'; ?>
    </div>
    <?php require __DIR__ . '/../controller/footer.php'; ?>
</body>

</html>