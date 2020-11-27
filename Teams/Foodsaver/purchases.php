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
    <link href="Metadaten/purchases.css" rel="stylesheet">
    <link rel="icon" href="Pictures/Logo_Bild.png" />
</head>

<body>
    <?php

    $_SESSION['last_page'] = $_SERVER['HTTP_REFERER'];

    require("Metadaten/chooseHeader.php");
    //Auflisten aller Käufe der Users
    require("database/listMyPurchases.php");
    require("Metadaten/footer.php");
    if (isset($_GET['sd'])) {
        echo ('<script>window.scrollTo(0,document.body.scrollHeight);</script>');
    }
    if (isset($_SESSION['session_user'])) {
        echo ('<script src="autologout.js" type="text/javascript"></script>');
    }
    ?>
</body>

</html>