<?php
$imgData = "";
$content = "";

/*echo "<pre>";
echo "FILES:<br>";
print_r ($_FILES );
echo "</pre>";*/
if ($_FILES['uploaddatei']['error'] == 2) {
    echo '<script type="text/javascript">alert("Die hochgeladene Datei ist zu groß. Bitte wähle ein maximal 90 KB großes Bild.");</script>';
    $valid = false;
} else if ($_FILES['uploaddatei']['name']  <> "") {
    // Ein Datei wurde durch HTML-Formular hochgeladen und kann nun weiterverarbeitet werden
    $extension = strtolower(pathinfo($_FILES['uploaddatei']['name'], PATHINFO_EXTENSION));
    $allowed_extensions = array('png', 'jpg', 'jpeg', 'gif');
    // Prüfen ob erlaubte Dateiendung
    if (!in_array($extension, $allowed_extensions)) {
        echo '<script type="text/javascript">alert("Das Dateiformat ist nicht erlaubt.");</script>';
        $valid = false;
    } else {
        // Wenn Dateiendung erlaubt ist, Dateiname von Sonderzeichen bereinigen
        $_FILES['uploaddatei']['name'] = dateiname_bereinigen($_FILES['uploaddatei']['name']);
        echo 'Dateiname ' .  $_FILES['uploaddatei']['name'];

        if ($_FILES['uploaddatei']['name'] <> '') {
            $localFileName = 'hochgeladeneBilder/' . $_FILES['uploaddatei']['name'];
            //Bild in Unterordner "hochgeladeneBilder" zwischenspeichern 
            if (move_uploaded_file(
                $_FILES['uploaddatei']['tmp_name'],
                $localFileName
            )) {

                echo "<p>Verschieben in Ordner war erfolgreich: ";
                echo '<a href="hochgeladeneBilder/' . $_FILES['uploaddatei']['name'] . '">';
                echo 'hochgeladeneBilder/' . $_FILES['uploaddatei']['name'];
                echo '</a>';

                // $imgData für DB-insert 
                $imgData = addslashes(file_get_contents('hochgeladeneBilder/' . $_FILES['uploaddatei']['name']));
            }
        } else {
            echo 'Dateiname ' .  $_FILES['uploaddatei']['name'];
            echo '<script type="text/javascript">alert("Der Name deiner Datei ist leer und nicht zulässig");</script>';
        }
    }
}

function dateiname_bereinigen($dateiname)
{
    // erwünschte Zeichen erhalten bzw. umschreiben
    //  ä -> ae, ü -> ue, ß -> ss
    $dateiname = strtolower($dateiname);
    $dateiname = str_replace('"', "-", $dateiname);
    $dateiname = str_replace("'", "-", $dateiname);
    $dateiname = str_replace("*", "-", $dateiname);
    $dateiname = str_replace("ß", "ss", $dateiname);
    $dateiname = str_replace("ß", "ss", $dateiname);
    $dateiname = str_replace("ä", "ae", $dateiname);
    $dateiname = str_replace("ä", "ae", $dateiname);
    $dateiname = str_replace("ö", "oe", $dateiname);
    $dateiname = str_replace("ö", "oe", $dateiname);
    $dateiname = str_replace("ü", "ue", $dateiname);
    $dateiname = str_replace("ü", "ue", $dateiname);
    $dateiname = str_replace("Ä", "ae", $dateiname);
    $dateiname = str_replace("Ö", "oe", $dateiname);
    $dateiname = str_replace("Ü", "ue", $dateiname);
    $dateiname = htmlentities($dateiname);
    $dateiname = str_replace("&", "und", $dateiname);
    $dateiname = str_replace(" ", "und", $dateiname);
    $dateiname = str_replace("(", "-", $dateiname);
    $dateiname = str_replace(")", "-", $dateiname);
    $dateiname = str_replace(" ", "-", $dateiname);
    $dateiname = str_replace("'", "-", $dateiname);
    $dateiname = str_replace("/", "-", $dateiname);
    $dateiname = str_replace("?", "-", $dateiname);
    $dateiname = str_replace("!", "-", $dateiname);
    $dateiname = str_replace(":", "-", $dateiname);
    $dateiname = str_replace(";", "-", $dateiname);
    $dateiname = str_replace(",", "-", $dateiname);
    $dateiname = str_replace("--", "-", $dateiname);

    // und nun jagen wir noch die Heilfunktion darüber
    $dateiname = filter_var($dateiname, FILTER_SANITIZE_URL);
    return ($dateiname);
}
