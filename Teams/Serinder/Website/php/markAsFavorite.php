<?php
// Sitzung starten, damit der Benutzer eingeloggt bleibt
session_start();

if (isset($_GET['ID'])) {

    include 'db.php';

    $ID_favorite = mysqli_real_escape_string($connection, $_GET['ID']);
    $email = mysqli_real_escape_string($connection, $_SESSION['session_email']);

    
    $insert_favorite = "INSERT INTO favorites(series_id, account_email) VALUES ('$ID_favorite', '$email');";

    mysqli_query($connection, $insert_favorite);

    if($_GET["source"]=="start"){
        header('Location: /pages/Startseite.php');
    } elseif($_GET["source"]=="description"){
        header('Location: /pages/Serienbeschreibung.php');
    }
    exit();

}
?>