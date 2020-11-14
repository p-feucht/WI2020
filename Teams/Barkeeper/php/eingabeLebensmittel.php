<?php
$username = "barkeeper_dbuser";
$password = "JcNgS55uY2jQJK4a";
$dbname = "barkeeper_cocktails";

// Create connection
$conn = mysqli_connect($servername, $username, $password, $dbname);

// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
else {
    echo "Connected successfully";
    echo "<br>";
    $alkohol1 = $conn->real_escape_string($_POST["Alkohol1"]);
    $alkohol2 = $conn->real_escape_string($_POST["Alkohol2"]);
    $saft1 = $conn->real_escape_string($_POST["Saft1"]);
    $saft2 = $conn->real_escape_string($_POST["Saft2"]);
    $grünzeug1 = $conn->real_escape_string($_POST["Grünzeug1"]);
    $grünzeug2 = $conn->real_escape_string($_POST["Grünzeug2"]);
}
$sql = "SELECT *
        FROM Rezept_RT rt
        WHERE rt.zutat LIKE '%Tequila%' OR rt.zutat LIKE '%Orangenlikör%' 
		    OR rt.zutat LIKE '%Limettensaft%' 
			OR rt.zutat LIKE '%Crushed ICE%' 
			OR rt.zutat LIKE '%Limette%';;";
echo $sql;
echo "<br>";                                                                

if ($result = $conn->query($sql)) {
    foreach( $result as $row ){
        echo $row[ 'cocktails_id' ] . " " . $row[ 'zutat' ] . " " . $row["menge"] . "<br>";
    }
    $result->close();
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

?>