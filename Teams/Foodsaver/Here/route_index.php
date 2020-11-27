<?php
session_start();
?>


<!DOCTYPE html>
<html>

<head>
  <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=yes">
  <meta http-equiv="Content-type" content="text/html;charset=UTF-8">
  <!--title>Map with Driving Route from A to B</title-->
  <title>Foodsaver - Too Good to Waste</title>
  <link rel="stylesheet" type="text/css" href="https://js.api.here.com/v3/3.1/mapsjs-ui.css" />
  <link rel="stylesheet" type="text/css" href="demo.css" />
  <link rel="stylesheet" type="text/css" href="here.css" />
  <link href="../Metadaten/design.css" rel="stylesheet">
  <script type="text/javascript" src="https://js.api.here.com/v3/3.1/mapsjs-core.js"></script>
  <script type="text/javascript" src="https://js.api.here.com/v3/3.1/mapsjs-service.js"></script>
  <script type="text/javascript" src="https://js.api.here.com/v3/3.1/mapsjs-ui.js"></script>
  <script type="text/javascript" src="https://js.api.here.com/v3/3.1/mapsjs-mapevents.js"></script>
  <style type="text/css">
    .directions li span.arrow {
      display: inline-block;
      min-width: 28px;
      min-height: 28px;
      background-position: 0px;
      background-image: url("https://heremaps.github.io/maps-api-for-javascript-examples/map-with-route-from-a-to-b/img/arrows.png");
      position: relative;
      top: 8px;
    }

    .directions li span.depart {
      background-position: -28px;
    }

    .directions li span.rightturn {
      background-position: -224px;
    }

    .directions li span.leftturn {
      background-position: -252px;
    }

    .directions li span.arrive {
      background-position: -1288px;
    }
  </style>
  <script type="text/javascript">
    window.ENV_VARIABLE = 'https://foodsaver.bplaced.net'
  </script>
  <script src='https://developer.here.com/javascript/src/iframeheight.js'></script>
  <link rel="icon" href="../Pictures/Logo_Bild.png" />
</head>

<body id="markers-on-the-map">

  <?php
  require("chooseHeader_map.php");

  ?>



  <?php
  if ($_GET['mode'] == 'vehicel') {
    echo ('<div class="page-header">
          <h1>Karte mit der Fahrroute</h1>
          <p>So kommst Du von dir aus mit dem Auto zur angegebenen Adresse des Verkäufers</p>
      </div>');

    if ($_GET['mode'] == 'vehicel' and $_GET['loc'] == 'profile') {
      echo ('<a id="aktueller_standort" href="route_index.php?mode=vehicel&loc=gps">> Aktuellen Standort verwenden</br></a>');
    } elseif ($_GET['mode'] == 'vehicel' and $_GET['loc'] == 'gps') {
      echo ('<a id="aktueller_standort" href="route_index.php?mode=vehicel&loc=profile">> Addresse aus Benutzerkonto verwenden</br></a>');
    }
    echo ('<a id="aktueller_standort" href="route_index.php?mode=walk&loc=' . $_GET['loc'] . '">> Route zu Fuß berechnen</br></a>');

    echo ('<div id="map"></div>
      <div id="panel"></div>');

    require('route.php');
  } elseif ($_GET['mode'] == 'walk') {
    echo ('<div class="page-header">
          <h1>Karte mit der Route</h1>
          <p>So kommst Du von dir aus zu Fuß zur angegebenen Adresse des Verkäufers</p>
      </div>');

    if ($_GET['mode'] == 'walk' and $_GET['loc'] == 'profile') {
      echo ('<a id="aktueller_standort" href="route_index.php?mode=walk&loc=gps">> Aktuellen Standort verwenden</br></a>');
    } elseif ($_GET['mode'] == 'walk' and $_GET['loc'] == 'gps') {
      echo ('<a id="aktueller_standort" href="route_index.php?mode=walk&loc=profile">> Addresse aus Benutzerkonto verwenden</br></a>');
    }
    echo ('<a id="aktueller_standort" href="route_index.php?mode=vehicel&loc=' . $_GET['loc'] . '">> Route mit Auto berechnen</br></a>');
    echo ('<div id="map"></div>
      <div id="panel"></div>');

    require('route_walk.php');
  }
  require("footer_map.php");
  if (isset($_SESSION['session_user'])) {
    echo ('<script src="../autologout.js" type="text/javascript"></script>');
  }
  ?>


</body>

</html>