<?php
session_start();
?>

<!doctype html>

<html lang="de">
    
    <head>
        <meta charset="UTF-8">
        <title>Too Good to Waste</title>
        <meta name="description" content="Webseite zur Vermeidung von Lebensmittelverschwendung">
        <link href="Metadaten/design.css" rel="stylesheet">

    </head>

    <body>
    <?php
    
        $_SESSION['last_page'] = $_SERVER['HTTP_REFERER'];
    
        require("Metadaten/chooseHeader.php");
        require("database/profileInformations.php");
        require("Metadaten/footer.php");
    ?>
    </body>
    </html>