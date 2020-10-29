<?php
// good example can be found here: https://www.cloudways.com/blog/custom-php-mysql-contact-form/
$servername = "localhost";
$username = "feucht-wwids19_admin";
$password = "wwids19kurs";
$dbname = "feucht-wwids19_db1";

// Create connection
$conn = mysqli_connect($servername, $username, $password, $dbname);

// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
else {
    echo "Connected successfully";
    echo "<br>";
    $vorname = $conn->real_escape_string($_POST["vorname"]);
    $nachname = $conn->real_escape_string($_POST["nachname"]);
    $email = $conn->real_escape_string($_POST["email"]);
    $nachricht = $conn->real_escape_string($_POST["nachricht"]);

    $sql = "INSERT INTO wids19_form (vorname, nachname, email, nachricht)
    VALUES ('$vorname', '$nachname', '$email', '$nachricht')";
    
    echo $sql;
    echo "<br>";

    if ($conn->query($sql) === TRUE) {
        echo "New record created successfully";
        echo "<br>";
        echo "Entries written:";
        echo $vorname;
        echo "<br>";
        echo $nachname;
        echo "<br>";
        echo $email;
        echo "<br>";
        echo $nachricht;
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
    
    $conn->close();    
}
// MySQL Database settings
//  id	        int(11)			Nein		auto_increment	
//	vorname	    varchar(256)	utf8_bin	Nein			
//	nachname	varchar(256)	utf8_bin	Nein			
//	email	    varchar(256)	utf8_bin	Nein	
//	nachricht	varchar(256)	utf8_bin	Nein			
?>