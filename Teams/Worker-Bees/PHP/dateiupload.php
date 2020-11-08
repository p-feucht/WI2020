<?php
$imgData="";
$content="";

echo "<pre>";
echo "FILES:<br>";
print_r ($_FILES );
echo "</pre>";

if ( $_FILES['uploaddatei']['name']  <> "" )
{
    // Datei wurde durch HTML-Formular hochgeladen
    // und kann nun weiterverarbeitet werden

    // Kontrolle, ob Dateityp zulässig ist
    $zugelassenedateitypen = array("image/png", "image/jpeg", "image/gif");

    if ( ! in_array( $_FILES['uploaddatei']['type'] , $zugelassenedateitypen ))
    {
        echo '<script type="text/javascript">alert("Der Dateityp deines Bilds ist nicht zugelassen");</script>';
        $valid = false; //obwohl Bild nicht unbedingt erforderlich ist um ein Angebot zu stellen, hier verhindern, dass Rest in DB gespeichert wird, da User vllt ein anderes Bild hochladen möchte.  
    }
    else
    {
        // Test ob Dateiname in Ordnung
        $_FILES['uploaddatei']['name'] = dateiname_bereinigen($_FILES['uploaddatei']['name']);

        if ( $_FILES['uploaddatei']['name'] <> '' )
        {
            $localFileName='hochgeladeneBilder/'. $_FILES['uploaddatei']['name'];
            //Bild in Unterordner "hochgeladeneBilder" speichern 
            if (move_uploaded_file (
                 $_FILES['uploaddatei']['tmp_name'] , $localFileName )){

                echo "<p>Verschieben in Ordner war erfolgreich: ";
                echo '<a href="hochgeladenes/'. $_FILES['uploaddatei']['name'] .'">';
                echo 'hochgeladeneBilder/'. $_FILES['uploaddatei']['name'];
                echo '</a>';    

                // $imgData für DB-insert 
                $imgData = addslashes(file_get_contents('hochgeladeneBilder/'. $_FILES['uploaddatei']['name']));
        
            
            }
        }
        else
        {
            echo'<script type="text/javascript">alert("Der Name deiner Datei ist leer und nicht zulässig");</script>';
        }
    }
}

function dateiname_bereinigen($dateiname)
{
    // erwünschte Zeichen erhalten bzw. umschreiben
    //  ä -> ae, ü -> ue, ß -> ss
    $dateiname = strtolower ( $dateiname );
    $dateiname = str_replace ('"', "-", $dateiname );
    $dateiname = str_replace ("'", "-", $dateiname );
    $dateiname = str_replace ("*", "-", $dateiname );
    $dateiname = str_replace ("ß", "ss", $dateiname );
    $dateiname = str_replace ("ß", "ss", $dateiname );
    $dateiname = str_replace ("ä", "ae", $dateiname );
    $dateiname = str_replace ("ä", "ae", $dateiname );
    $dateiname = str_replace ("ö", "oe", $dateiname );
    $dateiname = str_replace ("ö", "oe", $dateiname );
    $dateiname = str_replace ("ü", "ue", $dateiname );
    $dateiname = str_replace ("ü", "ue", $dateiname );
    $dateiname = str_replace ("Ä", "ae", $dateiname );
    $dateiname = str_replace ("Ö", "oe", $dateiname );
    $dateiname = str_replace ("Ü", "ue", $dateiname );
    $dateiname = htmlentities ( $dateiname );
    $dateiname = str_replace ("&", "und", $dateiname );
    $dateiname = str_replace (" ", "und", $dateiname );
    $dateiname = str_replace ("(", "-", $dateiname );
    $dateiname = str_replace (")", "-", $dateiname );
    $dateiname = str_replace (" ", "-", $dateiname );
    $dateiname = str_replace ("'", "-", $dateiname );
    $dateiname = str_replace ("/", "-", $dateiname );
    $dateiname = str_replace ("?", "-", $dateiname );
    $dateiname = str_replace ("!", "-", $dateiname );
    $dateiname = str_replace (":", "-", $dateiname );
    $dateiname = str_replace (";", "-", $dateiname );
    $dateiname = str_replace (",", "-", $dateiname );
    $dateiname = str_replace ("--", "-", $dateiname );

    // und nun jagen wir noch die Heilfunktion darüber
    $dateiname = filter_var($dateiname, FILTER_SANITIZE_URL);
    return ($dateiname);
}

?>
