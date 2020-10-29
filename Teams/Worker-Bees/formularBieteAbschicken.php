<?php
// good example can be found here: https://www.cloudways.com/blog/custom-php-mysql-contact-form/
$servername = "localhost";
$username = "workerbees";
$password = "HKSZ52";
$dbname = "workerbees_db1";

// Create connection
$conn = mysqli_connect($servername, $username, $password, $dbname);

// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
else {
    echo "Connected successfully";
    echo "<br>";



    //if(isset($_POST["kategorie"]))
    //if (isset($kategorie) && $kategorie=="Werkzeug"){ echo WZ;}
    
    $radioAnswer = $_POST['kategorie'];  
    if ($radioAnswer == "Werkzeug") {          
        echo 'You chose Werkzeug';  
        $preis = $conn->real_escape_string($_POST["PreisProTag"]);
        $bierBez = $conn->real_escape_string($_POST["bierBez"]);
    
    }
    elseif($radioAnswer == "Werkstatt"){
        echo 'You chose Werkstatt';   
        $preis = $conn->real_escape_string($_POST["PreisProTag"]);
        $bierBez = $conn->real_escape_string($_POST["bierBez"]);
        $a1_bohr = $conn->real_escape_string($_POST["a1_Bohr"]);
        $a2_drechsel = $conn->real_escape_string($_POST["a2_Drechsel"]);
        $a3_schleif = $conn->real_escape_string($_POST["a3_Schleif"]);
        $a4_säge = $conn->real_escape_string($_POST["a4_Säge"]);
        $a5_kleinteil = $conn->real_escape_string($_POST[="a5_Kleinteil"]);
    }
    elseif($radioAnswer == "Dienstleistung") {
        echo 'You chose Dienstleistung';   
        $bezahlart = $conn->real_escape_string($_POST['Bezahlart'];
        $preisBetrag = $conn->real_escape_string($_POST['Preis'];

    }else{
        die ("Fehler: Auswahl einer Angebotskategorie erforderlich.");
    }
    $title = $conn->real_escape_string($_POST["title"]); //der Wert der in Titel geschriben wurde wird aufbereitet und in Variable geschrieben
    $zeitraum = $conn->real_escape_string($_POST["datefilter"]);
    $beschreibung = $conn->real_escape_string($_POST["beschreibung"]);
    //Bild Datei fehlt noch
    $vorname = $conn->real_escape_string($_POST["vorname"]); //der Wert der in Vorname geschriben wurde wird aufbereitet und in Variable geschrieben
    $nachname = $conn->real_escape_string($_POST["nachname"]);
    $straße = $conn->real_escape_string($_POST["Straße"]);
    $hnr = $conn->real_escape_string($_POST["Hnr"]);
    $plz = $conn->real_escape_string($_POST["PLZ"]);
    $ort = $conn->real_escape_string($_POST["Ort"]);
    
    
    //Username des Erstellers
    // Erstelldatum

    $sql = "INSERT INTO wwi218_form (vorname, nachname, email, nachricht)
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