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

        //create random booking number
        $number = rand(1000, 10000) + rand(1000, 10000) + rand(1000, 10000); 
        $id = "WZcard_" . (string)$orderID;
        $buchung_id = $id.$number; //combine

        // get session information
        $userBuch = $_SESSION["username"];
        $emailBuch = $_SESSION["email"];

        // get information from booking submission
        $angebot_id = "";
        $angebot_typ = "Werkzeug";
        $emailErstell = "";
        $date = $conn2->real_escape_string($_POST["Date"]);
        $bezinbier =  $conn2->real_escape_string($_POST["bezInBier"]);

        $sql2 = "INSERT INTO Buchung (Buchung_ID, Angebot_ID, Angebot_Typ, userErstell, emailErstell, userBuch, emailBuch ,Datum, Preis, angebotTitel, bezInBier)
                            VALUES ('$buchung_id', '$angebot_id', '$angebot_typ', '$userErstell', '$emailErstell', '$userBuch', '$emailBuch', '$date', '$preis', '$title', '$bezinbier')";
    

        if ($conn2->query($sql2) === TRUE) {

            ?> 
               <!-- create "booked" page --> 
                <!doctype html>
                <html class="no-js" lang="">

                <head>
                    <meta charset="utf-8">
                    <title>Worker Bees</title>
                    <meta name="description" content="">
                    <link rel="icon" href="../images/logoBiene.png" />
                    <link href="../CSS/blog.css" rel="stylesheet">

                </head>

                <body>

                    <?php include "header.php"; ?>
                    
                    <div class="blog-content">
                        <h1>Du hast erfolgreich gebucht. Viel Spaß!</h1>
                        <button href="../categories.php#Werkzeug-Ang">Zurück</button>
                        <button href="../index.php">Startseite</button>

                        <a>Hier ist deine Buchung:</a>
                        <br>
                        <?php echo $sql2 ?>
                    </div>

                    <?php include "footer.php"; ?>

                </body>

                </html>
            <?php
           

            } else {
            echo '<script type="text/javascript">alert("Es tut uns Leid, das Angebot konnte nicht in die Datenbank aufgenommen werden.");</script>';
            echo "Error: " . $sql2 . "<br>" . $conn2->error;
            
            }

            
}
    $conn2->close();
}

?>