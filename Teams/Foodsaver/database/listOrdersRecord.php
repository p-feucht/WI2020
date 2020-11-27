<?php
session_start();
require('connectDB.php');
$record_id = (int)$_GET['id'];
$userEmail = $_SESSION['session_user'];
$hasorder = false;
$headercreated = false;
$_SESSION['last_page'] = $_SERVER['HTTP_REFERER'];

//Unetscheidung der Datenbankabfrage für Käufer und Verkäufer(Wenn er keine bestimmte Bestellung ausgewählt hat)
if (isset($_GET['user'])) {
    $customer = $_GET['user'];
    $query = mysqli_query($db_link, "SELECT * FROM `Bestellungsanfragen` WHERE Record_ID = $record_id AND Username = '$customer' ORDER BY Bestelldatum DESC") or die('Fehler: ' . mysqli_error($db_link));
} else {
    $query = mysqli_query($db_link, "SELECT * FROM `Bestellungsanfragen` WHERE Record_ID = $record_id ORDER BY Bestelldatum DESC") or die('Fehler: ' . mysqli_error($db_link));
}

//Auflisten aller Bestellungen
$resultCheck = mysqli_num_rows($query);
echo ('<div id="Record">');
if ($resultCheck > 0) {
    while ($row = mysqli_fetch_array($query)) {

        $sql = mysqli_query($db_link, "SELECT * FROM `tbl_records` WHERE ID = $record_id") or die('Fehler: ' . mysqli_error($db_link));
        $row2 = mysqli_fetch_array($sql);

        if ($row['Verkäufer'] == $userEmail) {     #Du hast den Record erstellt        
            if ($headercreated == false) {
                echo ('<h1>Diese Anzeige haben Sie erstellt!</h1>
            <h2>Alle Bestellungen:</h2>');
                echo ("<table id='header_messages'><tr id='header_messages_row'>
            <td style='width: 20%'><b>Käufer</td><td style='width: 10%'><b>Anzahl</td>
            <td style='width: 30%'><b>Nachricht</td><td style='width: 20%'><b>Bestelldatum</td><td></td></tr></table>");
                $headercreated = true;
            }
            $date = $row['Bestelldatum'];
            $datum = DateTime::createFromFormat('Y-m-d H:i:s', $date)->format('d.m.Y - H:i');
            echo ('<table>');
            echo ('<tr>');
            echo ('<td style="width: 20%"><a id="username" href="../profile.php?userid=' . $row['Username'] . '" >' . $row['Username'] . '</a></td>');
            echo ('<td style="width: 10%">' . $row['Menge'] . '</td>');
            echo ('<td style="width: 30%">' . $row['Anmerkung'] . '</td>');
            echo ('<td style="width: 20%">' . $datum . ' Uhr</td>');
            $user = $row['Username'];
            if (isset($_GET['id']) and isset($_GET['user'])) {
                echo "<td style='width: 20%'></td>";
            } else {
                echo ('<td style="width: 20%"><a class="zur_bestellung" href="../order_food.php?id=' . $record_id . '&user=' . $user . '">Zur Bestellung</a></td>');
            }
            echo ('</tr>');
            echo ('</table>');
            $hasorder = true;
        } elseif ($row['Email'] == $userEmail) {    #Du hast bestellt
            if ($headercreated == false) {
                echo ("<h1>Sie haben diesen Artikel gekauft!</h1>
            <h2>Ihre Bestellungen:</h2>");
                echo ("<table id='header_messages'><tr id='header_messages_row'>
            <td style='width: 20%'><b>Anzahl</td><td style='width: 50%'><b>Nachricht</td>
            <td style='width: 30%'><b>Bestelldatum</td><td></td></tr></table>");
                $headercreated = true;
            }
            $date = $row['Bestelldatum'];
            $datum = DateTime::createFromFormat('Y-m-d H:i:s', $date)->format('d.m.Y - H:i');
            echo ('<table>');
            echo ('<tr>');
            echo ('<td style="width: 20%">' . $row['Menge'] . '</td>');
            echo ('<td style="width: 50%">' . $row['Anmerkung'] . '</td>');
            echo ('<td style="width: 30%">' . $datum . ' Uhr</td>');
            echo ('</tr>');
            echo ('</table>');
            $bestellEmail = $row['Email'];
            $hasorder = true;
        }
    }
}
if ($hasorder == false) {
    $sql3 = mysqli_query($db_link, "SELECT * FROM `tbl_records` WHERE ID = $record_id") or die('Fehler: ' . mysqli_error($db_link));
    $row3 = mysqli_fetch_array($sql3);
    $verkäuferEmail = $row3['Email'];

    if ($row3['Email'] == $userEmail) {     #Du hast den Record erstellt        
        echo ('<h1>Diese Anzeige haben Sie erstellt!</h1>
        <h2>Keine Bestellungen gefunden!</h2>');
        $headercreated = true;
    } else {
        echo ('<h1>Keine Bestellungen gefunden!</h1>');
        $headercreated = true;
    }
}

echo ('</div>');


//Prüfen ob ein Chatfenster gezeigt werden soll oder nur alle Nachtichten des Records aufgelistet werden soll
if ((isset($_GET['user'])) or ($bestellEmail == $userEmail) or (($hasorder == false) and ($userEmail != $verkäuferEmail))) {

    require('listMessagesForRecord.php');
} else {
    require('listMyMessages.php');
}
