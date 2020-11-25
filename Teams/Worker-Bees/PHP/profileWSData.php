<?php

//require_once('profileUserData.php');

include_once ("outsourcedFunctions.php"); 

$connP = createConnToDB();
if($connP==""){
    die("Connection failed: " . $connP->connect_error);
}
else{
    
    $username = $_SESSION["username"];
    if($username!=""){

        //offer data
        $sql = "SELECT ATitel, ABeginndat, AEndedat, ABeschreibung, PLZ, Ort, Bild, Werkstatt_ID, PreisProTag, BezInBier, 
            ABohr, ADrechsel, ASchleif, ASaege, AKleinteil FROM AngebotWerkstatt WHERE usernameErsteller='$username'";
        $result = $connP->query($sql);

        if ($result->num_rows > 0) {
            // output data of each row
            while ($row = $result->fetch_assoc()) {

                $beginDat = $row["ABeginndat"];
                $endDat = $row["AEndedat"];
                $orderID = $row["Werkstatt_ID"];
                $location = $row["Ort"];
                $title = $row["ATitel"];
                $price = $row["PreisProTag"];

                $plz = $row["PLZ"];
                $description = $city = $row["ABeschreibung"];
                $bezBier = $row["BezInBier"];
                $image = $row["Bild"];

                $abohr = $row["ABohr"];
                $adrechsel = $row["ADrechsel"];
                $aschleif = $row["ASchleif"];
                $asaege = $row["ASaege"];
                $akleinteil = $row["AKleinteil"];

                $card_ID = "WScard_" . (string)$orderID;

                // translates the information; makes "0" to "no" and "1" to "jes"
                $bezBier = translateBoolFromDB($bezInBier); 
        ?>
            
                    <div class="angebot">
                        <h4>Titel</h4>
                        <?php echo $title?>
                        <h4>Beschreibung</h4>  
                        <?php echo $description?>
                        <h4>Beginndatum</h4
                        ><?php echo $beginDat?>
                        <h4>Enddatum</h4
                        ><?php echo $endDat?>
                        <h4>Ort</h4
                        ><?php echo $location?>
                        <h4>Preis</h4
                        ><?php echo $price?>€
                        <h4>In Bier bezahlbar</h4
                        ><?php echo $bezBier?>
                   
                        <div class="buttonline">
                            <button class="cent" type="button" onclick="bearbeitenClick()">Bearbeiten</button>
                            <button class="cent" type="button" onclick="bearbeitenClick()">Löschen</button>
                        </div> 
                    
                    </div>
        <?php
            }
        } else {
            echo "Keine Einträge gefunden.";
        }
    }
}
?>