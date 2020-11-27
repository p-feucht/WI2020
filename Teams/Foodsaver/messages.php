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
    <link href="Metadaten/messages.css" rel="stylesheet">
    <link rel="icon" href="Pictures/Logo_Bild.png" />
</head>

<body>
    <?php

    $_SESSION['last_page'] = $_SERVER['HTTP_REFERER'];

    require("Metadaten/chooseHeader.php");
    echo ('<div id="messages">');
    //Gesendet und Empfangen Button
    if (isset($_GET['gesendet'])) {
        echo ('<div id="asideMessages"><a id="messageEmpfangen" href="messages.php">> Empfangene Nachrichten</a></div>');
    } else {
        echo ('<div id="asideMessages"><a id="messageGesendet" href="messages.php?gesendet=1">> Gesendete Nachrichten</a></div>');
    }
    //Auflisten der Nachrichten
    require("database/listMyMessages.php");
    echo ('</div>');
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