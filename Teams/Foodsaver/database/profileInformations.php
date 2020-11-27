<?php
session_start();
require('connectDB.php');

// Fragt Profildaten aus DB ab und erstellt die Informationen zum Profil

$userEmail = $_GET['userid'];
$_SESSION['last_page'] = $_SERVER['HTTP_REFERER'];

$query = mysqli_query($db_link, "SELECT * FROM `tbl_contacts` WHERE Benutzername = '$userEmail'") or die('Fehler: ' . mysqli_error($db_link));

while ($ImageData = mysqli_fetch_array($query)) {

    $ImageLink = $ImageData['pictureLink'];
}

$db_res = mysqli_query($db_link, "SELECT * FROM `tbl_contacts` WHERE Benutzername = '$userEmail'") or die('Fehler: ' . mysqli_error($db_link));

$resultCheck = mysqli_num_rows($db_res);
// Profilinformationen erstellen und Profilbild einbinden
if ($resultCheck > 0) {
    while ($row = mysqli_fetch_array($db_res)) {

        if ($userEmail == $_SESSION['session_username']) {
            echo ("<div id='Profile'>
                <h1 id='profile_headline'>Dein Profil</h1>");
        } else {
            echo ("<div id='Profile'>
                <h1 id='profile_headline'>Benutzerprofil von $userEmail</h1>");
        }
        echo ('<div id="Record"><h2>' . $row['Nachname'] . " " . $row['Vorname'] . '</h2>');

        echo ('<table>');

        echo ('<tr id="td-head-' . $id . '" rowSpan="1"<a href="#" onclick="toggle(6, ' . $id . ')">');
        if ((isset($ImageLink)) and ($ImageLink != Null)) {

            echo ('<td><a class="fancybox" rel="gallery" href="' . $ImageLink . '"><img src="' . $ImageLink . '" id="profile_image"></a></td>');
            echo ('<td></td>');
        } else {
            echo ('<td></td>');
            echo ('<td></td>');
        }
        $datum = $row['Erstellungsdatum'];
        $date = DateTime::createFromFormat('Y-m-d H:i:s', $datum)->format('d.m.Y - H:i');
        $date = $date . ' Uhr';
        echo ('</tr>');
        echo ('<tr id="td-data-' . $id . '2" >');
        echo ('<td><b>Username: </b>' . $row['Benutzername'] . '</td>');
        echo ('<td><b>Name: </b>' . $row['Nachname'] . " " . $row['Vorname'] . '</td>');
        echo ('</tr>');
        echo ('<tr id="td-data-' . $id . '3" >');
        echo ('<td><b>Firma: </b>' . $row['Firma'] . '</td>');
        echo ('<td><b>Erstellungsdatum: </b>' . $date . '</td>');
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
        // Wenn User angemeldet und auf fremden Profil, Links zur Routenberechnung anzeigen
        if ((isset($_SESSION['session_user'])) and ($_SESSION['session_user'] != $row['Email'])) {
            echo ('<tr><td><a id="karte_anzeigen" href="Here/demo.php" target="_blank">> Standort auf der Karte anzeigen</a></td><td></td></tr>');
            echo ('<tr><td><a id="Route_anzeigen" href="Here/route_index.php?mode=vehicel&loc=profile" onclick="" target="_blank">> Route berechnen</a></td><td></td></tr>');
        }
        echo ('</table>');
        // Wenn eigenes Profil, Profil bearbeiten und löschen anzeigen
        if ($userEmail == $_SESSION['session_username']) {
            echo ('</br><a id="profil_bearbeiten" href="editProfile.php?edit=' . $userEmail . '">Profil bearbeiten</a>');
            echo ('</br><button id="myBtn">Profil löschen</button>');
        }
        $id++;
    }
} else {
    echo ('<p>Keine Anzeigen gefunden!</p>');
}

echo ('</div></div>');

if (isset($_SESSION['session_user'])) {
    $query2 = mysqli_query($db_link, "SELECT * FROM `tbl_contacts` WHERE Benutzername = '$userEmail'") or die('Fehler: ' . mysqli_error($db_link));
    // Verkäufer-Adresse in Session speichern für Routenberechnung
    while ($row = mysqli_fetch_array($query2)) {
        $_SESSION['verkäuferLand'] = 'de';
        $_SESSION['verkäuferStadt'] = $row['Ort'];
        $_SESSION['verkäuferStraße'] = $row['Straße'];
        $_SESSION['verkäuferHausnummer'] = $row['Hausnummer'];
        $_SESSION['verkäuferplz'] = $row['PLZ'];
    }
}

if ($userEmail != $_SESSION['session_username']) {
    require('listMessagesForRecord.php');
}
