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

    <!-- autocomplete from google maps -->
    <link rel="stylesheet" type="text/css" href="CSS/locationSearchDesign.css" />
    <script src="JavaScript/locationSearch.js"></script>

    <!-- pop up window for booking -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>

    <!-- sheets for general page and other --> 
    <link href="CSS/categoriesDesign.css" rel="stylesheet">
    <link href="JavaScript/categoriesFunctions.js">
    <link rel="stylesheet" href="CSS/bookingWindowDesign.css">

</head>

<body onload="openTab()">
    <!-- activate Tab opening -->

    <?php include "PHP/header.php"; ?>


    <div class="yellow-banner"></div>

    <script src="JavaScript/categoriesFunctions.js"></script>
    <button class="tablink" id="Werkzeug-Ang" onclick="openPage('Werkzeug', this)">Werkzeug</button>
    <button class="tablink" id="Werkstatt-Ang" onclick="openPage('Werkstatt', this)">Werkstatt</button>
    <button class="tablink" id="Dienst-Ang" onclick="openPage('Dienst', this)">Dienstleistung</button>

    <div id="Werkzeug" class="tabcontent">


        <!-- The search field -->
        <form class="search" onsubmit="filterWerkzeug()">

            <input type="text" id="free-text" placeholder="Was suchst du?">
            <script src="JavaScript/locationSearch.js"></script>
            <input id="autocomplete" class="controls" type="text" placeholder="Wo brauchst du es?" />
            <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDUrJoGLdsBz5xPFlFs-RiG2TPTnELEfOk&libraries=places&callback=initAutocomplete"></script>
            <div class="icon"><i class="fa fa-calendar fa-2x" aria-hidden="true"></i></div>
            <input type="text" id="date-werkzeug" name="datefilter-werkzeug" value="" placeholder="Wann passt es dir am besten?" />
            <script type="text/javascript" src="JavaScript/datepicker.js">
                datePickerWerkzeug();
                </script>
            <script src="JavaScript/filter.js"></script>
            <button type="submit" ><i class="fa fa-search"></i></button>

        </form>

        <?php include "PHP/getOffers.php"; ?>

    </div>

    <div id="Werkstatt" class="tabcontent">
        <h3>News</h3>
        <p>Some news this fine day!</p>
    </div>

    <div id="Dienst" class="tabcontent">
        <h3>Contact</h3>
        <p>Get in touch, or swing by for a cup of coffee.</p>
    </div>

    <?php include "PHP/footer.php"; ?>

</body>

</html>