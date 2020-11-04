<?php
    session_start();
    require('connectDB.php');
    $record_id = (int)$_GET['id'];
    $userEmail = $_SESSION['session_user'];
    $hasorder = false;
    $headercreated = false;
    $_SESSION['last_page'] = $_SERVER['HTTP_REFERER'];

    if(isset($_GET['user'])){
        $customer = $_GET['user'];
        $query = mysqli_query($db_link, "SELECT * FROM `Bestellungsanfragen` WHERE Record_ID = $record_id AND Username = '$customer'") or die('Fehler: ' . mysqli_error());
    }
    else{
    $query = mysqli_query($db_link, "SELECT * FROM `Bestellungsanfragen` WHERE Record_ID = $record_id") or die('Fehler: ' . mysqli_error());
    }
    $resultCheck = mysqli_num_rows($query);
    echo('<div id="Record">');
    if($resultCheck > 0){
        while($row = mysqli_fetch_array($query)){

            $sql = mysqli_query($db_link, "SELECT * FROM `tbl_records` WHERE ID = $record_id") or die('Fehler: ' . mysqli_error());
            $row2 = mysqli_fetch_array($sql);

            if($row['Verkäufer'] == $userEmail){     #Du hast den Record erstellt        
            if( $headercreated == false){
            echo('<h1>Diese Anzeige haben Sie erstellt!</h1>
            <h2>Alle Bestellungen:</h2>');   
            $headercreated = true; 
            }
            echo('<table>');
            echo('<tr>');  
            echo('<td><b>Käufer: </b>' . $row['Username'] . '</td>'); 
            echo('<td><b>Bestelldatum: </b>' . $row['Bestelldatum'] . '</td>');
            echo('<td><b>Anzahl: </b>' . $row['Menge'] . '</td>');
            echo('<td><b>Nachricht: </b>' . $row['Anmerkung'] . '</td>');
            echo('</tr>');
            echo('</table>');
            $user = $row['Username'];
            if(isset($_GET['id']) and isset($_GET['user'])){
                echo "";
            }else{
            echo('<a class="zur_bestellung" href="../order_food.php?id='.$record_id.'&user='.$user.'">Zur Bestellung</a>');
            }
            $hasorder= true;
            }
            elseif($row['Email'] == $userEmail){    #Du hast bestellt
            if( $headercreated == false){
            echo("<h1>Sie haben diesen Artikel gekauft!</h1>
            <h2>Ihre Bestellungen:</h2>"); 
            $headercreated = true; 
            } 
            echo('<table>');
            echo('<tr>');   
            echo('<td><b>Bestelldatum: </b>' . $row['Bestelldatum'] . '</td>');
            echo('<td><b>Anzahl: </b>' . $row['Menge'] . '</td>');
            echo('<td><b>Nachricht: </b>' . $row['Anmerkung'] . '</td>');
            echo('</tr>');
            echo('</table>');
            $bestellEmail = $row['Email'];
            $hasorder= true;
            }
        }
}if($hasorder == false){
        echo('<h1>Keine Nachrichten gefunden!</h1>');
        $sql3 = mysqli_query($db_link, "SELECT * FROM `tbl_records` WHERE ID = $record_id") or die('Fehler: ' . mysqli_error());
        $row3 = mysqli_fetch_array($sql3);
        $verkäuferEmail = $row3['Email'];
    }  

echo('</div>');



if((isset($_GET['user'])) or ($bestellEmail == $userEmail) or (($hasorder == false) and ($userEmail != $verkäuferEmail))){
    
        require('listMessagesForRecord.php');
        }
        
        
        
            ?>
            
       

   