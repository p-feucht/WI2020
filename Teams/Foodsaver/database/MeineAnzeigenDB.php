<?php

$userEmail = $_SESSION['session_user'];
     
                require('connectDB.php');
                
                $sql = "SELECT * FROM tbl_records WHERE Email = '$userEmail'";
                $result = mysqli_query($db_link, $sql);

                $id = 1;
                $count = 0;


                $resultCheck = mysqli_num_rows($result);

                echo("<div id='MeineRecords'>
                <h1>Meine Records</h1>
                <p>Anzahl an Records: $resultCheck</p>");

                while($row = mysqli_fetch_array($result)) {

                    if($row['Visable'] !== '0'){
                        echo('<p>Artikel nicht mehr verfügbar!</p>');
                    }

                    $artikel_id = (int)$row["ID"];

                    
                    $query = mysqli_query($db_link, "SELECT * FROM `Images` WHERE ArtikelID = $artikel_id ") or die('Fehler: ' . mysqli_error());

                    $ImageData = mysqli_fetch_array($query);
                
                    $ImageLink = $ImageData['imageLink'];

                    echo('<table>');
              
                    echo('<tr id="td-head-' . $id . '" rowSpan="1"<a href="#td-head-' . $id . '" onclick="toggle(6, ' . $id . ')">');
                    if($ImageLink !== Null){
                        echo('<td><b><img src="'.$ImageLink.'" id="record_image"></td>');
                        echo('<td><b>Artikel: </b>' . $row['Artikel'] . '</br><b>Beschreibung: </b>' . $row['Beschreibung'] . '</td>');
                    }    
                    else{
                        echo('<td><b>Artikel: </b>' . $row['Artikel'] . '</td>');
                        echo('<td><b>Beschreibung: </b>' . $row['Beschreibung'] . '</td>');
                    }   
                    echo('</tr>');
                    echo('<tr id="td-data-' . $id . '1" style="display:none">');   
                    echo('<td><b>Menge: </b>' . $row['Menge'] . ' Stück/Portionen</td>');
                    echo('<td><b>Preis: </b>' . $row['Preis'] . '€</td>');
                    echo('</tr>');
                    echo('<tr id="td-data-' . $id . '2" style="display:none">');   
                    echo('<td><b>Firma: </b>' . $row['Firma'] . '</td>');
                    echo('<td><b>Datum: </b>' . $row['Erstellungsdatum'] . '</td>');   
                    echo('</tr>');
                    echo('<tr id="td-data-' . $id . '3" style="display:none">');   
                    echo('<td><b>Username: </b>' . $row['Username'] . ' </td>');
                    echo('<td><b>Name: </b>' . $row['Nachname'] . " " . $row['Vorname'] . '</td>');
                    echo('</tr>');
                    echo('<tr id="td-data-' . $id . '4" style="display:none">');   
                    echo('<td><b>Straße: </b>' . $row['Straße'] . '</td>');
                    echo('<td><b>Hausnummer: </b>' . $row['Hausnummer'] . '</td>');
                    echo('</tr>');
                    echo('<tr id="td-data-' . $id . '5" style="display:none">');   
                    echo('<td><b>PLZ: </b>' . $row['PLZ'] . '</td>');
                    echo('<td><b>Ort: </b>' . $row['Ort'] . '</td>');
                    echo('</tr>');
                    echo('<tr id="td-data-' . $id . '6" style="display:none">');   
                    echo('<td><b>E-mail: </b>' . $row['Email'] . '</td>');
                    echo('<td><b>Telefonnummer: </b>' . $row['Telefonnummer'] . '</td>');               
                    echo('</tr>');
                    echo('</table>');
                    echo("ID: $artikel_id");
                    echo('</br><a href="#td-head-' . $id . '" onclick="toggle(6, ' . $id . ')">Mehr Details</a>');
                    echo('<a class="zur_bestellung" href="../order_food.php?id='.$artikel_id.'">Zur Anzeige</a>');
                    $id++;                  
                    $count = 1;
                }

                if($count == 0){
                    echo("<p>Du hast noch keine Anzeigen!</p>");
                }



?>