<?php

session_start();

// Wird geladen, wenn Formular beim Erstellen einer Anzeige submitted wird

if (isset($_POST['submit'])) {
    // Zweite Überprüfung, ob wichtige, benötigte Informationen eingegeben wurden
    if ((!empty($_POST['food'])) and (!empty($_POST['amount'])) and (!empty($_POST['price'])) and ($_POST['amount'] != 0)) {

        require("connectDB.php");
        // Speichern der Formulardaten zum Essen in Variablen
        $food = $_POST['food'];
        $description = $_POST['description'];
        $amount = $_POST['amount'];
        $price = $_POST['price'];
        $date = date("Y-m-d H:i:s");
        $kategorie = $_POST['categorie'];
        $laenderkueche = $_POST['kitchen'];
        // Wenn keine Kategorie oder Küchenrichtung (z.B. italienisch) gewählt wurde, wird sonstiges belegt
        if (!isset($_POST['categorie'])) {
            $kategorie = 'Sonstige';
        }
        if (!isset($_POST['kitchen'])) {
            $laenderkueche = 'Sonstige';
        }
        // Persönliche Kontaktinformationen sind im Formular vorbelegt aus dem Benutzerkonto. 
        // Wenn diese im Formular abgeändert wurden, werden diese Änderungen berücksichtigt
        if (!empty($_POST['nachname'])) {
            $nachname = $_POST['nachname'];
        } else {
            $nachname = $_SESSION['session_lastname'];
        }
        if (!empty($_POST['vorname'])) {
            $vorname = $_POST['vorname'];
        } else {
            $vorname = $_SESSION['session_firstname'];
        }
        if (!empty($_POST['company'])) {
            $company = $_POST['company'];
        } else {
            $company = $_SESSION['session_company'];
        }
        if (!empty($_POST['street'])) {
            $street = $_POST['street'];
        } else {
            $street = $_SESSION['session_street'];
        }
        if (!empty($_POST['hausnummer'])) {
            $hausnummer = $_POST['hausnummer'];
        } else {
            $hausnummer = $_SESSION['session_housenr'];
        }
        if (!empty($_POST['plz'])) {
            $plz = $_POST['plz'];
        } else {
            $plz = $_SESSION['session_plz'];
        }
        if (!empty($_POST['ort'])) {
            $ort = $_POST['ort'];
        } else {
            $ort = $_SESSION['session_ort'];
        }
        if (!empty($_POST['telefon'])) {
            $telefon = $_POST['telefon'];
        } else {
            $telefon = $_SESSION['session_tel'];
        }
        if (!empty($_POST['email'])) {
            $email = $_POST['email'];
        } else {
            $email = $_SESSION['session_user'];
        }

        $username = $_SESSION['session_username'];

        if (strtolower($ort) == 'immenstadt') {
            $ort = 'Immenstadt i. Allgäu';
        }

        // Insert der Formularinformationen in die Records-Datenbank
        $INSERT = "INSERT Into `tbl_records` (Artikel, Beschreibung, Menge, Preis, Erstellungsdatum, Firma, Nachname, Vorname, Straße, Hausnummer, PLZ, Ort, Email, Telefonnummer, Username, Kategorie, LänderKüche) values(?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
        $stmt = $db_link->prepare($INSERT);
        $stmt->bind_param("sssssssssssssssss", $food, $description, $amount, $price, $date, $company, $nachname, $vorname, $street, $hausnummer, $plz, $ort, $email, $telefon, $username, $kategorie, $laenderkueche);
        $stmt->execute();
        echo ($stmt->error);
        $last_id = mysqli_insert_id($db_link);



        // Wenn Bilder hinzugefügt wurden, werden diese hier geladen, ein Thumbnail erstellt, in den Upload-Ordner kopiert und ein Link in die DB eingefügt
        // Wenn kein Bild hinzugefügt wurde, wird ein Standard-Bild verwendet
        extract($_POST);
        $error = array();
        $extension = array("jpeg", "jpg", "png", "gif");
        // jedes Bild einzeln bearbeiten
        foreach ($_FILES["image"]["tmp_name"] as $key => $tmp_name) {
            $file_name = $_FILES["image"]["name"][$key];
            $file_tmp = $_FILES["image"]["tmp_name"][$key];
            $ext = pathinfo($file_name, PATHINFO_EXTENSION);
            // Berücksichtigung von Umlauten (ÄÖÜß)
            (iconv("UTF-8", "ASCII//TRANSLIT", $file_name));
            (iconv("UTF-8", "ASCII//TRANSLIT", $file_tmp));

            if (in_array($ext, $extension)) {
                // Überprüfung ob Filename bereits existiert
                if (!file_exists("../uploads/" . $file_name)) {
                    // Bild in uploads-Ordner verschieben
                    move_uploaded_file($file_tmp, "../uploads/" . $file_name);
                    $imageLink = "../uploads/" . $file_name;
                    $imageType = $_FILES["image"]["type"][$key];

                    // Bild-Daten in Images-Datenbank einfügen, zuordnung zu richtigem Record über ArtikelID = ID des Records
                    $sql = "INSERT Into `Images` (imageName, imageType, imageLink, ArtikelID) values (?, ?, ?, ?)";
                    $query = $db_link->prepare($sql);
                    $query->bind_param("sssi", $file_name, $imageType, $imageLink, $last_id);
                    $query->execute();
                    echo ($query->error);

                    // Erstellen von Thumbnails für jedes Bild, welche als Vorschaubilder der Records verwendet werden, um die Performance zu verbessern
                    // Beim Vergrößern der Bilder (klicken) werden die Originalbilder geladen
                    $image = imagecreatefromjpeg($imageLink);
                    $width = imagesx($image);
                    // zuschneiden der Thumbnails auf die richtige Größe für die Darstellung. 
                    // Spart zusätzliche Berechnung und zuschneiden der Bilder durch den Browser
                    if ($width > 300) {
                        $new_width = 300;
                        $new_heigh = -1;
                        $imageResized = imagescale($image, $new_width, $new_heigh);
                    } else {
                        $imageResized = $image;
                    }
                    // Speichern des Thumbnails im upload-Ordner in 85%iger Qualität
                    // Thumbnailname beginnt mit "Thumbnail_" um es zu identifizieren
                    $destination = "../uploads/Thumbnail_" . $file_name . "";
                    $imageName = "Thumbnail_" . $file_name . "";
                    $quality = 85;

                    imagejpeg($imageResized, $destination, $quality);


                    // Insert der Thumbnail-Informationen in DB, boolean Thumbnail wird auf 1 gesetzt
                    $imageType = $_FILES["image"]["type"][$key];
                    $thbn = 1;
                    $sql = "INSERT Into `Images` (imageName, imageType, imageLink, ArtikelID, Thumbnail) values (?, ?, ?, ?, ?)";
                    $query = $db_link->prepare($sql);
                    $query->bind_param("sssii", $imageName, $imageType, $destination, $last_id, $thbn);
                    $query->execute();
                    echo ($query->error);
                } else {
                    // Wenn Name bereits existiert, wird ein Unix-Timestamp angefügt und der Name somit einzigartig
                    $file_tmp = $_FILES["image"]["tmp_name"][$key];
                    $filename = basename($file_name, $ext);
                    $newFileName = $filename . time() . "." . $ext;
                    (iconv("UTF-8", "ASCII//TRANSLIT", $newFileName));
                    (iconv("UTF-8", "ASCII//TRANSLIT", $file_tmp));
                    move_uploaded_file($file_tmp, "../uploads/" . $newFileName);
                    $imageLink = "../uploads/" . $newFileName;
                    $imageType = $_FILES["image"]["type"][$key];


                    $sql = "INSERT Into `Images` (imageName, imageType, imageLink, ArtikelID) values (?, ?, ?, ?)";
                    $query = $db_link->prepare($sql);
                    $query->bind_param("sssi", $newFileName, $imageType, $imageLink, $last_id);
                    $query->execute();
                    echo ($query->error);


                    $image = imagecreatefromjpeg($imageLink);
                    $width = imagesx($image);
                    if ($width > 300) {
                        $new_width = 300;
                        $new_heigh = -1;
                        $imageResized = imagescale($image, $new_width, $new_heigh);
                    } else {
                        $imageResized = $image;
                    }

                    $destination = "../uploads/Thumbnail_" . $newFileName . "";
                    $imageName = "Thumbnail_" . $newFileName . "";
                    $quality = 85;

                    imagejpeg($imageResized, $destination, $quality);


                    $imageType = $_FILES["image"]["type"][$key];
                    $thbn = 1;

                    $sql = "INSERT Into `Images` (imageName, imageType, imageLink, ArtikelID, Thumbnail) values (?, ?, ?, ?, ?)";
                    $query = $db_link->prepare($sql);
                    $query->bind_param("sssii", $imageName, $imageType, $destination, $last_id, $thbn);
                    $query->execute();
                    echo ($query->error);
                }
            } else {
                array_push($error, "$file_name, ");
            }
            // nach jedem fertig bearbeiteten Bild, werden das zuletzt bearbeitete Bild und Thumbnail aus dem Ram gelöscht, um Speicheroverhead zu vermeiden
            $imageResized = null;
            $image = null;
        }
        // Bei erfolg, alert wird ausgegeben und User wird zu der gerade erstellten Anzeige weitergeleitet
        echo ($stmt->error);
        echo '<script>
        alert("Anzeige erfolgreich erstellt!");
        window.location.href="../order_food.php?id=' . $last_id . '"; 
        </script>';
        $stmt->close();
        $db_link->close();
    } else {
        if ($_POST['amount'] == 0) {
            echo "<script>
        alert('Menge darf nicht 0 sein!');
        window.location.href='../add_food.php';
        </script>";
        } else {
            echo "<script>
        alert('Bitte alle Felder ausfüllen!');
        window.location.href='../add_food.php';
        </script>";
        }
    }
}
