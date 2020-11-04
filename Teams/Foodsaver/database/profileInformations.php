<?php
            session_start();
            require('connectDB.php');

            $userEmail = $_GET['userid'];
            $_SESSION['last_page'] = $_SERVER['HTTP_REFERER'];

            $query = mysqli_query($db_link, "SELECT * FROM `tbl_contacts` WHERE Benutzername = '$userEmail'") or die('Fehler: ' . mysqli_error());

            while($ImageData = mysqli_fetch_array($query)){

                $ImageLink = $ImageData['pictureLink'];
            }

            $db_res = mysqli_query($db_link, "SELECT * FROM `tbl_contacts` WHERE Benutzername = '$userEmail'") or die('Fehler: ' . mysqli_error());

            $resultCheck = mysqli_num_rows($db_res);

            if($resultCheck > 0){
            while($row = mysqli_fetch_array($db_res))
            {   
                
                if($userEmail == $_SESSION['session_username']){
                echo("<div id='Profile'>
                <h1>Dein Profil</h1>");
                }
                else{
                    echo("<div id='Profile'>
                <h1>Benutzerprofil von $userEmail</h1>");
                }
                echo('<div id="Record"><h2>' . $row['Nachname'] . " " . $row['Vorname'] . '</h2>');

                echo('<table>');
              
                    echo('<tr id="td-head-' . $id . '" rowSpan="1"<a href="#" onclick="toggle(6, ' . $id . ')">');
                    if((isset($ImageLink)) and ($ImageLink != Null)){
                        
                        echo('<td><img src="'.$ImageLink.'" id="profile_image"></td>');
                        echo('<td></td>');
                    }    
                    else{
                        echo('<td></td>');
                        echo('<td></td>');
                    }   
                echo('</tr>');
                echo('<tr id="td-data-' . $id . '2" >');   
                echo('<td><b>Firma: </b>' . $row['Firma'] . '</td>');
                echo('<td><b>Erstellungsdatum: </b>' . $row['Erstellungsdatum'] . '</td>');   
                echo('</tr>');
                echo('<tr id="td-data-' . $id . '3" >');   
                echo('<td><b>Username: </b>' . $row['Benutzername'] . '</td>');
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
                if($userEmail == $_SESSION['session_username']){
                echo('</br><a id="profil_bearbeiten" href="editProfile.php">Profil bearbeiten</a>');
                }
                $id++;
                
            
        }
        
             
        }
        
        else{
            echo('<p>Keine Anzeigen gefunden!</p>');
        }

        echo ('</div>');

        if($userEmail != $_SESSION['session_username']){
            require('listMessagesForRecord.php');
        }   
        ?>
        
        

        
