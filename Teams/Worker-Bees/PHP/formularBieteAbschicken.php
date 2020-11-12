<?php
//include 'header.php';
// good example can be found here: https://www.cloudways.com/blog/custom-php-mysql-contact-form/

//error-variables for validation
$title = $beschreibung = $zeitraum = $vorname = $nachname = $strasse = $hnr = $plz= $ort = $preisProTag1 = $preisProTag2 = $preisBetrag = $a1_bohr = $a2_drechsel = $a3_schleif = $a4_saege = $a5_kleinteil = "";
$valid=TRUE;

//Connection to bplaced server
$servername = "localhost";
$username = "workerbees";
$password = "HKSZ52";
$dbname = "workerbees_db1";


// Username Ersteller aus 

//$sql_2 = "SELECT password FROM user where username = '$username'";






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
                //echo "Connected successfully";
                //echo "<br>";
                
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
                   //Beschreibung darf leer sein
                    /*if (!checkIfEmpty("beschreibung")) {*/
                        $beschreibung = $conn->real_escape_string(trim($_POST["beschreibung"]));
                    /*}*/

                    //Bild Dateiupload
                    include ("dateiupload.php");

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

                    if (!checkIfEmpty("PLZ")AND(is_numeric($_POST["PLZ"]))) {
                        $hilfsvar = $conn->real_escape_string($_POST["PLZ"]);
                        if($hilfsvar>0){
                            $plz=$hilfsvar;
                        }
                    }
                  
                    if(!checkIfEmpty("Ort")){
                        $ort = $conn->real_escape_string($_POST["Ort"]);
                    }

                    //Session abfragen um name des Erstellers zu speichern
                   $username = $_SESSION["username"];
    

                    //je nachdem welcher radioButton gedrückt wurde zusätzliche Variablen behandeln
                    $radioAnswer = $_POST['kategorie'];  //oder: if (isset($kategorie) && $kategorie=="Werkzeug"){ echo WZ;}...
                    
                    if ($radioAnswer == "Werkzeug") {          
                        //echo 'You chose Werkzeug';  
                        
                        //if(!checkIfEmpty("PreisProTag")AND(is_numeric($_POST["PreisProTag"])AND($_POST["PreisProTag"]>0)) {

                            $preisProTag1 = $conn->real_escape_string($_POST["PreisProTag1"]);
                       // }
                        
                        $bierBez1 = $conn->real_escape_string($_POST["bierBez1"]);

                        if($valid==TRUE){
                            $sql = "INSERT INTO AngebotWerkzeug (ATitel, AZeitraum, ABeschreibung, Vorname, Nachname, Strasse, Hausnummer, PLZ, Ort, Bild, usernameErsteller, PreisProTag, BezInBier)
                            VALUES ('$title', $zeitraum, '$beschreibung', '$vorname', '$nachname', '$strasse', '$hnr', '$plz', '$ort', '{$imgData}' , '$username', '$preisProTag1', '$bierBez1')";

                            //echo $sql;
                            //echo "<br>";

                            if ($conn->query($sql) === TRUE) {
                                echo '<script type="text/javascript">alert("Dein Angebot wurde aufgenommen. Vielen Dank!");</script>';
                            /*echo "New record created successfully";
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
                            echo $bierBez1;*/
                            } else {
                                echo '<script type="text/javascript">alert("Es tut uns Leid, das Angebot konnte nicht in die Datenbank aufgenommen werden.");</script>';
                                echo "Error: " . $sql . "<br>" . $conn->error;
                         
                            }
                        }
                        else{
                            echo '<script type="text/javascript">alert("Deine Angaben sind nicht vollständig oder nicht valide. Bitte ergänze deine Angaben");</script>';}
                    }

                    elseif($radioAnswer == "Werkstatt"){
                        //echo 'You chose Werkstatt';   
                        //if(!checkIfEmpty("PreisProTag")){
                            $preisProTag2 = $conn->real_escape_string($_POST["PreisProTag2"]);
                        //}
                        //else{
                        //    $valid=FALSE;
                        //}
                        
                        //checkboxes
                        $bierBez2 = $conn->real_escape_string($_POST["bierBez2"]);
                        $a1_bohr = $conn->real_escape_string($_POST["a1_Bohr"]);
                        $a2_drechsel = $conn->real_escape_string($_POST["a2_Drechsel"]);
                        $a3_schleif = $conn->real_escape_string($_POST["a3_Schleif"]);
                        $a4_saege = $conn->real_escape_string($_POST["a4_Saege"]);
                        $a5_kleinteil = $conn->real_escape_string($_POST["a5_Kleinteil"]);
                        
                        if($valid==true){
                        
                            $sql = "INSERT INTO AngebotWerkstatt (ATitel, AZeitraum, ABeschreibung, Vorname, Nachname, Strasse, Hausnummer, PLZ, Ort, Bild, usernameErsteller, PreisProTag, BezInBier, ABohr, ADrechsel, ASchleif, ASaege, AKleinteil)
                            VALUES ('$title', $zeitraum, '$beschreibung', '$vorname', '$nachname', '$strasse', '$hnr', '$plz', '$ort','{$imgData}','$username', '$preisProTag2', '$bierBez2', '$a1_bohr', '$a2_drechsel', '$a3_schleif', '$a4_saege', '$a5_kleinteil')";
                            //echo $sql;
                        
                            if ($conn->query($sql) === TRUE) {
                                echo '<script type="text/javascript">alert("Dein Angebot wurde aufgenommen. Vielen Dank!");</script>';
                                
                            } else {
                                /*echo "Ausgabe zur Fehlersuche. Folgende Werte stehen in den PHP-Variablen:";
                                echo "<br>";
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
                                echo $preisProTag2;
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
                                echo $a5_kleinteil;*/
                                echo "Error: " . $sql . "<br>" . $conn->error;
                                echo '<script type="text/javascript">alert("Es tut uns Leid, das Angebot konnte nicht in die Datenbank aufgenommen werden.");</script>';
                            } 
                        } else{
                            echo '<script type="text/javascript">alert("Deine Angaben sind nicht vollständig oder nicht valide.");</script>';}   
                    }

                    elseif($radioAnswer == "Dienstleistung") {
                        
                        $bezahlart = $conn->real_escape_string($_POST['Bezahlart']);
                        
                        $preisBetrag = $conn->real_escape_string($_POST['Preis']);
                        $bierBez3 = $conn->real_escape_string($_POST['bierBez3']);

                            $sql = "INSERT INTO Dienstleistung (ATitel, AZeitraum, ABeschreibung, Vorname, Nachname, Strasse, Hausnummer, PLZ, Ort, Bild, usernameErsteller, Preisart, Preis, BezInBier)
                            VALUES ('$title', $zeitraum, '$beschreibung', '$vorname', '$nachname', '$strasse', '$hnr', '$plz', '$ort', '{$imgData}' ,'$bezahlart', '$preisBetrag', '$bierBez3')";
                        
                            //echo $sql;
                            //echo "<br>";

                            if($valid==true){
                                if ($conn->query($sql) === TRUE) {
                                    echo '<script type="text/javascript">alert("Vielen Dank, das Angebot wurde aufgenommen");</script>';
                                } 
                                else {
                                    echo '<script type="text/javascript">alert("Es tut uns Leid, das Angebot konnte nicht in die Datenbank aufgenommen werden.");</script>';
                                    echo "Error: " . $sql . "<br>" . $conn->error;
                                }
                            }
                            else{
                                echo '<script type="text/javascript">alert("Deine Angaben sind nicht vollständig oder nicht valide.");</script>';
                            }
                    }
                }
                
                $conn->close();    
            }
}
    		

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
    
   //Dies war nach dem Preis input feld bei value ="<?php echo htmlspecialchars($preisBetragErr);? >"  
?>

