<?php
// Sitzung starten, damit der Benutzer eingeloggt bleibt
session_start();

if (isset($_SESSION['session_email'])) {

    include 'db.php';

    $email = mysqli_real_escape_string($connection, $_SESSION['session_email']);
    $password_old = mysqli_real_escape_string($connection, $_POST['password_old']);
    $password1 = mysqli_real_escape_string($connection, $_POST['password1']);
    $password2 = mysqli_real_escape_string($connection, $_POST['password2']);

    $statement = $connection->prepare("SELECT * FROM accounts WHERE email = '$email'");
    $statement->execute();
    $result = $statement->get_result();
    $count = $result->num_rows;

    if($password1 != $password2) {
        echo('Die neuen Passwörter müssen übereinstimmen<br>');
        exit();
    } elseif ($count != 1) {
        header('Location: /pages/Einstellungen.php');
        exit();
    } else {
        // Ist das Passwort korrekt?
        // Die Variable row wird als Array mit den Informationen aus der Datenbank befüllt
        if ($row = mysqli_fetch_assoc($result)) {
            // De-Hashing des Passwortes 
            // password_verify($password, $row['password']) gibt true oder false zurück
            $hashedPassword = password_verify($password_old, $row['Password']);
            
            if (!$hashedPassword) {
                
                header("Location: /pages/Einstellungen.php");
                exit();
              // elseif fängt unvorhergesehene Fehler ab
            } elseif($hashedPassword){
                $hashPassword = password_hash($password1,PASSWORD_DEFAULT);
                $update_password = "UPDATE accounts SET accounts.Password = '$hashPassword' WHERE email = '$email';";
                mysqli_query($connection, $update_password);
                
                header('Location: /pages/Einstellungen.php');
              exit();
            }
        }
    }
    exit();

}
?>