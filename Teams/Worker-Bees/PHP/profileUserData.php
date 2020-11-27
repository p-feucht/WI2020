<?php
$username="";
$email = $image= $angebotID=$title=$image=$vorname="";

include_once ("outsourcedFunctions.php"); 

$connP = createConnToDB();
if($connP==""){
    die("Connection failed: " . $connP->connect_error);
}
else{
// username of table "user" ist an unique attribute thats why we can select max. 1 sample
    $username = $_SESSION["username"];

    //user-account-Data
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
        $endDat = $row["Es ist keine E-Mail-Adresse hinterlegt"];
    }

}
$connP->close();
?>