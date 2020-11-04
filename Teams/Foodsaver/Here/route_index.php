<?php
session_start();
?>


<!DOCTYPE html>
<html>
  <head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=yes">
    <meta http-equiv="Content-type" content="text/html;charset=UTF-8">
    <title>Map with Driving Route from A to B</title>
    <link rel="stylesheet" type="text/css" href="https://js.api.here.com/v3/3.1/mapsjs-ui.css" />
    <link rel="stylesheet" type="text/css" href="demo.css" />    
    <link href="../Metadaten/design.css" rel="stylesheet">
    <script type="text/javascript" src="https://js.api.here.com/v3/3.1/mapsjs-core.js"></script>
    <script type="text/javascript" src="https://js.api.here.com/v3/3.1/mapsjs-service.js"></script>
    <script type="text/javascript" src="https://js.api.here.com/v3/3.1/mapsjs-ui.js"></script>
    <script type="text/javascript" src="https://js.api.here.com/v3/3.1/mapsjs-mapevents.js"></script>
    <style type="text/css">
      .directions li span.arrow {
        display:inline-block;
        min-width:28px;
        min-height:28px;
        background-position:0px;
        background-image: url("https://heremaps.github.io/maps-api-for-javascript-examples/map-with-route-from-a-to-b/img/arrows.png");
        position:relative;
        top:8px;
      }
      .directions li span.depart  {
        background-position:-28px;
      }
      .directions li span.rightturn  {
        background-position:-224px;
      }
      .directions li span.leftturn{
        background-position:-252px;
      }
      .directions li span.arrive  {
        background-position:-1288px;
      }
      </style>
  <script type="text/javascript" >window.ENV_VARIABLE = 'https://foodsaver.bplaced.net'</script><script src='https://developer.here.com/javascript/src/iframeheight.js'></script></head>
  <body id="markers-on-the-map">

  <?php
        require("chooseHeader_map.php");
    
        if($_GET['mode'] == 'vehicel'){
          echo('<a href="route_index.php?mode=vehicel&loc=gps">Aktuellen Standort verwenden</br></a>');
        }
        elseif($_GET['mode'] == 'walk'){
          echo('<a href="route_index.php?mode=walk&loc=gps">Aktuellen Standort verwenden</br></a>');
        }
  ?>
    


  <?php
        if($_GET['mode'] == 'vehicel'){
         echo('<div class="page-header">
          <h1>Map with Driving Route from A to B</h1>
          <p>Request a driving route from A to B and display it on the map</p>
      </div>
      
      <div id="map"></div>
      <div id="panel"></div>');
        
      require('route.php');
        }
        elseif($_GET['mode'] == 'walk'){
          echo('<div class="page-header">
          <h1>Map with Walking Route from A to B</h1>
          <p>Request a walking route from A to B and display it on the map</p>
      </div>
      
      <div id="map"></div>
      <div id="panel"></div>');
        
          require('route_walk.php');
        }
        require("footer_map.php");
  ?>

  
  </body>
</html>

