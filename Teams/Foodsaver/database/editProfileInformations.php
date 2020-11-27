<?php

session_start();

// bearbeiten vom Profil

error_reporting(E_ALL);
ini_set('display_errors', 1);


require('connectDB.php');

if (isset($_POST['submit'])) {
    $emailaktuell = $_SESSION['session_user'];
    $useraktuell = $_SESSION['session_username'];

    // speichern neuer Benutzerdaten

    $username = $_POST['username'];
    $nachname = $_POST['nachname'];
    $vorname = $_POST['vorname'];
    $company = $_POST['company'];
    $street = $_POST['street'];
    $number = $_POST['hausnummer'];
    $plz = $_POST['plz'];
    $ort = $_POST['ort'];
    $telefon = $_POST['telefon'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $new_password = $_POST['new_password'];
    $new_password_re = $_POST['new_password_re'];
    $date = date("Y-m-d H:i:s");

    if (strtolower($ort) == 'immenstadt') {
        $ort = 'Immenstadt i. Allgäu';
    }

    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    $db_pwd_query = mysqli_query($db_link, "SELECT Passwort From `tbl_contacts` Where Benutzername = '$useraktuell'");
    $db_pwd = mysqli_fetch_array($db_pwd_query);
    // aktuelles Passwort auf gültigkeit prüfen
    if (password_verify($password, $db_pwd['Passwort'])) {
        // DB-Abfragen für alle möglichen Szenarien
        $toDB = 1;
        $Notallowed = 0;
        if (($username != $_SESSION['session_username']) or ($email != $_SESSION['session_user'])) {
            if (($username != $_SESSION['session_username']) && ($email == $_SESSION['session_user'])) {
                $SELECT2 = mysqli_query($db_link, "SELECT * From `tbl_contacts` Where Benutzername = '$username'");
                $Notallowed = mysqli_num_rows($SELECT2);
            } elseif (($username == $_SESSION['session_username']) && ($email != $_SESSION['session_user'])) {
                $SELECT2 = mysqli_query($db_link, "SELECT * From `tbl_contacts` Where Email = '$email'");
                $Notallowed = mysqli_num_rows($SELECT2);
            } elseif (($username != $_SESSION['session_username']) && ($email != $_SESSION['session_user'])) {
                $SELECT2 = mysqli_query($db_link, "SELECT * From `tbl_contacts` Where Benutzername = '$username' or Email = '$email'");
                $Notallowed = mysqli_num_rows($SELECT2);
            }
            if ($Notallowed != 0) {
                $toDB = 0;
                echo ("<script>alert('Beutzername oder Email ist schon vergeben');
            window.location.href='../editProfile.php?edit=" . $useraktuell . "';</script>");
            }
        }
        // wenn ein neues Passwort angelegt wird
        // alle Fehlermöglichkeiten durchlaufen, wenn alles korrekt, wird neues Passwort gehashed
        if ($new_password != Null and $new_password != "") {
            if ($new_password_re != Null and $new_password_re != "") {
                if ($new_password == $new_password_re) {
                    $hashed_password = password_hash($new_password, PASSWORD_DEFAULT);
                } else {
                    $toDB = 0;
                    echo ("<script>alert('Neue Passwörter müssen übereinstimmen!');
                        window.location.href='../editProfile.php?edit=" . $useraktuell . "';</script>");
                }
            } else {
                $toDB = 0;
                echo ("<script>alert('Bitte das neue Passwort bestätigen!');
                    window.location.href='../editProfile.php?edit=" . $useraktuell . "';</script>");
            }
        } elseif ($new_password == Null or $new_password == "") {
            if ($new_password_re == Null or $new_password_re == "") {
                $hashed_password = password_hash($password, PASSWORD_DEFAULT);
            } else {
                $toDB = 0;
                echo ("<script>alert('Neue Passwörter müssen übereinstimmen!');
                window.location.href='../editProfile.php?edit=" . $useraktuell . "';</script>");
            }
        }



        if ($toDB == 1) {
            $SELECTID = mysqli_query($db_link, "SELECT * From `tbl_contacts` Where Email = '$emailaktuell' Limit 1");
            $id = 0;
            while ($row = mysqli_fetch_array($SELECTID)) {
                $id = $row['ID'];
            }
            // Profilbild aktualisieren, wenn neues ausgewählt ist
            if ((isset($_FILES["profileImage"]["tmp_name"])) and ($_FILES["profileImage"]["tmp_name"] != Null)) {
                extract($_POST);
                $error = array();
                $extension = array("jpeg", "jpg", "png", "gif");
                $file_name = $_FILES["profileImage"]["name"];
                $file_tmp = $_FILES["profileImage"]["tmp_name"];
                $ext = pathinfo($file_name, PATHINFO_EXTENSION);

                if (in_array($ext, $extension)) {
                    if (!file_exists("../uploads/Profilbilder/" . $file_name)) {
                        move_uploaded_file($file_tmp = $_FILES["profileImage"]["tmp_name"], "../uploads/Profilbilder/" . $file_name);
                        $imageLink = "../uploads/Profilbilder/" . $file_name;
                    } else {
                        $filename = basename($file_name, $ext);
                        $newFileName = $filename . time() . "." . $ext;
                        move_uploaded_file($file_tmp = $_FILES["profileImage"]["tmp_name"], "../uploads/Profilbilder/" . $newFileName);
                        $imageLink = "../uploads/Profilbilder/" . $newFileName;
                    }
                } else {
                    array_push($error, "$file_name, ");
                }
            } else {
                $SELECTPICTURE = mysqli_query($db_link, "SELECT * From `tbl_contacts` WHERE ID = $id");
                while ($rowImage = mysqli_fetch_array($SELECTPICTURE)) {
                    $imageLink = $rowImage['pictureLink'];
                }
            }


            // Kontakte, alle Nachrichten und Bestellungen mit neuen Profildaten aktualisieren
            // Wenn checkbox ausgewählt, neue Daten bei alten Records aktualisieren

            $INSERT_Contacts = "UPDATE `tbl_contacts` SET Nachname = '$nachname', Vorname = '$vorname', Firma = '$company', Straße = '$street', Hausnummer = '$number', 
            PLZ = '$plz', Ort = '$ort', Passwort = '$hashed_password', Telefonnummer = '$telefon', pictureLink = '$imageLink', Email = '$email', Benutzername = '$username', letzte_änderung = '$date' WHERE ID = '$id'";

            if (isset($_POST['changeRecordCheckBox'])) {
                $INSERT_Records = "UPDATE `tbl_records` SET Nachname = '$nachname', Vorname = '$vorname', Firma = '$company', Straße = '$street', Hausnummer = '$number', 
            PLZ = '$plz', Ort = '$ort', Telefonnummer = '$telefon', Email = '$email', Username = '$username' WHERE Email = '$emailaktuell'";
            } else {
                $INSERT_Records = "UPDATE `tbl_records` SET Email = '$email', Username = '$username' WHERE Email = '$emailaktuell'";
            }

            $INSERT_Nachrichten1 = "UPDATE `Nachrichten` SET Benutzername = '$username' WHERE Benutzername = '$useraktuell'";
            $INSERT_Nachrichten2 = "UPDATE `Nachrichten` SET Empfänger = '$username' WHERE Empfänger = '$useraktuell'";

            $INSERT_Bestellung1 = "UPDATE `Bestellungsanfragen` SET Nachname = '$nachname', Vorname = '$vorname', Firma = '$company', 
            Telefonnummer = '$telefon', Email = '$email', Username = '$username' WHERE Email = '$emailaktuell'";

            $INSERT_Bestellung2 = "UPDATE `Bestellungsanfragen` SET  VerkäuferUsername = '$username', Verkäufer = '$email' WHERE Verkäufer = '$emailaktuell'";


            mysqli_query($db_link, $INSERT_Contacts);
            mysqli_query($db_link, $INSERT_Records);
            mysqli_query($db_link, $INSERT_Nachrichten1);
            mysqli_query($db_link, $INSERT_Nachrichten2);
            mysqli_query($db_link, $INSERT_Bestellung1);
            mysqli_query($db_link, $INSERT_Bestellung2);

            $sql = mysqli_query($db_link, "SELECT * FROM `tbl_contacts` WHERE ID = $id");
            $row = mysqli_fetch_array($sql);

            // User mit neuen Daten anmelden
            $_SESSION['session_id'] = $row['ID'];
            $_SESSION['session_user'] = $row['Email'];
            $_SESSION['session_pwd'] = $row['Passwort'];
            $_SESSION['session_username'] = $row['Benutzername'];
            $_SESSION['session_company'] = $row['Firma'];
            $_SESSION['session_lastname'] = $row['Nachname'];
            $_SESSION['session_firstname'] = $row['Vorname'];
            $_SESSION['session_street'] = $row['Straße'];
            $_SESSION['session_housenr'] = $row['Hausnummer'];
            $_SESSION['session_plz'] = $row['PLZ'];
            $_SESSION['session_ort'] = $row['Ort'];
            $_SESSION['session_tel'] = $row['Telefonnummer'];

            echo ("<script>alert('Benutzerkonto erfolgreich geändert!');
            window.location.href='../profile.php?userid=" . $username . "';</script>");
        }
    } else {

        $toDB = 0;
        echo ("<script>alert('Das eingegebene Passwort ist falsch!');
        window.location.href='../editProfile.php?edit=" . $useraktuell . "';</script>");
    }
}
