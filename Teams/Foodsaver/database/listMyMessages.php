<?php
    session_start();
    require('connectDB.php');
    $user = $_SESSION['session_username'];
    
    $query = mysqli_query($db_link, "SELECT * FROM `Nachrichten` WHERE Empfänger = '$user'") or die('Fehler: ' . mysqli_error());
    
    $resultCheck = mysqli_num_rows($query);
    echo("<div id='annotation'>
                <h1>Nachrichten</h1>
                <p>Anzahl an Nachrichten: $resultCheck</p>");
    if($resultCheck > 0){
        $AlleNachrichten = "";
        while($row = mysqli_fetch_array($query)){
            $Nachricht_id = (int)$row["ID"];

            $record_id = $row['RecordID'];
            echo($record_id);
            $sql = mysqli_query($db_link, "SELECT * FROM `tbl_records` WHERE ID='$record_id'") or die('Fehler: ' . mysqli_error());
            $record = mysqli_fetch_array($sql);
            $UserName = $row['Benutzername'];
            $Nachricht = $row['Nachricht'];
            $Menge = $row['Menge'];
            $Nachricht3 = "";
            $Artikel = $record['Artikel'];
            $date = $row['Zeitpunkt'];

            $Nachricht3 = "<div id='seperateNachricht'><table><tr><td><b>Artikel: </b>$Artikel</td><td><b>Datum: </b>$date</td>";
            if($user == $record['Username']){
                $user2 = $record['Username'];
                $Nachricht3 = "$Nachricht3<td><a class='zur_bestellung' href='../order_food.php?id=$record_id&user=$user2'>Zur Bestellung</a></td></tr></table>";
            }else{
                $Nachricht3 = "$Nachricht3<td><a class='zur_bestellung' href='../order_food.php?id=$record_id'>Zur Bestellung</a></td></tr></table>";
            }
            $Nachricht3 = "$Nachricht3<div id='einzelneNachrichtUser'><p><i><b>$UserName<b></i></p>";
            if($Menge != 0){
                $Nachricht3 = "$Nachricht3<p>Menge: $Menge</p>";
            }
            $AlleNachrichten = "$AlleNachrichten$Nachricht3<p>$Nachricht</p></div></div>";
        }
    } else{
        echo('<p></p><p>Keine Nachrichten gefunden!</p>');
    }
    if($AlleNachrichten != ""){
        echo($AlleNachrichten);
    }    
    
            ?>
    </div>