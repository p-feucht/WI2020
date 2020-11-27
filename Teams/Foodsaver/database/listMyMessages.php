<?php
session_start();
require('connectDB.php');
$user = $_SESSION['session_username'];

//Festlegen wie viele Nachrichten geslistet werden sollen
if (isset($_GET['limit'])) {
    $limit = $_GET['limit'];
} else {
    $limit = 10;
}
//Unterscheidung der Datenbakabfrage für die Nachrichten Order Food für den Verkäufer und messages.php
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $query = mysqli_query($db_link, "SELECT * FROM `Nachrichten` WHERE RecordID = '$id' order by Zeitpunkt DESC Limit $limit") or die('Fehler: ' . mysqli_error($db_link));
    $countselect = mysqli_query($db_link, "SELECT * FROM `Nachrichten` WHERE RecordID = '$id'") or die('Fehler: ' . mysqli_error($db_link));
} else {
    //Unterscheidung zwischen gesendeten und empfangen Nachtichten.
    if (isset($_GET['gesendet'])) {
        $query = mysqli_query($db_link, "SELECT * FROM `Nachrichten` WHERE Benutzername = '$user' order by Zeitpunkt DESC Limit $limit") or die('Fehler: ' . mysqli_error($db_link));
        $countselect = mysqli_query($db_link, "SELECT * FROM `Nachrichten` WHERE Benutzername = '$user'") or die('Fehler: ' . mysqli_error($db_link));
    } else {
        $query = mysqli_query($db_link, "SELECT * FROM `Nachrichten` WHERE Empfänger = '$user' order by Zeitpunkt DESC Limit $limit") or die('Fehler: ' . mysqli_error($db_link));
        $countselect = mysqli_query($db_link, "SELECT * FROM `Nachrichten` WHERE Empfänger = '$user'") or die('Fehler: ' . mysqli_error($db_link));
    }
}
$resultCheck = mysqli_num_rows($query);


//Auflisten der Nachrichten
if ($resultCheck > 0) {
    echo ("<div id='annotation'>");
    if (isset($_GET['gesendet'])) {
        echo ("<h2>Gesendete Nachrichten</h2>");
    } else {
        echo ("<h2>Empfangene Nachrichten</h2>");
    }
    echo ("<p>Anzahl an Nachrichten: $resultCheck</p>");
} else {
    if (isset($_GET['id'])) {
        echo ("<div id='annotation'>
            <h1>Keine Nachrichten für diesen Artikel gefunden</h1>");
    } else {
        echo ('<div id="annotation"><h2>Keine Nachrichten gefunden!</h2>');
    }
}

if ($resultCheck > 0) {
    $AlleNachrichten = "";
    if (isset($_GET['gesendet'])) {
        echo ("<table id='header_messages'><tr id='header_messages_row'>
        <td style='width: 15%'><b>Empfänger</td><td style='width: 15%'><b>Artikel</td><td style='width: 35%'><b>Nachricht</td><td style='width: 20%'><b>Datum</td><td></td></tr></table>");
    } else {
        echo ("<table id='header_messages'><tr id='header_messages_row'>
        <td style='width: 15%'><b>Benutzername</td><td style='width: 15%'><b>Artikel</td><td style='width: 35%'><b>Nachricht</td><td style='width: 20%'><b>Datum</td><td></td></tr></table>");
    }
    while ($row = mysqli_fetch_array($query)) {
        $Nachricht_id = (int)$row["ID"];

        $record_id = $row['RecordID'];
        $sql = mysqli_query($db_link, "SELECT * FROM `tbl_records` WHERE ID='$record_id'") or die('Fehler: ' . mysqli_error($db_link));
        $record = mysqli_fetch_array($sql);
        if (isset($_GET['gesendet'])) {
            $UserName = $row['Empfänger'];
        } else {
            $UserName = $row['Benutzername'];
        }
        $Nachricht = $row['Nachricht'];
        $Menge = $row['Menge'];
        $Artikel = $record['Artikel'];
        $datum = $row['Zeitpunkt'];
        $date = DateTime::createFromFormat('Y-m-d H:i:s', $datum)->format('d.m.Y - H:i');
        $date = $date . ' Uhr';
        $KurzNachricht = "";
        $neu = $row['neu'];

        $wholeMessage = 0;
        $messagelink = 1;

        if (isset($_GET['messageid'])) {
            if ($_GET['messageid'] == $Nachricht_id) {
                $wholeMessage = 1;
            }
        }

        if ($Menge != 0) {
            $Nachricht = "<b>Bestellmenge: $Menge Stück</b></br> $Nachricht";
        }

        //Nachrichten kürzen falls sie zu lange sind
        if (strlen($Nachricht) > 80 && $wholeMessage != 1) {
            $wörter = explode(" ", $Nachricht);
            $checkNachricht = "";
            foreach ($wörter as $value) {
                $checkNachricht = "$checkNachricht $value";
                if (strlen($checkNachricht) > 70) {
                    break;
                }
                $KurzNachricht = "$KurzNachricht $value";
            }
            $Nachricht = "$KurzNachricht ...";
        } else {
            if ($wholeMessage != 1) {
                $messagelink = 0;
            }
        }
        if (isset($_GET['gesendet'])) {
            echo "<div id='listMyMessages'><table id='listMyMessagesTable'><tr>";
        } else {
            if ($neu == 0) {
                echo "<div id='listMyMessages'><table id='listMyMessagesTable'><tr>";
            } else {
                echo "<div id='listMyMessagesNeu'><table id='listMyMessagesTable'><tr id='annotationtr'>";
            }
        }

        if (isset($_GET['id'])) {
            echo "<td style='width: 15%'>
            <a id='username' href='../profile.php?userid=" . $UserName . "'><b>$UserName:</b></a></td><td style='width: 15%'>
            <a id='article' href='../order_food.php?id=" . $record_id . "'><b>$Artikel</b></a></td><td style='width: 35%'>";
            if ($messagelink == 0) {
                echo "$Nachricht</td><td style='width: 20%'>$date</td>";
            } else {
                if ($wholeMessage == 0) {
                    if (isset($_GET['gesendet'])) {
                        echo "<a id='linkMessageToolong' href='../messages.php?gesendet=1&messageid=$Nachricht_id'>$Nachricht</a></td><td style='width: 20%'>$date</td>";
                    } else {
                        echo "<a id='linkMessageToolong' href='../messages.php?messageid=$Nachricht_id'>$Nachricht</a></td><td style='width: 20%'>$date</td>";
                    }
                } else {
                    //Zu lange Nachricht in einem link einfügen damit diese geöffnet werden kann.
                    if (isset($_GET['gesendet'])) {
                        echo "<a id='linkMessageToolong' href='../messages.php?gesendet=1'>$Nachricht</a></td><td style='width: 20%'>$date</td>";
                    } else {
                        echo "<a id='linkMessageToolong' href='../messages.php'>$Nachricht</a></td><td style='width: 20%'>$date</td>";
                    }
                }
            }
            if ($user == $record['Username']) {
                echo "<td style='width: 15%'><a class='zur_bestellung' href='../order_food.php?id=$record_id&user=$UserName'>Antworten</a></td></tr></table></div>";
            } elseif ($record_id == 0) {
                echo "<td style='width: 15%'><a class='zur_bestellung' href='../profile.php?userid=$UserName'>Antworten</a></td></tr></table></div>";
            } else {
                echo "<td style='width: 15%'><a class='zur_bestellung' href='../order_food.php?id=$record_id'>Antworten</a></td></tr></table></div>";
            }
        } else {
            echo "<td style='width: 15%'>
            <a id='username' href='../profile.php?userid=" . $UserName . "'><b>$UserName:</b></a></td><td style='width: 15%'>
            <a id='article' href='../order_food.php?id=" . $record_id . "'><b>$Artikel</b></a></td><td style='width: 35%'>";
            if ($messagelink == 0) {
                echo "$Nachricht</td><td style='width: 20%'>$date</td>";
            } else {
                if ($wholeMessage == 0) {
                    if (isset($_GET['gesendet'])) {
                        echo "<a id='linkMessageToolong' href='../messages.php?gesendet=1&messageid=$Nachricht_id'>$Nachricht</a></td><td style='width: 20%'>$date</td>";
                    } else {
                        echo "<a id='linkMessageToolong' href='../messages.php?messageid=$Nachricht_id'>$Nachricht</a></td><td style='width: 20%'>$date</td>";
                    }
                } else {
                    if (isset($_GET['gesendet'])) {
                        echo "<a id='linkMessageToolong' href='../messages.php?gesendet=1'>$Nachricht</a></td><td style='width: 20%'>$date</td>";
                    } else {
                        echo "<a id='linkMessageToolong' href='../messages.php'>$Nachricht</a></td><td style='width: 20%'>$date</td>";
                    }
                }
            }
            if ($user == $record['Username']) {
                echo "<td style='width: 15%'><a class='zur_bestellung' href='../order_food.php?id=$record_id&user=$UserName'>Antworten</a></td></tr></table></div>";
            } elseif ($record_id == 0) {
                echo "<td style='width: 15%'><a class='zur_bestellung' href='../profile.php?userid=$UserName'>Antworten</a></td></tr></table></div>";
            } else {
                echo "<td style='width: 15%'><a class='zur_bestellung' href='../order_food.php?id=$record_id'>Antworten</a></td></tr></table></div>";
            }
        }
    }
}
//Anzahl der Aufgelisteten Nachrichten + 10 in die Url schreiben (Wie viele Nachrichten werden beim nächsten 'mehr Anzeigen' gelistet)
if (mysqli_num_rows($countselect) > $limit) {
    $limit2 = $limit + 10;
    echo ('<a class="mehr_artikel" href="../messages.php?limit=' . $limit2 . '&sd=1">Weitere Nachrichten anzeigen</a>');
}

?>
</div>