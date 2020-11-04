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
            $sql = mysqli_query($db_link, "SELECT * FROM `tbl_records` WHERE ID='$record_id'") or die('Fehler: ' . mysqli_error());
            $record = mysqli_fetch_array($sql);
            $UserName = $row['Benutzername'];
            $Nachricht = $row['Nachricht'];
            $Menge = $row['Menge'];
            $Nachricht3 = "";
            $Artikel = $record['Artikel'];
            $date = $row['Zeitpunkt'];
            $KurzNachricht = "";

            $wholeMessage = 0;
            $messagelink = 1;

            if (isset($_GET['messageid'])) {
                if($_GET['messageid']==$Nachricht_id){
                    $wholeMessage = 1;
                }
            }

            if($Menge != 0){
                $Nachricht = "<b>Bestellmenge: $Menge</b> $Nachricht";
            }
        
            if(strlen($Nachricht)>80&&$wholeMessage!=1){
                $wörter = explode (" " , $Nachricht);
                $checkNachricht = "";
                foreach ($wörter as $value) {
                    $checkNachricht = "$checkNachricht $value";
                    if(strlen($checkNachricht)>70){
                        break;
                    }
                    $KurzNachricht = "$KurzNachricht $value";
                }
                $Nachricht = "$KurzNachricht...";
            }else{
                if($wholeMessage!=1){
                    $messagelink = 0;
                }
            }

            if($row['neu']==0){
                $Nachricht3 = "<div id='listMyMessages'><table id='listMyMessagesTable'>";
            }else{
                $Nachricht3 = "<div id='listMyMessages'><table style='background-color: indianred;margin-top: 0%;border: 0px solid black;table-layout: fixed;overflow-wrap: break-word;width: 97%'>";
            }


            $Nachricht3 = "$Nachricht3<tr><td style='width: 15%'><b>$UserName:</b></td><td style='width: 10%'><b>$Artikel</b></td><td style='width: 55%'>";
            if($messagelink == 0){
                $Nachricht3 = "$Nachricht3$Nachricht</td><td style='width: 15%'>$date</td>";
            }else{
                if($wholeMessage==0){
                    $Nachricht3 = "$Nachricht3<a href='../messages.php?messageid=$Nachricht_id'><div style='height:100%;width:100%'>$Nachricht</div></a></td><td style='width: 15%'>$date</td>";
                }else{
                    $Nachricht3 = "$Nachricht3<a href='../messages.php'><div style='height:100%;width:100%'>$Nachricht</div></a></td><td style='width: 15%'>$date</td>";
                }
            }
            if($user == $record['Username']){
                $Nachricht3 = "$Nachricht3<td style='width: 6%'><a class='zur_bestellung' href='../order_food.php?id=$record_id&user=$UserName'>Antworten</a></td></tr></table></div>";
            }elseif($record_id == 0){
                $Nachricht3 = "$Nachricht3<td style='width: 6%'><a class='zur_bestellung' href='../profile.php?userid=$UserName'>Antworten</a></td></tr></table></div>";
            }else{
                $Nachricht3 = "$Nachricht3<td style='width: 6%'><a class='zur_bestellung' href='../order_food.php?id=$record_id'>Antworten</a></td></tr></table></div>";
            }
            $AlleNachrichten = "$Nachricht3$AlleNachrichten";
        }
    } else{
        echo('<p></p><p>Keine Nachrichten gefunden!</p>');
    }
    if($AlleNachrichten != ""){
        echo($AlleNachrichten);
    }
    
            ?>
    </div>