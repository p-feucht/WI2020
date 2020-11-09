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

    



    }
    
    
?>

