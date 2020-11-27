<?php
session_start();
?>

<!doctype html>

<html lang="de">

<head>
    <meta charset="UTF-8">
    <title>Foodsaver - Too Good to Waste</title>
    <meta name="description" content="Webseite zur Vermeidung von Lebensmittelverschwendung">
    <link href="Metadaten/design.css" rel="stylesheet">
    <link href="Metadaten/sales.css" rel="stylesheet">
    <link rel="icon" href="Pictures/Logo_Bild.png" />
</head>

<body>
    <?php
    $_SESSION['last_page'] = $_SERVER['HTTP_REFERER'];

    require("Metadaten/chooseHeader.php");
    //Auflisten aller Verkäufe des Users
    require("database/listMySales.php");
    require("Metadaten/footer.php");
    if (isset($_SESSION['session_user'])) {
        echo ('<script src="autologout.js" type="text/javascript"></script>');
    }
    if (isset($_SESSION['session_user'])) {
        echo ('<script src="autologout.js" type="text/javascript"></script>');
    }
    ?>
</body>

</html>