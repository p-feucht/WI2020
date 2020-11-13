<?php
/* if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){

    header("location: ../login.php");
    exit;
} */

//error-variables for validation
//$titleErr = $zeitraumErr = $beschreibErr = $vornameErr = $nachnameErr = $strasseErr = $hnrErr = $plzErr = $ortErr = $preisProTagErr = $preisBetragErr = "";
//$title = $beschreibung = $zeitraum = $vorname = $nachname = $strasse = $hnr = $plz= $ort = $preisProTag1 = $preisProTag2 = $preisBetrag = $a1_bohr = $a2_drechsel = $a3_schleif = $a4_saege = $a5_kleinteil = "";
//$valid=TRUE;

//Connection to bplaced server
$servername = "localhost";
$username = "workerbees";
$password = "HKSZ52";
$dbname = "workerbees_db1";

if ($_SERVER["REQUEST_METHOD"] == "POST") {//wenn auf Submit gedrückt wird führe Folgendes aus

    $conn2 = new mysqli($servername, $username, $password, $dbname);

     // Check connection
     // Check connection
    if ($conn2->connect_error) {
        die("Connection failed: " . $conn2->connect_error);
        
    } else {

        $orderID = $conn2->real_escape_string($_POST["orderID"]); // take card id for beginning of booking nr

        // get information about specific order from database
        $getOrderSql = "SELECT ATitel, Vorname, Nachname, Strasse, Hausnummer, PLZ, Ort, usernameErsteller, PreisProTag FROM AngebotWerkzeug WHERE Werkzeug_ID = $orderID" ;
        $result = $conn2->query($getOrderSql);

        if ($result->num_rows == 1) {

            $orderRow = $result->fetch_assoc();
            $title = $orderRow["ATitel"];
            $userErstell = $orderRow["usernameErsteller"];
            $preis = $orderRow["PreisProTag"];

        } else {
            echo '<script type="text/javascript">alert("Es tut uns Leid, das Angebot konnte nicht in die Datenbank aufgenommen werden.");</script>';
            echo "Error: " . $getOrderSql . "<br>" . $conn2->error;
        }

        $number = rand(1000, 10000) + rand(1000, 10000) + rand(1000, 10000); //create random booking number
        $id = "WZcard_" . (string)$orderID;
        $buchung_id = $id.$number; //combine


        $angebot_id = "";
        $angebot_typ = "Werkzeug";
        //$userErstell = "";
        $emailErstell = "";
        $userBuch = $_SESSION["username"];
        $emailBuch ="";
        $date = $conn2->real_escape_string($_POST["Date"]);
        //$preis = $conn2->real_escape_string($_POST["Preis"]);
        //$title = $conn2->real_escape_string($_POST["$titlename"]);
        $bezinbier =  $conn2->real_escape_string($_POST["bezInBier"]);

        $sql2 = "INSERT INTO Buchung (Buchung_ID, Angebot_ID, Angebot_Typ, userErstell, emailErstell, userBuch, emailBuch ,Datum, Preis, angebotTitel, bezInBier)
                            VALUES ('$buchung_id', '$angebot_id', '$angebot_typ', '$userErstell', '$emailErstell', '$userBuch', '$emailBuch', '$date', '$preis', '$title', '$bezinbier')";
    

        if ($conn2->query($sql2) === TRUE) {

            ?>
                <h1>Du hast erfolgreich gebucht. Viel Spaß!</h1>
                <a href="../categories.php#Werkzeug-Ang">Zurück</a>
                <br>
                <a href="../index.php">Startseite</a>

                <a>Hier ist deine Buchung:</a>
                <br>
                <?php echo $sql2 ?>
            <?php
           

            } else {
            echo '<script type="text/javascript">alert("Es tut uns Leid, das Angebot konnte nicht in die Datenbank aufgenommen werden.");</script>';
            echo "Error: " . $sql2 . "<br>" . $conn2->error;
            
            }

            
}
    $conn2->close();
}

?>