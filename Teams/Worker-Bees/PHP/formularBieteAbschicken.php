<?php


$title = $beschreibung = $vorname = $nachname = $strasse = $hnr = $plz= $ort = $preisProTag1 = $preisProTag2 = $preisBetrag = $a1_bohr = $a2_drechsel = $a3_schleif = $a4_saege = $a5_kleinteil = "";
$valid=TRUE;

//Connection to bplaced server
$servername = "localhost";
$username = "workerbees";
$password = "HKSZ52";
$dbname = "workerbees_db1";



if ($_SERVER["REQUEST_METHOD"] == "POST") {//wenn auf Submit gedrückt führe Folgendes aus

        // Create connection
        $conn = mysqli_connect($servername, $username, $password, $dbname);


            // Check connection
            if (!$conn) {
                die("Connection failed: " . mysqli_connect_error());
            }
            else {
                
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


                    if (!checkIfEmpty("datefilter")){
                    $gesamtzeitraum = $conn->real_escape_string($_POST["datefilter"]);
                    $gesamtzeitraum = str_replace(" ","", $gesamtzeitraum); //whitespaces zwischen Daten entfernen
                    $firstdate =  substr($gesamtzeitraum,0,10);
                    $lastdate =  substr($gesamtzeitraum,11);
                    $beginndatum =  substr($firstdate,6,14).substr($firstdate,3,2).substr($firstdate,0,2);
                    $endedatum =  substr($lastdate,6,14).substr($lastdate,3,2).substr($lastdate,0,2);;
                    }

                   //Beschreibung darf leer sein, daher keine besondere Validierung
                    $beschreibung = $conn->real_escape_string(trim($_POST["beschreibung"]));

                    //Bild Dateiupload
                    include ("dateiupload.php");

                    if (!checkIfEmpty("Vorname")) {
                        $vorname = $conn->real_escape_string($_POST["Vorname"]);
                    }

                    if (!checkIfEmpty("Nachname")) {
                        $nachname = $conn->real_escape_string($_POST["Nachname"]);
                    }

                    if (!checkIfEmpty("Strasse")) {
                        $strasse = $conn->real_escape_string($_POST["Strasse"]);
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

                    //Session abfragen um Name des Erstellers zu speichern
                   $username = $_SESSION["username"];
    

                    //je nachdem welcher radioButton gedrückt wurde zusätzliche Variablen behandeln
                    $radioAnswer = $_POST['kategorie']; 
                    
                    if ($radioAnswer == "Werkzeug") {          
                       
                        //Preis ist kein zwingend erforderliches Feld
                        $preisProTag1 = $conn->real_escape_string($_POST["PreisProTag1"]);
                    
                        $bierBez1 = $conn->real_escape_string($_POST["bierBez1"]);

                        if($valid==TRUE){
                            $sql = "INSERT INTO AngebotWerkzeug (ATitel, ABeginndat, AEndedat, ABeschreibung, Vorname, Nachname, Strasse, Hausnummer, PLZ, Ort, Bild, usernameErsteller, PreisProTag, BezInBier)
                            VALUES ('$title', $beginndatum, $endedatum, '$beschreibung', '$vorname', '$nachname', '$strasse', '$hnr', '$plz', '$ort', '{$imgData}' , '$username', '$preisProTag1', '$bierBez1')";

                            if ($conn->query($sql) === TRUE) {
                                $title = $gesamtzeitraum = $beschreibung = $vorname = $nachname = $strasse = $hnr = $plz= $ort = $preisProTag1 ="";
                                echo '<script type="text/javascript">alert("Dein Angebot wurde aufgenommen. Vielen Dank!");</script>';
                            } else {
                                echo '<script type="text/javascript">alert("Es tut uns Leid, das Angebot konnte nicht in die Datenbank aufgenommen werden.");</script>';
                            }
                        }
                        else{
                            echo '<script type="text/javascript">alert("Deine Angaben sind nicht vollständig oder nicht valide. Bitte ergänze deine Angaben");</script>';}
                    }

                    elseif($radioAnswer == "Werkstatt"){
                        // Preis ist kein erforderliches Feld 
                        $preisProTag2 = $conn->real_escape_string($_POST["PreisProTag2"]);
                        
                        //checkboxes
                        $bierBez2 = $conn->real_escape_string($_POST["bierBez2"]);
                        $a1_bohr = $conn->real_escape_string($_POST["a1_Bohr"]);
                        $a2_drechsel = $conn->real_escape_string($_POST["a2_Drechsel"]);
                        $a3_schleif = $conn->real_escape_string($_POST["a3_Schleif"]);
                        $a4_saege = $conn->real_escape_string($_POST["a4_Saege"]);
                        $a5_kleinteil = $conn->real_escape_string($_POST["a5_Kleinteil"]);
                        
                        if($valid==true){
                        
                            $sql = "INSERT INTO AngebotWerkstatt (ATitel, ABeginndat, AEndedat, ABeschreibung, Vorname, Nachname, Strasse, Hausnummer, PLZ, Ort, Bild, usernameErsteller, PreisProTag, BezInBier, ABohr, ADrechsel, ASchleif, ASaege, AKleinteil)
                            VALUES ('$title', $beginndatum, $endedatum, '$beschreibung', '$vorname', '$nachname', '$strasse', '$hnr', '$plz', '$ort','{$imgData}','$username', '$preisProTag2', '$bierBez2', '$a1_bohr', '$a2_drechsel', '$a3_schleif', '$a4_saege', '$a5_kleinteil')";
                            //echo $sql;
                        
                            if ($conn->query($sql) === TRUE) {
                                $title = $gesamtzeitraum = $beschreibung = $vorname = $nachname = $strasse = $hnr = $plz= $ort=$preisProTag2="";
                                echo '<script type="text/javascript">alert("Dein Angebot wurde aufgenommen. Vielen Dank!");</script>';
                                
                            } else {
                               
                                echo '<script type="text/javascript">alert("Es tut uns Leid, das Angebot konnte nicht in die Datenbank aufgenommen werden.");</script>';
                            } 
                        } else{
                            echo '<script type="text/javascript">alert("Deine Angaben sind nicht vollständig oder nicht valide.");</script>';}   
                    }

                    elseif($radioAnswer == "Dienstleistung") {
                        
                        $bezahlart = $conn->real_escape_string($_POST['Bezahlart']);
                        
                        $preisBetrag = $conn->real_escape_string($_POST['Preis']);
                        $bierBez3 = $conn->real_escape_string($_POST['bierBez3']);


                            $sql = "INSERT INTO AngebotDienstleistung (ATitel,  ABeginndat, AEndedat, ABeschreibung, Vorname, Nachname, Strasse, Hausnummer, PLZ, Ort, Bild, usernameErsteller, Preisart, Preis, BezInBier)
                            VALUES ('$title', $beginndatum, $endedatum, '$beschreibung', '$vorname', '$nachname', '$strasse', '$hnr', '$plz', '$ort', '{$imgData}' , '$username', '$bezahlart', '$preisBetrag', '$bierBez3')";
                      

                            if($valid==true){
                                if ($conn->query($sql) === TRUE) {
                                    $title = $gesamtzeitraum = $beschreibung = $vorname = $nachname = $strasse = $hnr = $plz= $ort=$preisBetrag="";
                                    echo '<script type="text/javascript">alert("Vielen Dank, das Angebot wurde aufgenommen");</script>';
                                } 
                                else {
                                    echo '<script type="text/javascript">alert("Es tut uns Leid, das Angebot konnte nicht in die Datenbank aufgenommen werden.");</script>';
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
    

?>

