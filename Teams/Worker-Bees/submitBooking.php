<?php
session_start();

if (!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true) {
    header("location: ../login.php");
    exit;
}
?>

<!-- create "booked" page -->
<!doctype html>
<html class="no-js" lang="">

<head>
    <meta charset="utf-8">
    <title>Worker Bees</title>
    <meta name="description" content="">
    <link rel="icon" href="../images/logoBiene.png" />
    <link href="./CSS/submitBooking.css" rel="stylesheet">

</head>

<body>

    <?php include "PHP/header.php"; ?>

    <?php
    //Connection to bplaced server
    $servername = "localhost";
    $username = "workerbees";
    $password = "HKSZ52";
    $dbname = "workerbees_db1";

    if ($_SERVER["REQUEST_METHOD"] == "POST") { //wenn auf Submit gedrückt wird führe Folgendes aus

        $conn2 = new mysqli($servername, $username, $password, $dbname);

        // Check connection
        // Check connection
        if ($conn2->connect_error) {
            die("Connection failed: " . $conn2->connect_error);
        } else {

            $orderID = $conn2->real_escape_string($_POST["orderID"]); // take card id to identify offer

            // get session information
            $userBuch = $_SESSION["username"];
            $emailBuch = $_SESSION["email"];
            $angebot_typ = $_SESSION["category"];

            if ($angebot_typ == "Werkzeug") { // get information about specific order from database based on category
                $getOrderSql = "SELECT ATitel, PLZ, Ort, usernameErsteller, PreisProTag FROM AngebotWerkzeug WHERE Werkzeug_ID = $orderID";
                $preislabel = "PreisProTag";
            } else if ($angebot_typ == "Werkstatt") { // get information about specific order from database based on category
                $getOrderSql = "SELECT ATitel, PLZ, Ort, usernameErsteller, PreisProTag FROM AngebotWerkstatt WHERE Werkstatt_ID = $orderID";
                $preislabel = "PreisProTag";
            } else if ($angebot_typ == "Dienstleistung") { // get information about specific order from database based on category
                $getOrderSql = "SELECT ATitel, PLZ, Ort, usernameErsteller, Preis FROM AngebotDienstleistung WHERE Dienstleistung_ID = $orderID";
                $preislabel = "Preis";
            }

            if ($conn2->query($getOrderSql) === FALSE) { //create mistake page if order was not correctly found

    ?>
                <div class="blog-content">
                    <h1>Etwas ist schiefgelaufen.</h1><br>

                    <h3>Falls das Problem bestehen sollte, schreib uns doch bitte eine mail.</h3>
                    <input type='hidden' name='Fehlertyp' value='<?php echo "Error: " . $getOrderSql . "<br>" . $conn2->error; ?>' />
                    <?php

                } else {
                    $result = $conn2->query($getOrderSql);

                    $orderRow = $result->fetch_assoc();
                    $title = $orderRow["ATitel"];
                    $userErstell = $orderRow["usernameErsteller"];
                    $preis = $orderRow["$preislabel"];

                    //create random booking number
                    $number = rand(1000, 10000) + rand(1000, 10000) + rand(1000, 10000);
                    $buchung_id = (string)$orderID . (string)$number;

                    // get information from booking submission
                    $angebot_id = "";
                    $emailErstell = "";
                    $date = $conn2->real_escape_string($_POST["Date"]);
                    $bezinbier =  $conn2->real_escape_string($_POST["bezInBier"]);

                    $sql2 = "INSERT INTO Buchung (Buchung_ID, Angebot_ID, Angebot_Typ, userErstell, emailErstell, userBuch, emailBuch ,Datum, Preis, angebotTitel, bezInBier)
                            VALUES ('$buchung_id', '$order_id', '$angebot_typ', '$userErstell', '$emailErstell', '$userBuch', '$emailBuch', '$date', '$preis', '$title', '$bezinbier')";


                    if ($conn2->query($sql2) === TRUE) {

                    ?>
                        <div class="blog-content">
                            <h1>Vielen Dank für deine Buchung, <?php echo $userBuch ?>. Viel Spaß!</h1><br>

                            <h3>Deine Buchungsnummer ist <?php echo $buchung_id ?>.</h3>

                        <?php

                    } else {
                        ?>
                            <div class="blog-content">
                                <h1>Etwas ist schiefgelaufen.</h1><br>

                                <h3>Falls das Problem bestehen sollte, schreib uns doch bitte eine mail.</h3>
                                <input type='hidden' name='Fehlertyp' value='<?php echo "Error: " . $sql2 . "<br>" . $conn2->error; ?>' />

                    <?php

                    }
                }
                $conn2->close();
            }
        }

        if ($angebot_typ == "Werkzeug") { // make link based on which page person is coming from
                    ?> <a class="button" href="werkzeugPage.php">Zurück</a> <?php
                                                        } else if ($angebot_typ == "Werkstatt") {
                                                            ?> <a class="button" href="werkstattPage.php">Zurück</a> <?php
                                                            } else if ($angebot_typ == "Dienstleistung") {
                                                                ?> <a class="button" href="dienstleistungPage.php">Zurück</a> <?php
                                                                }
                                                                    ?>





                <a class="button" href="index.php">Startseite</a>

                            </div>

                            <?php include "PHP/footer.php"; ?>

</body>

</html>