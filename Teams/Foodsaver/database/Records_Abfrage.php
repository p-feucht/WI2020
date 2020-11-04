     <?php
            session_start();
                require('connectDB.php');

                
                if((isset($_POST["myInput"]) and !empty($_POST["myInput"])) or (isset($_POST["searchButton"]) and !empty($_POST["myInput"]))){
                    $search = $_POST["myInput"];
                }
                else{
                    $search = '*';
                }
                
                if($search == '*'){
                    $db_res = mysqli_query($db_link, "SELECT * FROM tbl_records WHERE Visable = '0'") or die('Fehler: ' . mysqli_error());
                }
                else{
                    $db_res = mysqli_query($db_link, "SELECT * FROM tbl_records WHERE (Visable = '0') AND (Artikel LIKE '%$search%' or Beschreibung LIKE '%$search%' or Menge LIKE '%$search%' 
                    or Preis LIKE '%$search%' or Firma LIKE '%$search%' or Nachname LIKE '%$search%' or PLZ LIKE '%$search%' or Ort LIKE '%$search%')") or die('Fehler: ' . mysqli_error());
                }
            
                

                $id = 1;

                $resultCheck = mysqli_num_rows($db_res);

                

                echo("<div id='Record'>
                <h1>Aktuelle Angebote</h1>
                <p>Anzahl an Angeboten: $resultCheck</p>");

                if($resultCheck > 0){
            
                while($row = mysqli_fetch_array($db_res)){

                    $artikel_id = (int)$row["ID"];
                    

                $query = mysqli_query($db_link, "SELECT * FROM `Images` WHERE ArtikelID = $artikel_id ") or die('Fehler: ' . mysqli_error());

                $ImageData = mysqli_fetch_array($query);
                
                $ImageLink = $ImageData['imageLink'];

                echo('<table>');
              
                    echo('<tr class="first_row" id="td-head-' . $id . '" rowSpan="1"<a href="#td-head-' . $id . '" onclick="toggle(6, ' . $id . '); changeText(' . $id . ');">');
                    if($ImageLink != Null){
                        echo('<td><b><img src="'.$ImageLink.'" id="record_image"></td>');
                        echo('<td><b>Artikel: </b><a id="article" href="../order_food.php?id='.$artikel_id.'">' . $row['Artikel'] . '</a></br><b>Beschreibung: </b>' . $row['Beschreibung'] . '</td>');
                    }    
                    else{
                        echo('<td><b>Artikel: </b><a id="article" href="../order_food.php?id='.$artikel_id.'">' . $row['Artikel'] . '</a></td>');
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
                    echo('<td><b>Username: </b><a id="username" href="../profile.php?userid='. $row['Username'] .'" >' . $row['Username'] . '</a></td>');
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
                    echo('<button class="mehr_details" id="details' . $id . '" onclick="toggle(6, ' . $id . '); changeText(' . $id . ');">Mehr Details</button>');
                    echo('<a class="zur_bestellung" href="../order_food.php?id='.$artikel_id.'">Zur Bestellung</a>');
                    $id++;
                    
                }     
          
        }
            else{

                echo('<tr><p>Keine Anzeigen gefunden!</p></tr>');
            }
            
                
            ?>
            
            </div>

            
<script>
function changeText(id) {
    var element = document.getElementById('details' + id);
    
        if (element.innerHTML === 'Mehr Details'){ element.innerHTML = 'Weniger Details';}
        else {
            element.innerHTML = 'Mehr Details';
        
    }
}
</script> 
