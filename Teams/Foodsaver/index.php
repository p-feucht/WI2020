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
    <link href="Metadaten/index.css" rel="stylesheet">

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <script src="RecordsDropdown.js" type="text/javascript"></script>

    <script type="text/javascript" src="https://js.api.here.com/v3/3.1/mapsjs-core.js"></script>
    <script type="text/javascript" src="https://js.api.here.com/v3/3.1/mapsjs-service.js"></script>
    <script type="text/javascript" src="https://js.api.here.com/v3/3.1/mapsjs-ui.js"></script>
    <script type="text/javascript" src="https://js.api.here.com/v3/3.1/mapsjs-mapevents.js"></script>
    <script type="text/javascript">
        window.ENV_VARIABLE = 'https://foodsaver.bplaced.net'
    </script>
    <script src='https://developer.here.com/javascript/src/iframeheight.js'></script>
    <link rel="icon" href="Pictures/Logo_Bild.png" />

</head>

<body>

    <?php
    require("Metadaten/chooseHeader.php");
    if (isset($_SESSION['session_user'])) {
        require("Here/userCords.php");
    }
    //speichert das in Here/CalculateDistances.php berechnete Array, welches die Distanz vom User zu allen Records berechnet
    if (isset($_POST['array_dist'])) {
        $data = $_POST['array_dist'];
        $_SESSION['distances'] = $data;
        for ($a = 0; $a < count($_SESSION['distances']); $a++) {
            $address = explode("; ", $_SESSION['distances'][$a][2]);
            array_push($_SESSION['distances'][$a], $address);
        }
        // Erstellt für die verschiedenen Entfernungs-Filter die entsprechenden Arrays
        $_SESSION['distance_less5'] = array();
        $_SESSION['distance_less15'] = array();
        $_SESSION['distance_less30'] = array();
        $_SESSION['distance_more30'] = array();

        for ($i = 0; $i < count($_SESSION['distances']); $i++) {
            intval($_SESSION['distances'][$i][0]);
            if ($_SESSION['distances'][$i][0] <= 5000) {
                array_push($_SESSION['distance_less5'], $_SESSION['distances'][$i]);
            }
            if ($_SESSION['distances'][$i][0] <= 15000) {
                array_push($_SESSION['distance_less15'], $_SESSION['distances'][$i]);
            }
            if ($_SESSION['distances'][$i][0] <= 30000) {
                array_push($_SESSION['distance_less30'], $_SESSION['distances'][$i]);
            }
        }
    }
    ?>



    <div class="homepage">
        <!--p id="foodsaver">FOODSAVER</p>
        <p id="slogan">Too Good To Waste</p-->
        <img id="image1" src="Pictures/Logo.png" />
    </div>

    <!--div id="homepage_headline">
            <p> Rettet die Lebensmittel! <p>
        </div-->

    <div id="homepage_text">
        <p> Willkommen zu unserer Webseite! </br>
            Hier werden übrig gebliebene Mahlzeiten und Lebensmittel angeboten, die noch vom selben Tag stammen. Dabei werden diese von den verschiedensten Anbietern bereitgestellt: Restaurants in deiner Stadt, die Bäckerei,
            von der du jeden morgen Brötchen holst oder sogar vielleicht die nette Nachbarin neben dir! </br>
            Also schau gern mal durch und bestelle etwas. Dabei sparst du nicht nur Geld, sondern hilfst vor allem auch der Umwelt! </p>
    </div>

    <div class="homepage_main">
        <aside>
            <?php
            $Kategorie = "";
            $Kueche = "";
            $Preis = "";
            $PreisEng = "";
            $Entfernung = "";
            $EntfernungEng = "";
            if (isset($_GET['Kategorie']) && $_GET['Kategorie'] != "") {
                $Kategorie = $_GET['Kategorie'];
                if ($Kategorie == 'Private_Haushalte') {
                    $Kategorie = 'Private Haushalte';
                }
            }
            if (isset($_GET['Kueche']) && $_GET['Kueche'] != "") {
                $Kueche = $_GET['Kueche'];
            }
            if (isset($_GET['Preis']) && $_GET['Preis'] != "") {
                $PreisEng = $_GET['Preis'];
                if ($PreisEng == "under5euros") {
                    $Preis = "unter 5€";
                } else if ($PreisEng == "until10euros") {
                    $Preis = "unter 10€";
                } else if ($PreisEng == "until20euros") {
                    $Preis = "unter 20€";
                }
            }
            if (isset($_GET['Entfernung']) && $_GET['Entfernung'] != "") {
                $EntfernungEng = $_GET['Entfernung'];
                if ($EntfernungEng == "until5km") {
                    $Entfernung = "bis zu 5 km";
                }
                if ($EntfernungEng == "until15km") {
                    $Entfernung = "bis zu 15 km";
                }
                if ($EntfernungEng == "until30km") {
                    $Entfernung = "bis zu 30 km";
                }
            }
            echo '
            <p> Filter <p>

            <form action="Metadaten/Filter.php" method="post">
            <div class="filter_dropdown">
                    <select name="categorie" id="categorie">';
            if ($Kategorie != "") {
                echo "<option value='$Kategorie' selected>$Kategorie</option>";
            } else {
                echo '<option value="" selected>Kategorie</option>';
            }
            echo '<option value="">Keine Auswahl</option>
                        <option value="Bäckerei">Bäckerei</option>
                        <option value="Imbiss">Imbiss</option>
                        <option value="Private_Haushalte">Private Haushalte</option>
                        <option value="Restaurant">Restaurant</option>
                        <option value="Supermarkt">Supermarkt</option>
                        <option value="Sonstige">Sonstige</option>
                    </select>

                    <select name="kitchen" id="kitchen">';
            if ($Kueche != "") {
                echo "<option value='$Kueche' selected>$Kueche</option>";
            } else {
                echo '<option value="" selected>Küche</option>';
            }

            echo '<option value="">Keine Auswahl</option>
                        <option value="Chinesisch">Chinesisch</option>
                        <option value="Französisch">Französisch</option>
                        <option value="Griechisch">Griechisch</option>
                        <option value="Italienisch">Italienisch</option>
                        <option value="Mexikanisch">Mexikanisch</option>
                        <option value="Türkisch">Türkisch</option>
                        <option value="Deutsch">Deutsch</option>
                        <option value="Sonstige">Sonstige</option>
                    </select>

                    <select name="price" id="price">';
            if ($Preis != "") {
                echo "<option value='$PreisEng' selected>$Preis</option>";
            } else {
                echo '<option value="" selected>Preis</option>';
            }
            echo '<option value="">Keine Auswahl</option>
                        <option value="under5euros">unter 5€</option>
                        <option value="until10euros">unter 10€</option>
                        <option value="until20euros">unter 20€</option>
                    </select>';

            if (isset($_SESSION['session_user'])) {

                echo '<select name="distance" id="distance">';
                if ($Entfernung != "") {
                    echo "<option value='$EntfernungEng' selected>$Entfernung</option>";
                } else {
                    echo '<option value="" selected>Entfernung</option>';
                }
                echo '<option value="">Keine Auswahl</option>
                        <option value="until5km">bis zu 5 km</option>
                        <option value="until15km">bis zu 15 km</option>
                        <option value="until30km">bis zu 30 km</option>
                    </select>';
            }
            echo '</div>

            <div class="filter_button">
                <button name="apply_filter" type="submit" id="apply_filter" data-submit="...Sending">Apply Filter</button>
                <button name="reset_filter" type="submit" id="reset_filter" data-submit="...Sending">Reset Filter</button>
            </div>
            </form>
            ';

            ?>
        </aside>

        <main>
            <form id="search-form" action="" method="POST">
                <input type="text" id="myInput" name="myInput" placeholder="Suchst du etwas Bestimmtes?" value="<?php if (isset($_POST["myInput"])) {
                                                                                                                    echo ($_POST["myInput"]);
                                                                                                                } else {
                                                                                                                    echo "";
                                                                                                                } ?>">
                <button id="searchButton" name="searchButton">Suchen</button>
            </form>

            <?php

            require('database/Records_Abfrage.php');
            ?>
        </main>
    </div>

    <?php
    require("Metadaten/footer.php");
    if (isset($_SESSION['session_user'])) {
        echo ('<script src="autologout.js" type="text/javascript"></script>');
    }
    ?>



</body>

</html>