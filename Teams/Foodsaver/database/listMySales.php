<?php
    session_start();
    require('connectDB.php');
    $username = $_SESSION['session_username'];
    $query = mysqli_query($db_link, "SELECT * FROM `Bestellungsanfragen` WHERE VerkäuferUsername = '$username'") or die('Fehler: ' . mysqli_error());
    
    $resultCheck = mysqli_num_rows($query);
    echo('<div id="Record">');
    echo('<h1>Alle Bestellungen</h1>');
    if($resultCheck > 0){
        while($row = mysqli_fetch_array($query)){
            $bestellEmail = $row['Email'];
            $record_id = $row['Record_ID'];
            $sql = mysqli_query($db_link, "SELECT * FROM `tbl_records` WHERE ID='$record_id'") or die('Fehler: ' . mysqli_error());
            $row2 = mysqli_fetch_array($sql);    
    
            $user = $row['Username'];
            echo('<table>');
            echo('<tr>'); 
            echo('<td><b>Artikel: </b>' . $row2['Artikel'] . '</td>'); 
            echo('<td><b>Käufer: </b>' . $row['Username'] . '</td>'); 
            echo('<td><b>Bestelldatum: </b>' . $row['Bestelldatum'] . '</td>');
            echo('<td><b>Anzahl: </b>' . $row['Menge'] . '</td>');
            echo('</tr>');
            echo('<tr><td><b>Anmerkung: </b>' . $row['Anmerkung'] . '</td><td></td><td></td><td><a class="zur_bestellung" href="../order_food.php?id='.$record_id.'&user='.$user.'">Zur Bestellung</a></td></tr>');
            echo('</table>');
        }
    }else{
        echo('<h1>Es wurden keine Verkäufe gefunden!</h1>');
    }
    echo('</div>');
?>
            
       

   