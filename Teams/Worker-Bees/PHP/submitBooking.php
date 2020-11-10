<?php

// good example can be found here: https://www.cloudways.com/blog/custom-php-mysql-contact-form/

//error-variables for validation
//$titleErr = $zeitraumErr = $beschreibErr = $vornameErr = $nachnameErr = $strasseErr = $hnrErr = $plzErr = $ortErr = $preisProTagErr = $preisBetragErr = "";
//$title = $beschreibung = $zeitraum = $vorname = $nachname = $strasse = $hnr = $plz= $ort = $preisProTag1 = $preisProTag2 = $preisBetrag = $a1_bohr = $a2_drechsel = $a3_schleif = $a4_saege = $a5_kleinteil = "";
//$valid=TRUE;

//Connection to bplaced server
$servername = "localhost";
$username = "workerbees";
$password = "HKSZ52";
$dbname = "workerbees_db1";

if ($_SERVER["REQUEST_METHOD"] == "POST") {//wenn auf Submit gedrückt führe Folgendes aus

    $conn2 = new mysqli($servername, $username, $password, $dbname);

     // Check connection
     // Check connection
    if ($conn2->connect_error) {
        die("Connection failed: " . $conn2->connect_error);
        
    } else {

        $number = rand(1000, 10000) + rand(1000, 10000) + rand(1000, 10000); //create random booking number
        $orderID = $conn2->real_escape_string($_POST["cardID"]); // take card id for beginning of booking nr
        $id = "WZcard_" . (string)$orderID;
        $buchung_id = $id.$number; //combine

        //create recognizable names
        $pricename = "WZprice_" . (string)$orderID;
        $datename = "WZdate_" . (string)$orderID;
        $titlename = "WZtitel_" . (string)$orderID;
        $bezinbier = "WZbib_" . (string)$orderID;

        $angebot_id = "";
        $angebot_typ = "";
        $userErstell = "";
        $emailErstell = "";
        $userBuch = "";
        $emailBuch ="";
        $date = $conn2->real_escape_string($_POST["$datename"]);
        $preis = $conn2->real_escape_string($_POST["$pricename"]);
        $title = $conn2->real_escape_string($_POST["$titlename"]);
        $bezinbier =  $conn2->real_escape_string($_POST["$bezinbier"]);

        $sql2 = "INSERT INTO Buchung (Buchung_ID, Angebot_ID, Angebot_Typ, userErstell, emailErstell, userBuch, emailBuch ,Datum, Preis, angebotTitel, bezInBier)
                            VALUES ('$buchung_id', '$angebot_id', '$angebot_typ', '$userErstell', '$emailErstell', '$userBuch', '$emailBuch', '$date', '$preis', '$title', '$bezinbier')";
    

        if ($conn2->query($sql2) === TRUE) {

            echo "New record created successfully";
           

            } else {
            echo '<script type="text/javascript">alert("Es tut uns Leid, das Angebot konnte nicht in die Datenbank aufgenommen werden.");</script>';
            echo "Error: " . $sql2 . "<br>" . $conn2->error;
            
            }
}
    $conn2->close();
}
