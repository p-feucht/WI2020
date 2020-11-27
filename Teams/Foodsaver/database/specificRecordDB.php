<?php
session_start();
require('connectDB.php');

// erstellt einen spezifische Anzeige 

$record_id = (int)$_GET['id'];

$db_resArray = mysqli_query($db_link, "SELECT * FROM `tbl_records` WHERE ID = $record_id") or die('Fehler: ' . mysqli_error($db_link));


$id = 1;

$resultCheck = mysqli_num_rows($db_resArray);

$recordEmail = "";
if ($resultCheck > 0) {

    while ($rowArray = mysqli_fetch_array($db_resArray)) {
        $artikel_id = (int)$rowArray["ID"];
    }




    $query = mysqli_query($db_link, "SELECT * FROM `Images` WHERE (ArtikelID = $artikel_id) and (Thumbnail = 0)") or die('Fehler: ' . mysqli_error($db_link));
    $ImageLink = array();

    while ($ImageData = mysqli_fetch_array($query)) {

        $ImageLink[] = $ImageData['imageLink'];
    }

    //Abrufen aller Thumbnails und Bilder zu dieser Anzeige
    $query_tbn = mysqli_query($db_link, "SELECT * FROM `Images` WHERE (ArtikelID = $artikel_id) and (Thumbnail = 1)") or die('Fehler: ' . mysqli_error($db_link));

    $ImageLink_tbn = array();

    while ($ImageData_tbn = mysqli_fetch_array($query_tbn)) {

        $ImageLink_tbn[] = $ImageData_tbn['imageLink'];
    }
    $db_res = mysqli_query($db_link, "SELECT * FROM `tbl_records` WHERE ID = $record_id") or die('Fehler: ' . mysqli_error($db_link));
    // Erstellt Anzeige mit allen Thumbnails als Vorschaubilder und Originalbilder beim vergrößern
    // Fügt Slideshow für Bilder hinzu
    while ($row = mysqli_fetch_array($db_res)) {

        $recordEmail = $row['Email'];


        echo ('<div id="Record_specific">');

        echo ('<table>');
        echo ('<col style="width:50%" span="2" />');
        if ($row['Visable'] == 0) {
            echo ('<tr><td><h1>' . $row['Artikel'] . '</td><td></td></tr></h1>');
        } elseif ($row['Visable'] == 1) {
            echo ('<tr><td><h1>' . $row['Artikel'] . ' - Artikel nicht aktiv!</td><td></td></tr></h1>');
        }
        echo ('<tr id="td-head-' . $id . '" rowSpan="1"<a href="#" ">');
        if (!empty($ImageLink)) {
            echo ('<td id="tdBild"><div class="slideshow-container">');
            foreach ($ImageLink as $key => $value) {
                echo ('<div class="mySlides fade">');
                if ($row['Visable'] == '0') {
                    echo ('<a class="fancybox" rel="gallery" href="' . $value . '"><img src="' . $ImageLink_tbn[$key] . '" id="record_image_specific"></a>');
                } elseif ($row['Visable'] == '1') {
                    echo ('<a class="fancybox" rel="gallery" href="' . $value . '"><img src="' . $ImageLink_tbn[$key] . '" id="record_image_specific"><img src="../uploads/AnzeigeGeloescht.png" id="record_image_oben_specific"></a>');
                }
                echo ('</div>');
            }
            echo ('<div id="image_buttons" style="text-align:center">');
            foreach ($ImageLink as $key => $value) {
                echo ('<span class="dot" onclick="currentSlide(' . $key . ')"></span> ');
            }
            echo ('</div>');
            if (count($ImageLink) > 1) {
                echo ('<a class="prev" onclick="plusSlides(-1)">&#10094;</a>');
                echo ('<a class="next" onclick="plusSlides(1)">&#10095;</a>');
            }

            echo ('</div></td>');
        } else {
            echo ('<td id="tdBild"><div class="slideshow-container">');
            echo ('<div class="mySlides fade">');
            if ($row['Visable'] == '0') {
                echo ('<a class="fancybox" rel="gallery" href="../uploads/Kein_Bild_Standard.jpg"><img src="../uploads/Kein_Bild_Standard.jpg" id="record_image_specific"></a>');
            } elseif ($row['Visable'] == '1') {
                echo ('<a class="fancybox" rel="gallery" href="../uploads/Kein_Bild_Standard.jpg"><img src="../uploads/Kein_Bild_Standard.jpg" id="record_image_specific"><img src="../uploads/AnzeigeGeloescht.png" id="record_image_oben_specific"></a>');
            }
            echo ('</div>');
            echo ('</div></td>');
        }
        if ($_SESSION['session_user'] == $row['Email']) {
            echo ('<td><i><b id="deine_anzeige">Deine Anzeige</b></i></br></br><b>Artikel: </b><a id="article" href="../order_food.php?id=' . $artikel_id . '">' . $row['Artikel'] . '</a></br></br><b>Beschreibung: </b>' . $row['Beschreibung'] . '</td>');
        } else {
            echo ('<td><b>Artikel: </b><a id="article" href="../order_food.php?id=' . $artikel_id . '">' . $row['Artikel'] . '</a></br></br><b>Beschreibung: </b>' . $row['Beschreibung'] . '</td>');
        }
        $datum = $row['Erstellungsdatum'];
        $date = DateTime::createFromFormat('Y-m-d H:i:s', $datum)->format('d.m.Y - H:i');
        $date = $date . ' Uhr';
        echo ('</tr>');
        echo ('<tr id="td-data-' . $id . '1" >');
        echo ('<td><b>Menge: </b>' . $row['Menge'] . ' Stück/Portionen</td>');
        echo ('<td><b>Preis: </b>' . $row['Preis'] . '€</td>');
        echo ('</tr>');
        echo ('<tr id="td-data-' . $id . '2" >');
        echo ('<td><b>Firma: </b>' . $row['Firma'] . '</td>');
        echo ('<td><b>Datum: </b>' . $date . '</td>');
        echo ('</tr>');
        echo ('<tr id="td-data-' . $id . '3" >');
        echo ('<td><b>Username: </b><a id="user" href="../profile.php?userid=' . $row['Username'] . '" >' . $row['Username'] . '</a></td>');
        echo ('<td><b>Name: </b>' . $row['Nachname'] . " " . $row['Vorname'] . '</td>');
        echo ('</tr>');
        echo ('<tr id="td-data-' . $id . '4" >');
        echo ('<td><b>Straße: </b>' . $row['Straße'] . '</td>');
        echo ('<td><b>Hausnummer: </b>' . $row['Hausnummer'] . '</td>');
        echo ('</tr>');
        echo ('<tr id="td-data-' . $id . '5" >');
        echo ('<td><b>PLZ: </b>' . $row['PLZ'] . '</td>');
        echo ('<td><b>Ort: </b>' . $row['Ort'] . '</td>');
        echo ('</tr>');
        echo ('<tr id="td-data-' . $id . '6" >');
        echo ('<td><b>E-mail: </b>' . $row['Email'] . '</td>');
        echo ('<td><b>Telefonnummer: </b>' . $row['Telefonnummer'] . '</td>');
        echo ('</tr>');
        if ((isset($_SESSION['session_user'])) and ($_SESSION['session_user'] != $row['Email'])) {
            echo ('<tr><td><a id="karte_anzeigen" href="Here/demo.php" target="_blank">> Standort auf der Karte anzeigen</a></td><td></td></tr>');
            echo ('<tr><td><a id="Route_anzeigen" href="Here/route_index.php?mode=vehicel&loc=profile" onclick="" target="_blank">> Route berechnen</a></div></td><td></td></tr>');
        }
        echo ('</table>');
        if ($recordEmail == $_SESSION['session_user']) {
            if ($row['Visable'] == 0) {
                echo ('</br><a id="record_bearbeiten" href="editFood.php?id=' . $record_id . '">Anzeige bearbeiten</a>');
                echo ('</br><button id="myBtn">Anzeige löschen</button>');
            } elseif ($row['Visable'] == 1) {
                echo ('</br><a id="record_bearbeiten" href="editFood.php?id=' . $record_id . '">Anzeige erneut aktivieren</a>');
            }
        }
        $id++;
    }
} else {

    echo ('<tr><p>Keine Anzeige gefunden!</p></tr>');
}
$_SESSION['RecordEmail'] = $recordEmail;

// Speichert Adress-Daten des Records für Routenberechnung
if (isset($_SESSION['session_user'])) {
    $query2 = mysqli_query($db_link, "SELECT * FROM `tbl_records` WHERE ID = $record_id") or die('Fehler: ' . mysqli_error($db_link));

    while ($row = mysqli_fetch_array($query2)) {
        $_SESSION['verkäuferLand'] = 'de';
        $_SESSION['verkäuferStadt'] = $row['Ort'];
        $_SESSION['verkäuferStraße'] = $row['Straße'];
        $_SESSION['verkäuferHausnummer'] = $row['Hausnummer'];
        $_SESSION['verkäuferplz'] = $row['PLZ'];
        $_SESSION['artikel_id'] = $record_id;
    }
}

?>

</div>

<!--JavaScript für Slideshow von Bildern-->
<script>
    var slideIndex = 1;
    showSlides(slideIndex);

    function plusSlides(n) {
        clearInterval(myTimer);
        showSlides(slideIndex += n);
    }

    function plusSlidesAuto(n) {
        clearInterval(myTimer);
        showSlides(slideIndex = n);
    }

    function currentSlide(n) {
        clearInterval(myTimer);
        showSlides(slideIndex = n + 1);
    }

    function showSlides(n) {
        var i;
        var slides = document.getElementsByClassName("mySlides");
        var dots = document.getElementsByClassName("dot");
        if (n > slides.length) {
            slideIndex = 1;
            n = 1
        }
        if (n < 1) {
            slideIndex = slides.length
        }
        for (i = 0; i < slides.length; i++) {
            slides[i].style.display = "none";
        }
        for (i = 0; i < dots.length; i++) {
            dots[i].className = dots[i].className.replace(" active", "");
        }
        slides[slideIndex - 1].style.display = "block";
        dots[slideIndex - 1].className += " active";

        myTimer = setInterval(function() {
            plusSlidesAuto(n + 1)
        }, 4000);

    }

    //Fancybox zur Anzeige von Originalbildern
    $(document).ready(function() {
        $(".fancybox").fancybox({
            padding: 2

        });


    });
</script>