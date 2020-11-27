<?php
//Nachrichten im Chatfenster auflisten
session_start();
require('connectDB.php');
$record_id = (int)$_GET['id'];
$userEmail = $_SESSION['session_user'];
$currentUserName = $_SESSION['session_username'];
$user = "";
//Festlegung des Users durch die in der Url festgelegten User bei einer Bestellung.
//Default wird der Session Username verwendet.
if (isset($_GET['user'])) {
    $user = $_GET['user'];
} else {
    $user = $_SESSION['session_username'];
}
//Unterscheidung der Datenbankabfrage für die das Chatfenster über des Profil (userid gesetzt) und über die Bestellungsseite
if (isset($_GET['userid'])) {
    $userid = $_GET['userid'];
    $query = mysqli_query($db_link, "SELECT * FROM `Nachrichten` WHERE (Benutzername = '$currentUserName' AND Empfänger = '$userid') OR (Benutzername = '$userid' AND Empfänger = '$currentUserName')") or die('Fehler: ' . mysqli_error($db_link));
} else {
    $query = mysqli_query($db_link, "SELECT * FROM `Nachrichten` WHERE (RecordID = $record_id) AND (Benutzername = '$user' OR Empfänger = '$user')") or die('Fehler: ' . mysqli_error($db_link));
}
$resultCheck = mysqli_num_rows($query);
//Auflisten aller Nachrichten
echo ("<div id='annotation'>
                <h1>Nachrichten</h1>
                <p>Anzahl an Nachrichten: $resultCheck</p>
                <div id='listmessages' >");
if ($resultCheck > 0) {
    $AlleNachrichten = "";
    while ($row = mysqli_fetch_array($query)) {
        $Nachricht_id = (int)$row["ID"];

        $query2 = mysqli_query($db_link, "SELECT * FROM `Nachrichten` WHERE ID = $Nachricht_id ") or die('Fehler: ' . mysqli_error($db_link));
        $record = mysqli_fetch_array($query2);
        $UserName = $record['Benutzername'];
        $Nachricht = $record['Nachricht'];
        $Menge = $record['Menge'];
        $date = $record['Zeitpunkt'];
        $datum = DateTime::createFromFormat('Y-m-d H:i:s', $date)->format('d.m.Y - H:i');
        $Nachricht3 = "";

        if ($currentUserName == $UserName) {
            $Nachricht3 = "<div id='einzelneNachrichtUser1'><div id='einzelneNachrichtUser'><i><a id='usernameUser' href='../profile.php?userid=" . $UserName . "' >$UserName:</a></i></br>";
            if ($Menge != 0) {
                $Nachricht3 = '' . $Nachricht3 . '<b>Bestellung:</b> Menge ' . $Menge . ' Stück, am ' . $datum . ' Uhr</br>';
            }
            $Nachricht3 = '' . $Nachricht3 . $Nachricht . '</div></div>';
        } else {

            $Nachricht3 = "<div id='einzelneNachrichtNichtUser1'><div id='einzelneNachrichtNichtUser'><i><a id='username' href='../profile.php?userid=" . $UserName . "' >" . $UserName . ":</a></i></br>";
            if ($Menge != 0) {
                $Nachricht3 = '' . $Nachricht3 . '<b>Bestellung:</b> Menge ' . $Menge . ' Stück, am ' . $datum . ' Uhr</br>';
            }
            $Nachricht3 = '' . $Nachricht3 . $Nachricht . '</div></div>';
        }
        $AlleNachrichten = $AlleNachrichten . $Nachricht3;
    }
    $AlleNachrichten = $AlleNachrichten . '</div>';
} else {
    echo ('<p></p><p>Keine Nachrichten gefunden!</p></div>');
}
if ($AlleNachrichten != "") {
    echo ($AlleNachrichten);
}
//hier wird die Nachrichteneingabe verwaltet
require('database/NachrichtenToDB.php');

?>
</div>