<?php @session_start(); ?>

<!doctype html>
<html class="no-js" lang="">

<head>
    <meta charset="utf-8">
    <link rel="icon" href="images/logoBiene.png" />
    <title>Worker Bees</title>
    <meta name="description" content="">

    <!-- Load icon library -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

    <!-- date picker links (https://www.daterangepicker.com/)-->
    <script type="text/javascript" src="https://cdn.jsdelivr.net/jquery/latest/jquery.min.js"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
    <link rel="stylesheet" type="text/css" href="CSS/daterangepicker.css" />
    <link href="CSS/datepicker.css" rel="stylesheet">
    <link href="JavaScript/datepicker.js">

    <!-- pop up window for booking -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>

    <!-- sheets for general page and other --> 
    <link href="CSS/categoriesDesign.css" rel="stylesheet">
    <link href="JavaScript/categoriesFunctions.js">
    <link href="JavaScript/filter.js">
    <link rel="stylesheet" href="CSS/bookingWindowDesign.css">

</head>

<body onload="openTab()"> <!-- activate Tab opening -->

    <?php include "PHP/header.php"; ?>


    <div class="yellow-banner"></div>

    <script src="JavaScript/categoriesFunctions.js"></script>
    <button class="tablink" id="Werkzeug-Ang" onclick="openPage('Werkzeug', this)">Werkzeug</button>
    <button class="tablink" id="Werkstatt-Ang" onclick="openPage('Werkstatt', this)">Werkstatt</button>
    <button class="tablink" id="Dienst-Ang" onclick="openPage('Dienst', this)">Dienstleistung</button>

    <div id="Werkzeug" class="tabcontent">

        <?php include "PHP/searchField.php"; ?>
        <?php include "PHP/werkzeugOffers.php"; ?>

    </div>

    <div id="Werkstatt" class="tabcontent">
        
        <?php include "PHP/searchField.php"; ?>
        <?php include "PHP/werkstattOffers.php"; ?>

    </div>

    <div id="Dienst" class="tabcontent">
        
        <?php include "PHP/searchField.php"; ?>
        <?php include "PHP/dienstOffers.php"; ?>

    </div>

    <?php include "PHP/footer.php"; ?>

</body>

</html>