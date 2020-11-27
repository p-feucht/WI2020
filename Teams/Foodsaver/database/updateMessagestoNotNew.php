<?php
//Nachrichten werden als gelesen überschrieben
if (isset($_GET['id']) || isset($_GET['userid']) && $_SESSION['session_username'] != $_GET['userid']) {
    $Empfänger = $_SESSION['session_username'];
    $Sender = "";
    $ID = $_GET['id'];
    if (isset($_GET['id'])) {
        $Sender = $_GET['user'];
    } else {
        $Sender = $_GET['userid'];
    }
    $query2 = mysqli_query($db_link, "UPDATE Nachrichten SET neu='0' WHERE Empfänger = '$Empfänger' AND Benutzername = '$Sender'") or die('Fehler: ' . mysqli_error($db_link));
}
