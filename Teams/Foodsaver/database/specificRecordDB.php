<?php
            session_start();
            require('connectDB.php');

            $record_id = (int)$_GET['id'];
            
            $db_resArray = mysqli_query($db_link, "SELECT * FROM `tbl_records` WHERE ID = $record_id") or die('Fehler: ' . mysqli_error($db_link));
            
        
            $id = 1;

            $resultCheck = mysqli_num_rows($db_resArray);

            $recordEmail = "";
            if($resultCheck > 0){

                while($rowArray = mysqli_fetch_array($db_resArray))
            {  
                $artikel_id = (int)$rowArray["ID"];
            }




            $query = mysqli_query($db_link, "SELECT * FROM `Images` WHERE ArtikelID = $artikel_id ") or die('Fehler: ' . mysqli_error());
            $ImageLink = array();

            while($ImageData = mysqli_fetch_array($query)){

                $ImageLink[] = $ImageData['imageLink'];

            }
        var_dump($ImageLink);

            $db_res = mysqli_query($db_link, "SELECT * FROM `tbl_records` WHERE ID = $record_id") or die('Fehler: ' . mysqli_error($db_link));

            while($row = mysqli_fetch_array($db_res))
            {   
                
                $recordEmail = $row['Email'];
                
                if($row['Visable'] !== '0'){
                    echo('<p>Artikel nicht mehr verfügbar!</p>');
                }
                else{
   
                echo('<div id="Record"><h1>'.$row['Artikel'].'</h1>');

                echo('<table>');
              
                    echo('<tr id="td-head-' . $id . '" rowSpan="1"<a href="#" onclick="toggle(6, ' . $id . ')">');
                    if(!empty($ImageLink)){
                        foreach ($ImageLink as $key=>$value) {
                        echo('<td><img src="'.$value.'" id="record_image"></td>');
                    }
                        echo('<td><b>Artikel: </b>' . $row['Artikel'] . '</br></br></br><b>Beschreibung: </b>' . $row['Beschreibung'] . '</td>');
                    }    
                    else{
                        echo('<td><b>Artikel: </b>' . $row['Artikel'] . '</td>');
                        echo('<td><b>Beschreibung: </b>' . $row['Beschreibung'] . '</td>');
                    }   
                echo('</tr>');
                echo('<tr id="td-data-' . $id . '1" >');   
                echo('<td><b>Menge: </b>' . $row['Menge'] . ' Stück/Portionen</td>');
                echo('<td><b>Preis: </b>' . $row['Preis'] . '€</td>');
                echo('</tr>');
                echo('<tr id="td-data-' . $id . '2" >');   
                echo('<td><b>Firma: </b>' . $row['Firma'] . '</td>');
                echo('<td><b>Datum: </b>' . $row['Erstellungsdatum'] . '</td>');   
                echo('</tr>');
                echo('<tr id="td-data-' . $id . '3" >');   
                echo('<td><b>Username: </b>' . $row['Username'] . '</td>');
                echo('<td><b>Name: </b>' . $row['Nachname'] . " " . $row['Vorname'] . '</td>');
                echo('</tr>');
                echo('<tr id="td-data-' . $id . '4" >');   
                echo('<td><b>Straße: </b>' . $row['Straße'] . '</td>');
                echo('<td><b>Hausnummer: </b>' . $row['Hausnummer'] . '</td>');
                echo('</tr>');
                echo('<tr id="td-data-' . $id . '5" >');   
                echo('<td><b>PLZ: </b>' . $row['PLZ'] . '</td>');
                echo('<td><b>Ort: </b>' . $row['Ort'] . '</td>');
                echo('</tr>');
                echo('<tr id="td-data-' . $id . '6" >');   
                echo('<td><b>E-mail: </b>' . $row['Email'] . '</td>');
                echo('<td><b>Telefonnummer: </b>' . $row['Telefonnummer'] . '</td>');               
                echo('</tr>');
                echo('</table>');
                echo("ID: $record_id");
                $id++;
                
            }
        }
        
         }     
            
        
        else{

            echo('<p>Keine Anzeigen gefunden!</p>');
        }
        $_SESSION['RecordEmail'] = $recordEmail;
        
            
        ?>
        
        </div>

        
