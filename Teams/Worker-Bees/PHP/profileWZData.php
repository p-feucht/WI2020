<?php

require_once('profileUserData.php');
$connP = createConnToDB();
if($connP==""){
    die("Connection failed: " . $connP->connect_error);
}
else{

    
    $username = $_SESSION["username"];
    if($username!=""){

        //offer data
        $sql = "SELECT ATitel, ABeginndat, AEndedat, ABeschreibung, Vorname, Nachname, Strasse, Hausnummer, 
        PLZ, Ort, Bild, Werkzeug_ID, PreisProTag, BezInBier, Erstellzeitpunkt FROM AngebotWerkzeug WHERE usernameErsteller='$username'";
        $result = $connP->query($sql);
    //   $result2 = $connP->query($sql);
        
        
        if ($result->num_rows > 0) {
            // output data of each row
            while ($row = $result->fetch_assoc()) {
        
                $beginDat = $row["ABeginndat"];
                $endDat = $row["AEndedat"];
                $orderID = $row["Werkzeug_ID"];
                $location = $row["Ort"];
                $title = $row["ATitel"];
                $price = $row["PreisProTag"];
                $plz = $row["PLZ"];
                $description = $city = $row["ABeschreibung"];
                $bezBier = $row["BezInBier"];
                $image = $row["Bild"];
        
        ?>
        
                    <div class="angebot">
                        <h4 id="title">Titel  </h2>
                        <?php echo $title?>
                        <h4 id="description">Beschreibung  </h2>  
                        <?php echo $description?>
                        <h4 id="begDat">Beginndatum  </h2
                        ><?php echo $beginDat?>
                        <h4 id="endDat">Enddatum  </h2>
                        <?php echo $endDat?>
                        <h4 id="endDat">Ort  </h2
                        ><?php echo $location?>
                        <h4 id="endDat">Preis  </h2
                        ><?php echo $price?>€
                        <h4 id="endDat">In Bier bezahlbar  </h2
                        ><?php echo $bezBier?>
                        <!--<h4 id="endDat">Anzahl Buchungen </h2> 
                        ist noch auszufüllen-->
                        </br>
                        <button class="cent" type="button" onclick="bearbeitenClick()"><p>Bearbeiten</p></button>
                    
                    </div>             
                    
    <?php
            }
        } else {
            echo "Keine Einträge gefunden.";
        }
    }
}
?>