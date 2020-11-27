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
        $sql = "SELECT Buchung_ID, Angebot_Typ, userErstell, Datum, Preis, angebotTitel, bezInBier FROM Buchung WHERE userBuch='$username'";
        $result = $connP->query($sql);
    //   $result2 = $connP->query($sql);
        
        
        if ($result->num_rows > 0) {
            // output data of each row
            while ($row = $result->fetch_assoc()) {
        
                $buchID = $row["Buchung_ID"];
                $angebotTyp = $row["Angebot_Typ"];
                $userErstell = $row["userErstell"];
                $datum = $row["Datum"];
                $preis = $row["Preis"];
                $AngebotTitel = $row["angebotTitel"];
                $bezBier = $row["bezInBier"];
               

                // translates the information; makes "0" to "no" and "1" to "jes"
                $bezBier = translateBoolFromDB($bezInBier); 
        
        ?>
        
                    <div class="angebot">
                        <h4>Buchungsnummer</h4>
                        <?php echo $buchID?>  
                        <h4>Benutzername des Angebotserstellenden</h4
                        ><?php echo $userErstell?>
                        <h4>Titel</h4>
                        <?php echo $AngebotTitel?>
                        <h4>Datum</h4
                        ><?php echo $datum?>
                        <h4>Preis</h4>
                        <?php echo $preis?>€
                        <h4>Ich bezahle in Bier</h4
                        ><?php echo $bezBier?>

                        <div class="buttonline">
                            <button class="cent" type="button" onclick="bearbeitenClick()">Bearbeiten</button>
                            <button class="cent" type="button" onclick="bearbeitenClick()">Löschen</button>
                        </div> 

                    </div>             
                    
    <?php
            }
        } else {
            echo "Keine Buchungen vorhanden.";
        }
    }
}
?>