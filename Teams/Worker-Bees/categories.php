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
        <form class="search" action="">

            <input type="text" id="free-text" placeholder="Was suchst du?">
            <script src="JavaScript/locationSearch.js"></script>
            <input id="autocomplete" class="controls" type="text" placeholder="Wo brauchst du es?" />
            <script defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDUrJoGLdsBz5xPFlFs-RiG2TPTnELEfOk&libraries=places&callback=initAutocomplete"></script>
            <div class="icon"><i class="fa fa-calendar fa-2x" aria-hidden="true"></i></div>
            <input type="text" name="datefilter" value="" placeholder="Wann passt es dir am besten?" />
            <script type="text/javascript" src="JavaScript/categoriesFunctions.js">
                datePicker();
                </script>
            <button type="submit"><i class="fa fa-search"></i></button>

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

    <!-- Pop up window with detailed information and booking option -->
    <div id="myModal" class="modal fade" role="dialog">
        <div class="modal-dialog modal-lg">

            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <img class="headerLogo" src="images/logoKomplett.png">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body">
                    <h3 class="modal-offerName">Bester Schraubenschlüssel in Town.</h3>
                    <p class="modal-namelocation">katomato95
                        <img src="images/place-icon.svg" class="place-icon" alt="location">Genaue Adresse
                        <!--has to be the exact location here!-->
                    </p>

                    <div class="modal-content-split">
                        <p class="offer-description">
                            This is the best Schraubenschlüssel you have ever seen. Come to my dark garage to pick it up.
                            Do not come between 1 and 2 pm because that's when I feed my dog and watch it eat.
                            You can keep the Schraubenschlüssel as long as you want, but I dare you to bring it back broken.
                            Have a nice day,
                            Klaus
                        </p>
                        <ul class="modal-amenities">
                            <!--only for Werkstat!!-->
                            <li>Standbohrmaschine</li>
                            <li>elektrische Standsägen</li>
                        </ul>
                    </div>
                    <div class="modal-content-split">
                        <img src="images/Werkzeug.jpg" class="modal-image" alt="Angebot">
                    </div>

                    <form class="modal-booking-window">
                        <h3 class="modal-booking-heading">Nur noch ein Schritt!</h3>
                        
                        <p class="modal-booking-text">Gesamtbetrag: 1000 €<br>
                            <input type="checkbox" name="bierZahlung">
                            <label for="bierZahlung"> Ich möchte in Bier bezahlen (1000 Bier)</label><br>
                        </p>

                        <button type="button" class="submitBooking">Jetzt buchen</button>
                    </form>



                </div>
                <div class="modal-footer"></div>
            </div>

        </div>
    </div>

    <?php include "PHP/footer.php"; ?>

</body>

</html>