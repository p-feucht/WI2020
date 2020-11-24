<?php
$username="";
$email = "";

//Connection to bplaced server
$servername = "localhost";
$username = "workerbees";
$password = "HKSZ52";
$dbname = "workerbees_db1";

// Create connection
$connP = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($connP->connect_error) {
    die("Connection failed: " . $connP->connect_error);
}
$username = $_SESSION["username"];

if($username!=""){
    $sql = "SELECT username, email FROM user WHERE username='$username'";
    $result = $connP->query($sql);

    if ($result->num_rows > 0) {
        // output data of each row
        while ($row = $result->fetch_assoc()) {

            $username = $row["username"];
            $email = $row["email"];
        }
    }
}
else{
    $username = "Es ist kein Benutzername hinterlegt";
    $endDat = $row["Es ist keine E-Mail-Adresse hinterlegt"];}

?>