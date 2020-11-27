<?php

// Sitzung starten, damit der Benutzer eingeloggt bleibt
session_start();

if (isset($_GET['ID'])) {

    include 'db.php';

    $ID_comment = mysqli_real_escape_string($connection, $_GET['ID']);
    $email = mysqli_real_escape_string($connection, $_SESSION['session_email']);

    
    $delete_comment = "DELETE FROM comments WHERE ID = '$ID_comment' AND account_email = '$email';";

    mysqli_query($connection, $delete_comment);

    header('Location: ../pages/Kommentare.php');
    exit();

}
?>