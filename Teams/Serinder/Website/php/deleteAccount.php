<?php

// Sitzung starten, damit der Benutzer eingeloggt bleibt
session_start();

if (isset($_SESSION['session_email'])) {

    include 'db.php';

    $email = mysqli_real_escape_string($connection, $_SESSION['session_email']);

        
    $delete_rating = "DELETE FROM rating WHERE account_email = '$email';";
    $delete_favorites = "DELETE FROM favorites WHERE account_email = '$email';";
    $delete_comments = "DELETE FROM comments WHERE account_email = '$email';";
    $delete_account = "DELETE FROM accounts WHERE Email = '$email';";

    mysqli_query($connection, $delete_rating);
    mysqli_query($connection, $delete_favorites);
    mysqli_query($connection, $delete_comments);
    mysqli_query($connection, $delete_account);
    header('Location: /php/logout.php');

    }
    exit();

?>