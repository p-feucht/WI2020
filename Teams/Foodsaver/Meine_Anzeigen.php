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
    <script src="RecordsDropdown.js" type="text/javascript"></script>

</head>

<body>
  <?php
    require("Metadaten/chooseHeader.php");
    
  ?>
    <main>
        
            <?php

                require('database/MeineAnzeigenDB.php');

            ?>
            
        </div>
    </main>
    <?php
    require("Metadaten/footer.php");
    ?>
    
</body>

</html>