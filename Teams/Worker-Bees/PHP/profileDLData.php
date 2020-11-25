<?php

require_once('profileUserData.php');
$connP = createConnToDB();
if($connP==""){
    die("Connection failed: " . $connP->connect_error);
}
else{

        $sql = "SELECT ATitel, ABeginndat, AEndedat, ABeschreibung,
        PLZ, Ort, Bild, usernameErsteller, Dienstleistung_ID, Preis, BezInBier, Preisart FROM AngebotDienstleistung";
        $result = $connP->query($sql);
        
        if ($result->num_rows > 0) {
            // output data of each row
            while ($row = $result->fetch_assoc()) {
        
                $beginDat = $row["ABeginndat"];
                $endDat = $row["AEndedat"];
                $orderID = $row["Dienstleistung_ID"];
                $location = $row["Ort"];
                $title = $row["ATitel"];
                $price = $row["Preis"];
                $pricetype = $row["Preisart"];
                $offeruser = $row["usernameErsteller"];
                $plz = $row["PLZ"];
                $description = $city = $row["ABeschreibung"];
                $bezBier = $row["BezInBier"];
                $image = $row["Bild"];
        
                $card_ID = "Dcard_" . (string)$orderID;
                $modal_target = "#Dmodal_" . (string)$orderID;
                $modal_ID = "Dmodal_" . (string)$orderID;
        
                $bier = round($price, 0); // so that beer is counted in whole beers
        
        ?> 
        
            <div class="angebot">
                    <h4 id="title">Titel  </h2>
                    <?php echo $title ?>
                    <h4 id="description">Beschreibung  </h2>  
                    <?php echo $description?>
                    <h4 id="begDat">Beginndatum  </h2
                    ><?php echo $beginDat?>
                    <h4 id="endDat">Enddatum  </h2
                    ><?php echo $endDat?>
                    <h4 id="endDat">Ort  </h2
                    ><?php echo $location?>
                    <h4 id="endDat">Preisart  </h2
                    ><?php echo $pricetype?>
                    <h4 id="endDat">Preis  </h2
                    ><?php echo $price?>€
                    <h4 id="endDat">In Bier bezahlbar  </h2
                    ><?php echo $bezBier?>

                    <button class="cent" type="button" onclick="bearbeitenClick()"><p>Bearbeiten</p></button>
        
            </div>
<?php
            }       
        } else {
            echo "Keine Einträge gefunden.";
        }
}
?>