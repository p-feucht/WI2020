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
        <link href="Metadaten/order.css" rel="stylesheet"> 
        <link rel="stylesheet" type="text/css" href="https://js.api.here.com/v3/3.1/mapsjs-ui.css" />
        <link rel="stylesheet" type="text/css" href="Here/demo.css" />
        <script type="text/javascript" src="https://code.jquery.com/jquery-latest.min.js"></script>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js" type="text/javascript"></script>

        <link rel="stylesheet" href="/FancyBox/jquery.fancybox.css" type="text/css" media="screen" />
        <script type="text/javascript" src="/FancyBox/jquery.fancybox.pack.js"></script>
        <script type="text/javascript" src="/FancyBox/jquery.mousewheel.pack.js"></script>
        <link rel="stylesheet" href="/FancyBox/jquery.fancybox-buttons.css" type="text/css" media="screen" />
        <script type="text/javascript" src="/FancyBox/jquery.fancybox-buttons.js"></script>

        <script type="text/javascript" src="https://js.api.here.com/v3/3.1/mapsjs-core.js"></script>
        <script type="text/javascript" src="https://js.api.here.com/v3/3.1/mapsjs-service.js"></script>
        <script type="text/javascript" src="https://js.api.here.com/v3/3.1/mapsjs-ui.js"></script>
        <script type="text/javascript" src="https://js.api.here.com/v3/3.1/mapsjs-mapevents.js"></script>
        <script type="text/javascript" >window.ENV_VARIABLE = 'https://foodsaver.bplaced.net'</script><script src='https://developer.here.com/javascript/src/iframeheight.js'></script>
        


  </head>
    </head>

    <body>
    <?php
    
        $_SESSION['last_page'] = $_SERVER['HTTP_REFERER'];
    
        require("Metadaten/chooseHeader.php");
        require('database/specificRecordDB.php');
        
        if(isset($_SESSION['session_user'])){
        echo('<a href="Here/demo.php" onclick="">Karte Anzeigen</a>');
        require("Here/getCountry_seller.php");
        require("Here/getCountry_user.php");
        }


        if ($_SESSION['session_user'] != $_SESSION['RecordEmail']){
            require('database/checkOrderFood.php');
        }
        require('database/addOrderToDB.php');
        require("database/updateMessagestoNotNew.php");
        require('database/listOrdersRecord.php');

        require("Metadaten/footer.php");
?>
   
    </body>
    </html>

