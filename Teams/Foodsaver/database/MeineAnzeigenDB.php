<?php
//Auflisten aller Nachrichten die vom Session User erstellt wurden
$userEmail = $_SESSION['session_user'];

require('connectDB.php');
// Eigene Records abfragen und nach Aktiv und Gelöscht sortieren
$sql = "SELECT * FROM tbl_records WHERE Email = '$userEmail' ORDER BY Visable, Erstellungsdatum DESC";
$result = mysqli_query($db_link, $sql);

$id = 1;

$resultCheck = mysqli_num_rows($result);
echo ("<div id='MeineRecords'>
                <h1>Meine Records</h1>");
if ($resultCheck > 0) {
    echo ("<p>Anzahl an Records: $resultCheck</p>");
    $NotVisableKontent = '';
    while ($row = mysqli_fetch_array($result)) {

        $artikel_id = (int)$row["ID"];

        // Originalbild und Thumbnail laden
        $query = mysqli_query($db_link, "SELECT * FROM `Images` WHERE (ArtikelID = $artikel_id) and (Thumbnail = 0)") or die('Fehler: ' . mysqli_error($db_link));
        $query_tbn = mysqli_query($db_link, "SELECT * FROM `Images` WHERE (ArtikelID = $artikel_id) and (Thumbnail = 1)") or die('Fehler: ' . mysqli_error($db_link));

        $ImageData = mysqli_fetch_array($query);
        $ImageData_tbn = mysqli_fetch_array($query_tbn);

        $ImageLink = $ImageData['imageLink'];
        $ImageLink_tbn = $ImageData_tbn['imageLink'];

        echo ('<table>');
        echo ('<col style="width:50%" span="2" />');
        echo ('<tr class="first_row" id="td-head-' . $id . '" rowSpan="1"<a href="#td-head-' . $id . '" onclick="toggle(6, ' . $id . '); changeText(' . $id . ');">');
        //Wenn Record aktiv, Thumbnail als Anzeigebild verwenden, Originalbild beim klicken, vergrößern anzeigen
        if ($row['Visable'] == 0) {

            if ($ImageLink_tbn != Null) {
                echo ('<td><b><a class="fancybox" rel="gallery" href="' . $ImageLink . '"><img src="' . $ImageLink_tbn . '" id="record_image"></a></td>');
            } elseif ($ImageLink_tbn == Null and $ImageLink != Null) {
                echo ('<td><b><a class="fancybox" rel="gallery" href="' . $ImageLink . '"><img src="' . $ImageLink . '" id="record_image"></a></td>');
            } else {
                echo ('<td><a class="fancybox" rel="gallery" href="../uploads/Kein_Bild_Standard.jpg"><img src="../uploads/Kein_Bild_Standard.jpg" id="record_image"></a></td>');
            }
        }
        //Wenn Record gelöscht, genauso Thumbnail und Originalbild laden, zusätzlich Overlay "Anzeige gelöscht" einfügen
        if ($row['Visable'] == 1) {

            if ($ImageLink_tbn != Null) {
                echo ('<td><b><a class="fancybox" rel="gallery" href="' . $ImageLink . '"><img src="' . $ImageLink_tbn . '" id="record_image"><img src="../uploads/AnzeigeGeloescht.png" id="record_image_oben"></a></td>');
            } elseif ($ImageLink_tbn == Null and $ImageLink != Null) {
                echo ('<td><b><a class="fancybox" rel="gallery" href="' . $ImageLink . '"><img src="' . $ImageLink . '" id="record_image"><img src="../uploads/AnzeigeGeloescht.png" id="record_image_oben"></a></td>');
            } else {
                echo ('<td><a class="fancybox" rel="gallery" href="../uploads/Kein_Bild_Standard.jpg"><img src="../uploads/Kein_Bild_Standard.jpg" id="record_image"><img src="../uploads/AnzeigeGeloescht.png" id="record_image_oben"></a></td>');
            }
        }
        if ($_SESSION['session_user'] == $row['Email']) {
            echo ('<td><i><b id="deine_anzeige">Deine Anzeige</b></i></br><b>Artikel: </b><a id="article" href="../order_food.php?id=' . $artikel_id . '">' . $row['Artikel'] . '</a></br><b>Beschreibung: </b>' . $row['Beschreibung'] . '</td>');
        } else {
            echo ('<td><b>Artikel: </b><a id="article" href="../order_food.php?id=' . $artikel_id . '">' . $row['Artikel'] . '</a></br><b>Beschreibung: </b>' . $row['Beschreibung'] . '</td>');
        }
        // Vollständigen Record erstellen
        $datum = $row['Erstellungsdatum'];
        $date = DateTime::createFromFormat('Y-m-d H:i:s', $datum)->format('d.m.Y - H:i');
        $date = $date . ' Uhr';

        echo ('</tr>');
        echo ('<tr id="td-data-' . $id . '1" style="display:none">');
        echo ('<td><b>Menge: </b>' . $row['Menge'] . ' Stück/Portionen</td>');
        echo ('<td><b>Preis: </b>' . $row['Preis'] . '€</td>');
        echo ('</tr>');
        echo ('<tr id="td-data-' . $id . '2" style="display:none">');
        echo ('<td><b>Firma: </b>' . $row['Firma'] . '</td>');
        echo ('<td><b>Datum: </b>' . $date . '</td>');
        echo ('</tr>');
        echo ('<tr id="td-data-' . $id . '3" style="display:none">');
        echo ('<td><b>Username: </b><a id="username" href="../profile.php?userid=' . $row['Username'] . '" >' . $row['Username'] . '</a></td>');
        echo ('<td><b>Name: </b>' . $row['Nachname'] . " " . $row['Vorname'] . '</td>');
        echo ('</tr>');
        echo ('<tr id="td-data-' . $id . '4" style="display:none">');
        echo ('<td><b>Straße: </b>' . $row['Straße'] . '</td>');
        echo ('<td><b>Hausnummer: </b>' . $row['Hausnummer'] . '</td>');
        echo ('</tr>');
        echo ('<tr id="td-data-' . $id . '5" style="display:none">');
        echo ('<td><b>PLZ: </b>' . $row['PLZ'] . '</td>');
        echo ('<td><b>Ort: </b>' . $row['Ort'] . '</td>');
        echo ('</tr>');
        echo ('<tr id="td-data-' . $id . '6" style="display:none">');
        echo ('<td><b>E-mail: </b>' . $row['Email'] . '</td>');
        echo ('<td><b>Telefonnummer: </b>' . $row['Telefonnummer'] . '</td>');
        echo ('</tr>');
        echo ('</table>');
        echo ('<button class="mehr_details" id="details' . $id . '" onclick="toggle(6, ' . $id . '); changeText(' . $id . ');">Mehr Details</button>');
        if ($row['Visable'] == 1) {
            echo ('<a class="zur_bestellung" href="../editFood.php?id=' . $artikel_id . '">Anzeige erneut aktivieren</a>');
        }
        if ($row['Visable'] == 0) {
            echo ('<a class="zur_bestellung" href="../editFood.php?id=' . $artikel_id . '">Anzeige bearbeiten</a>');
            echo ('<button class="delete_btn" id="myBtn' . $id . '" value="' . $artikel_id . '" onclick="showDeleteFunction(' . $id . ')">Anzeige löschen</button>');
        }
        echo ('<a class="zur_bestellung" href="../order_food.php?id=' . $artikel_id . '">Zur Anzeige</a>');
        $id++;
    }
}
if ($resultCheck == 0) {
    echo ("<h2>Du hast noch keine Anzeigen!</h2>");
}



?>

<script>
    function changeText(id) {
        var element = document.getElementById('details' + id);

        if (element.innerHTML === 'Mehr Details') {
            element.innerHTML = 'Weniger Details';
        } else {
            element.innerHTML = 'Mehr Details';

        }
    }
</script>