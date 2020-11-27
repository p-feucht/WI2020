<?php

// Sitzung starten, damit der Benutzer eingeloggt bleibt
session_start();

if (isset($_GET['comment'])) {

    include 'db.php';

    $comment = mysqli_real_escape_string($connection, $_GET['comment']);
    $email = mysqli_real_escape_string($connection, $_SESSION['session_email']);
    $series_id = mysqli_real_escape_string($connection, $_GET['series_id']);

    
    $insert_favorite = "INSERT INTO comments(series_id, account_email, comment) VALUES ('$series_id', '$email', '$comment');";

    mysqli_query($connection, $insert_favorite);

    if($_GET["source"]=="start"){
        header('Location: /pages/Startseite.php');
    } elseif($_GET["source"]=="description"){
        header('Location: /pages/Serienbeschreibung.php');
    }
    exit();

}
?>