<?php
    session_start();
    require('connectDB.php');
    $record_id = (int)$_GET['id'];
    $userEmail = $_SESSION['session_user'];
    $currentUserName = $_SESSION['session_username'];
    $user = "";
    if(isset($_GET['user'])){
        $user = $_GET['user'];
    }else{
        $user = $_SESSION['session_username'];
    }
    if(isset($_GET['userid'])){
        $userid = $_GET['userid'];
        $query = mysqli_query($db_link, "SELECT * FROM `Nachrichten` WHERE (Benutzername = '$currentUserName' AND Empfänger = '$userid') OR (Benutzername = '$userid' AND Empfänger = '$currentUserName')") or die('Fehler: ' . mysqli_error());
    }
    else{
    $query = mysqli_query($db_link, "SELECT * FROM `Nachrichten` WHERE RecordID = $record_id AND (Benutzername = '$user' OR Empfänger = '$user')") or die('Fehler: ' . mysqli_error());
    }
    $resultCheck = mysqli_num_rows($query);
    echo("<div id='annotation'>
                <h1>Nachrichten</h1>
                <p>Anzahl an Nachrichten: $resultCheck</p>");
    if($resultCheck > 0){
        $AlleNachrichten = "";
        while($row = mysqli_fetch_array($query)){
            $Nachricht_id = (int)$row["ID"];

            $query2 = mysqli_query($db_link, "SELECT * FROM `Nachrichten` WHERE ID = $Nachricht_id ") or die('Fehler: ' . mysqli_error());
            $record = mysqli_fetch_array($query2);
            $UserName = $record['Benutzername'];
            $Nachricht = $record['Nachricht'];
            $Menge = $record['Menge'];
            $Nachricht3 = "";

            if($currentUserName == $UserName){
                $Nachricht3 = "<div id='einzelneNachrichtUser'><p><i>$UserName</i></p>";
                if($Menge != 0){
                    $Nachricht3 = "$Nachricht3<p>Menge: $Menge</p>";
                }
                $Nachricht3 = "$Nachricht3<p>$Nachricht</p></div>";
            }else{
                $Nachricht3 = "<div id='einzelneNachrichtNichtUser'><p><i>$UserName</i></p><p>$Nachricht</p></div>";
            }
            $AlleNachrichten = $AlleNachrichten . $Nachricht3;
        }
    } else{
        echo('<p></p><p>Keine Nachrichten gefunden!</p>');
    }
    if($AlleNachrichten != ""){
        echo($AlleNachrichten);
    } 
    require('database/NachrichtenToDB.php');    
    
            ?>
    </div>