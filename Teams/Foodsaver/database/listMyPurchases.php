<?php
session_start();
require('connectDB.php');
$username = $_SESSION['session_username'];

//Festlegen wie viele Käufe geslistet werden sollen
if (isset($_GET['limit'])) {
    $limit = $_GET['limit'];
} else {
    $limit = 10;
}
$query = mysqli_query($db_link, "SELECT * FROM `Bestellungsanfragen` WHERE Username = '$username' order by Bestelldatum desc Limit $limit") or die('Fehler: ' . mysqli_error($db_link));
$countselect = mysqli_query($db_link, "SELECT * FROM `Bestellungsanfragen` WHERE Username = '$username'") or die('Fehler: ' . mysqli_error($db_link));
$resultCheck = mysqli_num_rows($query);

//Auflisten der Käufe
echo ('<div id="Record">');
echo ('<h1>Meine Käufe</h1>');
if ($resultCheck > 0) {
    while ($row = mysqli_fetch_array($query)) {
        $record_id = $row['Record_ID'];
        $sql = mysqli_query($db_link, "SELECT * FROM `tbl_records` WHERE ID='$record_id'") or die('Fehler: ' . mysqli_error($db_link));
        $row2 = mysqli_fetch_array($sql);
        $datum = $row['Bestelldatum'];
        $date = DateTime::createFromFormat('Y-m-d H:i:s', $datum)->format('d.m.Y - H:i');
        $date = $date . ' Uhr';

        $user = $row['Username'];
        echo ('<table>');
        echo ('<tr>');
        echo ('<td><b>Artikel: </b>' . $row2['Artikel'] . '</td>');
        echo ('<td><b>Käufer: </b>' . $row['Username'] . '</td>');
        echo ('<td><b>Bestelldatum: </b>' . $date . '</td>');
        echo ('<td><b>Anzahl: </b>' . $row['Menge'] . '</td>');
        echo ('</tr>');
        echo ('<tr><td><b>Anmerkung: </b>' . $row['Anmerkung'] . '</td><td></td><td></td><td><a class="zur_bestellung" href="../order_food.php?id=' . $record_id . '">Zur Bestellung</a></td></tr>');
        echo ('</table>');
    }
} else {
    echo ('<h2>Es wurden keine Käufe gefunden!</h2>');
}
//Anzahl der Aufgelisteten Käufe + 10 in die Url schreiben (Wie viele Käufe werden beim nächsten 'mehr Anzeigen' gelistet)
if (mysqli_num_rows($countselect) > $limit) {
    $limit2 = $limit + 10;
    echo ('<a class="mehr_artikel" href="../purchases.php?limit=' . $limit2 . '&sd=1">Weitere Artikel Anzeigen</a>');
}
echo ('</div>');
