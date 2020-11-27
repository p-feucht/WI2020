<?php

// Sitzung starten, damit der Benutzer eingeloggt bleibt
session_start();

if (isset($_POST['submit'])) {

    include 'db.php';

    $username = mysqli_real_escape_string($connection, $_POST['username']);
    $password = mysqli_real_escape_string($connection, $_POST['password']);

    // Error handlers
    // Existiert der Benutzername?
    $statement = $connection->prepare("SELECT * FROM accounts WHERE Username = '$username'");
    $statement->execute();
    $result = $statement->get_result();
    $count = $result->num_rows;

    if ($count < 1) {
        header('Location: ../index.php');
        exit();
    } else {
        // Ist das Passwort korrekt?
        // Die Variable row wird als Array mit den Informationen aus der Datenbank befüllt
        if ($row = mysqli_fetch_assoc($result)) {
            // De-Hashing des Passwortes 
            // password_verify($password, $row['password']) gibt true oder false zurück
            $hashedPassword = password_verify($password, $row['Password']);
            
            if (!$hashedPassword) {
                header("Location: ../index.php");
                exit();
              // elseif fängt unvorhergesehene Fehler ab
            } elseif($hashedPassword){
              // Benutzer anmelden
              $_SESSION['session_email'] = $row['Email'];
              $_SESSION['session_username'] = $row['Username'];

              header('Location: ./randomSeries.php');
              exit();
            }
        }
    }

} else {
    header('Location: ../index.php');
    exit();
}
?>