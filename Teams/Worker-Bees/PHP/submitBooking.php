<?php
//include 'header.php';
// good example can be found here: https://www.cloudways.com/blog/custom-php-mysql-contact-form/

//error-variables for validation
$titleErr = $zeitraumErr = $beschreibErr = $vornameErr = $nachnameErr = $strasseErr = $hnrErr = $plzErr = $ortErr = $preisProTagErr = $preisBetragErr = "";
$title = $beschreibung = $zeitraum = $vorname = $nachname = $strasse = $hnr = $plz= $ort = $preisProTag1 = $preisProTag2 = $preisBetrag = $a1_bohr = $a2_drechsel = $a3_schleif = $a4_saege = $a5_kleinteil = "";
$valid=TRUE;

//Connection to bplaced server
$servername = "localhost";
$username = "workerbees";
$password = "HKSZ52";
$dbname = "workerbees_db1";

if ($_SERVER["REQUEST_METHOD"] == "POST") {//wenn auf Submit gedrückt führe Folgendes aus

    $conn = mysqli_connect($servername, $username, $password, $dbname);

     // Check connection
     if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
        echo "Connection failed";
        
    }
    else {

        $sql = "";
        
        $buchung_id = "";
        $angebot_id = "";
        $angebot_typ = "";
        $userErstell = "";
        $emailErstell = "";
        $userBuch = "";
        $emailBuch ="";
        $date = $conn->real_escape_string($_POST["Datum"]);
        $preis = $conn->real_escape_string($_POST["Preis"]);
        $titel = $conn->real_escape_string($_POST["angebotTitel"]);
        $bezinbier = $conn->real_escape_string($_POST["bierZahlung"]);


        $sql = "INSERT INTO Buchung (Buchung_ID, Angebot_ID, Angebot_Typ, userErstell, emailErstell, userBuch, emailBuch, Preis, angebotTitel, bezInBier)
                            VALUES ($buchung_id, $angebot_id, $angebot_typ, $userErstell, $emailErstell, $userBuch, $emailBuch, $preis, $bezinbier)";
    
        echo $sql;
        echo "<br>";
    
        if ($conn->query($sql) === TRUE) {

            echo "New record created successfully";
            echo "<br>";
            echo "Entries written:";
            echo $buchung_id;
            echo "<br>";
            echo $angebot_id;
            echo "<br>";
            echo $angebot_typ;
            echo "<br>";
            echo $userErstell;
            echo "<br>";
            echo $emailErstell;
            echo "<br>";
            echo $userBuch;
            echo "<br>";
            echo $emailBuch;
            echo "<br>";
            echo $preis;
            echo "<br>";
            echo $bezinbier;

            } else {
            echo '<script type="text/javascript">alert("Es tut uns Leid, das Angebot konnte nicht in die Datenbank aufgenommen werden.");</script>';
            echo "Error: " . $sql . "<br>" . $conn->error;
            
            }
}
    $conn->close();
}
    
?>

