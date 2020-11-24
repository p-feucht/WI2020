<?php
// Sitzung starten, damit der Benutzer eingeloggt bleibt
session_start();

if (isset($_GET['ID'])) {

    include 'db.php';

    $ID_favorite = mysqli_real_escape_string($connection, $_GET['ID']);
    $email = mysqli_real_escape_string($connection, $_SESSION['session_email']);

    
    $delete_favorite = "DELETE FROM favorites WHERE series_id = '$ID_favorite' AND account_email = '$email';";

    mysqli_query($connection, $delete_favorite);

    header('Location: ../pages/Favoriten.php');
    exit();

}
?>