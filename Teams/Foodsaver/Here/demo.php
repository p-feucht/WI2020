<?php
  session_start();
?>

<!DOCTYPE html>
<html>
  <head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=yes">
    <meta http-equiv="Content-type" content="text/html;charset=UTF-8">
    <title>Search for a Location given a Structured Address</title>
    <link rel="stylesheet" type="text/css" href="https://js.api.here.com/v3/3.1/mapsjs-ui.css" />
    <link rel="stylesheet" type="text/css" href="demo.css" />
    <link href="../Metadaten/design.css" rel="stylesheet">
    <script type="text/javascript" src="https://js.api.here.com/v3/3.1/mapsjs-core.js"></script>
    <script type="text/javascript" src="https://js.api.here.com/v3/3.1/mapsjs-service.js"></script>
    <script type="text/javascript" src="https://js.api.here.com/v3/3.1/mapsjs-ui.js"></script>
    <script type="text/javascript" src="https://js.api.here.com/v3/3.1/mapsjs-mapevents.js"></script>
  <script type="text/javascript" >window.ENV_VARIABLE = 'https://foodsaver.bplaced.net'</script><script src='https://developer.here.com/javascript/src/iframeheight.js'></script></head>
  <body id="geocode">
  <?php
        require("chooseHeader_map.php");
    ?>

    <div class="page-header">
        <h1>Search for a Location given a Structured Address</h1>
        <p>Request a location from a structured address and display it on the map.</p>
        <a href="route_index.php?mode=vehicel&loc=profile">Route berechnen Auto</br></a>
        <a href="route_index.php?mode=walk&loc=profile">Route berechnen zu Fuß</br></a>
    </div>
    
    <div id="map"></div>
    <div id="panel"></div>


      <?php
      require('position.php');
      require('userCords.php');
    
    require("footer_map.php");
    ?>
    

  </body>
</html>