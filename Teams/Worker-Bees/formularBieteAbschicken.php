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
    
    //wenn kein RadioButton gewählt, beenden und Fehlernachricht ausgeben
    if(!isset($_POST["kategorie"])){
        die ("Fehler: Auswahl einer Angebotskategorie erforderlich.");
    }

    else{
        $sql="";

        //Variablen, die alle Angebotsarten enthalten behandeln
        $title = $conn->real_escape_string($_POST["title"]); //der Wert der in Titel geschriben wurde wird aufbereitet und in Variable geschrieben
        $zeitraum = $conn->real_escape_string($_POST["datefilter"]);
        $beschreibung = $conn->real_escape_string($_POST["beschreibung"]);
        //Bild Datei fehlt noch
        $vorname = $conn->real_escape_string($_POST["Vorname"]); //der Wert der in Vorname geschriben wurde wird aufbereitet und in Variable geschrieben
        $nachname = $conn->real_escape_string($_POST["Nachname"]);
        $straße = $conn->real_escape_string($_POST["Straße"]);
        $hnr = $conn->real_escape_string($_POST["Hnr"]);
        $plz = $conn->real_escape_string($_POST["PLZ"]);
        $ort = $conn->real_escape_string($_POST["Ort"]);
        //Username des Erstellers
        // Erstelldatum?

        //je nachdem welcher radioButton gedrückt wurde zusätzliche Variablen behandeln
        $radioAnswer = $_POST['kategorie'];  //oder: if (isset($kategorie) && $kategorie=="Werkzeug"){ echo WZ;}...
        
        if ($radioAnswer == "Werkzeug") {          
            echo 'You chose Werkzeug';  
            $preis = $conn->real_escape_string($_POST["PreisProTag"]);
            $bierBez1 = $conn->real_escape_string($_POST["bierBez1"]);

            $sql = "INSERT INTO AngebotWerkzeug (ATitel, AZeitraum, ABeschreibung, Vorname, Nachname, Straße, Hausnummer, PLZ, Ort, PreisProTag, BezInBier)
            VALUES ('$title', $zeitraum, '$beschreibung', '$vorname', '$nachname', '$straße', '$hnr', '$plz', '$ort', '$preis', '$bierBez1')";
        
            echo $sql;
            echo "<br>";

            if ($conn->query($sql) === TRUE) {
            echo "New record created successfully";
            echo "<br>";
            echo "Entries written:";
            echo $title;
            echo "<br>";
            echo $zeitraum;
            echo "<br>";
            echo $beschreibung;
            echo "<br>";
            echo $vorname;
            echo "<br>";
            echo $nachname;
            echo "<br>";
            echo $straße;
            echo "<br>";
            echo $hnr;
            echo "<br>";
            echo $plz;
            echo "<br>";
            echo $ort;
            echo "<br>";
            echo $preis;
            echo "<br>";
            echo $bierBez1;
            } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
            }
        }

        elseif($radioAnswer == "Werkstatt"){
            echo 'You chose Werkstatt';   
            $preis = $conn->real_escape_string($_POST["PreisProTag"]);
            $bierBez2 = $conn->real_escape_string($_POST["bierBez2"]);
            $a1_bohr = $conn->real_escape_string($_POST["a1_Bohr"]);
            $a2_drechsel = $conn->real_escape_string($_POST["a2_Drechsel"]);
            $a3_schleif = $conn->real_escape_string($_POST["a3_Schleif"]);
            $a4_säge = $conn->real_escape_string($_POST["a4_Säge"]);
            $a5_kleinteil = $conn->real_escape_string($_POST["a5_Kleinteil"]);
            

            $sql = "INSERT INTO AngebotWerkstatt (ATitel, AZeitraum, ABeschreibung, Vorname, Nachname, Straße, Hausnummer, PLZ, Ort, PreisProTag, BezInBier, 
            A1_Bohr, A2_Drechsel, A3_Schleif, A4_Säge, A5_Kleinteil)
            VALUES ('$title', $zeitraum, '$beschreibung', '$vorname', '$nachname', '$straße', '$hnr', '$plz', '$ort', '$preis', '$bierBez2', 
            '$a1_bohr', '$a2_drechsel', '$a3_schleif', '$a4_säge', '$a5_kleinteil')";
        
            echo $sql;
            echo "<br>";

            if ($conn->query($sql) === TRUE) {
                echo "New record created successfully";
                echo "<br>";
                echo "Entries written:";
                echo $title;
                echo "<br>";
                echo $zeitraum;
                echo "<br>";
                echo $beschreibung;
                echo "<br>";
                echo $vorname;
                echo "<br>";
                echo $nachname;
                echo "<br>";
                echo $straße;
                echo "<br>";
                echo $hnr;
                echo "<br>";
                echo $plz;
                echo "<br>";
                echo $ort;
                echo "<br>";
                echo $preis;
                echo "<br>";
                echo $bierBez2;
                echo "<br>";
                echo $a1_bohr;
                echo "<br>";
                echo $a2_drechsel;
                echo "<br>";
                echo $a3_schleif;
                echo "<br>";
                echo $a4_säge;
                echo "<br>";
                echo $a5_kleinteil;

            } else {
                echo "Error: " . $sql . "<br>" . $conn->error;
            }
        }

        elseif($radioAnswer == "Dienstleistung") {
            echo 'You chose Dienstleistung';   
            $bezahlart = $conn->real_escape_string($_POST['Bezahlart']);
            $preisBetrag = $conn->real_escape_string($_POST['Preis']);
            $bierBez3 = $conn->real_escape_string($_POST['bierBez3']);

            $sql = "INSERT INTO Dienstleistung (ATitel, AZeitraum, ABeschreibung, Vorname, Nachname, Straße, Hausnummer, PLZ, Ort, Preisart, Preis, BezInBier)
            VALUES ('$title', $zeitraum, '$beschreibung', '$vorname', '$nachname', '$straße', '$hnr', '$plz', '$ort', '$bezahlart', '$preisBetrag', '$bierBez3')";
        
            echo $sql;
            echo "<br>";

            if ($conn->query($sql) === TRUE) {
                echo "New record created successfully";
                echo "<br>";
                echo "Entries written:";
                echo $title;
                echo "<br>";
                echo $zeitraum;
                echo "<br>";
                echo $beschreibung;
                echo "<br>";
                echo $vorname;
                echo "<br>";
                echo $nachname;
                echo "<br>";
                echo $straße;
                echo "<br>";
                echo $hnr;
                echo "<br>";
                echo $plz;
                echo "<br>";
                echo $ort;
                echo "<br>";
                echo $bezahlart;
                echo "<br>";
                echo $preisBetrag;
                echo "<br>";
                echo $bierBez3;
            } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
            }
        }
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