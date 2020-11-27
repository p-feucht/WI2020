<?php

session_start();

error_reporting(E_ALL);
ini_set('display_errors', 1);

// wird geladen beim bearbeiten, löschen oder re-aktivieren von Records

require('connectDB.php');

$recordID = $_GET['id'];
$last_id = $recordID;
// sehr ähnlich zu addFoodToDB
if (isset($_POST['Record_change'])) {
    if ((!empty($_POST['food'])) and (!empty($_POST['amount'])) and (!empty($_POST['price'])) and $_POST['amount'] != 0) {

        $food = $_POST['food'];
        $description = $_POST['description'];
        $amount = $_POST['amount'];
        $price = $_POST['price'];
        $date = date("Y-m-d H:i:s");
        $kategorie = $_POST['categorie'];
        $laenderkueche = $_POST['kitchen'];
        if (!isset($_POST['categorie'])) {
            $kategorie = 'Sonstige';
        }
        if (!isset($_POST['kitchen'])) {
            $laenderkueche = 'Sonstige';
        }

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

        $recordID = $_GET['id'];
        $last_id = $recordID;

        $visable = mysqli_query($db_link, "SELECT * FROM `tbl_records` WHERE ID = $recordID") or die('Fehler: ' . mysqli_error($db_link));
        $row2 = mysqli_fetch_array($visable);


        if ($row2['Visable'] == 0) {

            $update = mysqli_query($db_link, "UPDATE `tbl_records` SET Nachname = '$nachname', Vorname = '$vorname', Firma = '$company', Straße = '$street', 
    Hausnummer = '$hausnummer', PLZ = '$plz', Ort = '$ort', Telefonnummer = '$telefon', Artikel = '$food', Beschreibung = '$description', 
    Kategorie = '$kategorie', LänderKüche = '$laenderkueche', Menge = '$amount', Preis = '$price', letzte_änderung = '$date'  WHERE ID = $recordID") or die('Fehler: ' . mysqli_error($db_link));
        } elseif ($row2['Visable'] == 1) {
            $update = mysqli_query($db_link, "UPDATE `tbl_records` SET Nachname = '$nachname', Vorname = '$vorname', Firma = '$company', Straße = '$street', 
        Hausnummer = '$hausnummer', PLZ = '$plz', Ort = '$ort', Telefonnummer = '$telefon', Artikel = '$food', Beschreibung = '$description', 
        Kategorie = '$kategorie', LänderKüche = '$laenderkueche', Menge = '$amount', Preis = '$price', letzte_änderung = '$date', Visable = 0  WHERE ID = $recordID") or die('Fehler: ' . mysqli_error($db_link));
        }
        $last_id = $recordID;

        extract($_POST);
        $error = array();
        $extension = array("jpeg", "jpg", "png", "gif");
        foreach ($_FILES["image"]["tmp_name"] as $key => $tmp_name) {
            $file_name = $_FILES["image"]["name"][$key];
            $file_tmp = $_FILES["image"]["tmp_name"][$key];
            $ext = pathinfo($file_name, PATHINFO_EXTENSION);
            (iconv("UTF-8", "ASCII//TRANSLIT", $file_name));
            (iconv("UTF-8", "ASCII//TRANSLIT", $file_tmp));

            if (in_array($ext, $extension)) {
                if (!file_exists("../uploads/" . $file_name)) {
                    move_uploaded_file($file_tmp, "../uploads/" . $file_name);
                    $imageLink = "../uploads/" . $file_name;
                    $imageType = $_FILES["image"]["type"][$key];


                    $sql = "INSERT Into `Images` (imageName, imageType, imageLink, ArtikelID) values (?, ?, ?, ?)";
                    $query = $db_link->prepare($sql);
                    $query->bind_param("sssi", $file_name, $imageType, $imageLink, $last_id);
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

                    $destination = "../uploads/Thumbnail_" . $file_name . "";
                    $imageName = "Thumbnail_" . $file_name . "";
                    $quality = 85;

                    imagejpeg($imageResized, $destination, $quality);



                    $imageType = $_FILES["image"]["type"][$key];
                    $thbn = 1;
                    $sql = "INSERT Into `Images` (imageName, imageType, imageLink, ArtikelID, Thumbnail) values (?, ?, ?, ?, ?)";
                    $query = $db_link->prepare($sql);
                    $query->bind_param("sssii", $imageName, $imageType, $destination, $last_id, $thbn);
                    $query->execute();
                    echo ($query->error);
                } else {
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
            $imageResized = null;
            $image = null;
        }

        echo '<script>
        alert("Anzeige erfolgreich geändert!");
        window.location.href="../order_food.php?id=' . $recordID . '";
        </script>';
    } else {
        if ($_POST['amount'] == 0) {
            echo '<script>
        alert("Menge darf nicht 0 sein!");
        window.location.href="../editFood.php?id=' . $last_id . '";
        </script>';
        } else {
            echo '<script>
        alert("Bitte alle Felder ausfüllen!");
        window.location.href="../editFood.php?id=' . $last_id . '";
        </script>';
        }
    }
}
// Anzeige löschen
elseif (isset($_POST['myBtnDeleteRecJa'])) {
    mysqli_query($db_link, "UPDATE `tbl_records` SET Visable = 1 WHERE ID = $recordID") or die('Fehler: ' . mysqli_error($db_link));
    echo ("<script>alert('Diese Anzeige wurde gelöscht!');</script>");
    echo ('<script>window.location.href="../order_food.php?id=' . $recordID . '";</script>');
} else {
    echo ('<script>window.location.href="../order_food.php?id=' . $recordID . '";</script>');
}
