<?php
//include 'header.php';
// good example can be found here: https://www.cloudways.com/blog/custom-php-mysql-contact-form/

//error-variables for validation
$titleErr = $zeitraumErr = $beschreibErr = $vornameErr = $nachnameErr = $strasseErr = $hnrErr = $plzErr = $ortErr = $preisProTagErr = $preisBetragErr = "";
$title = $beschreibung = $zeitraum = $vorname = $nachname = $strasse = $hnr = $plz= $ort = $preisProTag = $preisBetrag = "";
$valid=TRUE;

//Connection to bplaced server
$servername = "localhost";
$username = "workerbees";
$password = "HKSZ52";
$dbname = "workerbees_db1";

if ($_SERVER["REQUEST_METHOD"] == "POST") {//wenn auf Submit gedrückt führe Folgendes aus

//if(isset($_POST['formularFuerAngebot'])){
    //Connection to xampp 
    /*$servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "workerxampp";*/

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

                     //Validation  
                    if (!checkIfEmpty("title")) {
                        $title = $conn->real_escape_string($_POST["title"]);
                    }

                    /*if (empty($_POST["zeitraum"])) {
                        $zeitraumErr = "Bitte Zeitraum eingeben";
                        $valid=FALSE;
                    }
                    else {*/
                    $zeitraum = $conn->real_escape_string($_POST["datefilter"]);
                   /* }*/
                    if (!checkIfEmpty("beschreibung")) {
                        $beschreibung = $conn->real_escape_string(trim($_POST["beschreibung"]));
                    }

                    //Bild Datei fehlt noch

                    if (!checkIfEmpty("Vorname")) {
                        $vorname = $conn->real_escape_string($_POST["Vorname"]);//der Wert der in Vorname geschriben wurde wird aufbereitet und in Variable geschrieben
                    }

                    if (!checkIfEmpty("Nachname")) {
                        $nachname = $conn->real_escape_string($_POST["Nachname"]);//der Wert der in Nachname geschriben wurde wird aufbereitet und in Variable geschrieben
                    }

                    if (!checkIfEmpty("Strasse")) {
                        $strasse = $conn->real_escape_string($_POST["Strasse"]);//der Wert der in Straße geschriben wurde wird aufbereitet und in Variable geschrieben
                    }
                    
                    if(!checkIfEmpty("Hnr")){
                        $hnr = $conn->real_escape_string($_POST["Hnr"]);
                    }

                    if (!checkIfEmpty("PLZ")) {
                        $plz = $conn->real_escape_string($_POST["PLZ"]);
                    }
                  
                    if(!checkIfEmpty("Ort")){
                        $ort = $conn->real_escape_string($_POST["Ort"]);
                    }

                    //Username des Erstellers fehlt noch
                    // Erstellzeitpunkt timestamp automatisch in db?

                    //je nachdem welcher radioButton gedrückt wurde zusätzliche Variablen behandeln
                    $radioAnswer = $_POST['kategorie'];  //oder: if (isset($kategorie) && $kategorie=="Werkzeug"){ echo WZ;}...
                    
                    if ($radioAnswer == "Werkzeug") {          
                        echo 'You chose Werkzeug';  
                        
                        if(!checkIfEmpty("PreisProTag")) {

                            $preisProTag = $conn->real_escape_string($_POST["PreisProTag"]);
                           
                        }
                        
                        $bierBez1 = $conn->real_escape_string($_POST["bierBez1"]);

                        //if($valid==TRUE){
                            $sql = "INSERT INTO AngebotWerkzeug (ATitel, AZeitraum, ABeschreibung, Vorname, Nachname, Strasse, Hausnummer, PLZ, Ort, PreisProTag, BezInBier)
                            VALUES ('$title', $zeitraum, '$beschreibung', '$vorname', '$nachname', '$strasse', '$hnr', '$plz', '$ort', '$preisProTag', '$bierBez1')";
                        
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
                            echo $strasse;
                            echo "<br>";
                            echo $hnr;
                            echo "<br>";
                            echo $plz;
                            echo "<br>";
                            echo $ort;
                            echo "<br>";
                            echo $preisProTag;
                            echo "<br>";
                            echo $bierBez1;
                            } else {
                            echo "Error: " . $sql . "<br>" . $conn->error;
                            }
                       // }
                    }

                    elseif($radioAnswer == "Werkstatt"){
                        echo 'You chose Werkstatt';   
                        $preisProTag = $conn->real_escape_string($_POST["PreisProTag"]);
                        $bierBez2 = $conn->real_escape_string($_POST["bierBez2"]);
                        $a1_bohr = $conn->real_escape_string($_POST["a1_Bohr"]);
                        $a2_drechsel = $conn->real_escape_string($_POST["a2_Drechsel"]);
                        $a3_schleif = $conn->real_escape_string($_POST["a3_Schleif"]);
                        $a4_saege = $conn->real_escape_string($_POST["a4_Saege"]);
                        $a5_kleinteil = $conn->real_escape_string($_POST["a5_Kleinteil"]);
                        

                        $sql = "INSERT INTO AngebotWerkstatt (ATitel, AZeitraum, ABeschreibung, Vorname, Nachname, Strasse, Hausnummer, PLZ, Ort, PreisProTag, BezInBier, 
                        A1_Bohr, A2_Drechsel, A3_Schleif, A4_Saege, A5_Kleinteil)
                        VALUES ('$title', $zeitraum, '$beschreibung', '$vorname', '$nachname', '$strasse', '$hnr', '$plz', '$ort', '$preisProTag', '$bierBez2', 
                        '$a1_bohr', '$a2_drechsel', '$a3_schleif', '$a4_saege', '$a5_kleinteil')";
                    
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
                            echo $strasse;
                            echo "<br>";
                            echo $hnr;
                            echo "<br>";
                            echo $plz;
                            echo "<br>";
                            echo $ort;
                            echo "<br>";
                            echo $preisProTag;
                            echo "<br>";
                            echo $bierBez2;
                            echo "<br>";
                            echo $a1_bohr;
                            echo "<br>";
                            echo $a2_drechsel;
                            echo "<br>";
                            echo $a3_schleif;
                            echo "<br>";
                            echo $a4_saege;
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

                        $sql = "INSERT INTO Dienstleistung (ATitel, AZeitraum, ABeschreibung, Vorname, Nachname, Strasse, Hausnummer, PLZ, Ort, Preisart, Preis, BezInBier)
                        VALUES ('$title', $zeitraum, '$beschreibung', '$vorname', '$nachname', '$strasse', '$hnr', '$plz', '$ort', '$bezahlart', '$preisBetrag', '$bierBez3')";
                    
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
                            echo $strasse;
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
}
    //include 'footer.php';

    // MySQL Database settings
    //  id	        int(11)			Nein		auto_increment	
    //	vorname	    varchar(256)	utf8_bin	Nein			
    //	nachname	varchar(256)	utf8_bin	Nein			
    //	email	    varchar(256)	utf8_bin	Nein	
    //	nachricht	varchar(256)	utf8_bin	Nein			

    function checkIfEmpty($nameInputhtml){
        global $valid;
        if (empty(trim($_POST[$nameInputhtml]))) {
            $valid=FALSE;
            return TRUE;
        }
        else {
            return FALSE;
        } 

    }

?>

