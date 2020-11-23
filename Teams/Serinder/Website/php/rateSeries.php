<?php
// Sitzung starten, damit der Benutzer eingeloggt bleibt
session_start();

if (isset($_GET['ID'])) {

    include 'db.php';

    $ID_chosen = mysqli_real_escape_string($connection, $_GET['ID']);
    $email = mysqli_real_escape_string($connection, $_SESSION['session_email']);

    if($_SESSION['randomSeriesId1']==$ID_chosen){
        $ID_not_hosen = mysqli_real_escape_string($connection, $_SESSION['randomSeriesId2']);
    } else {
        $ID_not_chosen = mysqli_real_escape_string($connection, $_SESSION['randomSeriesId1']);
    }
    
    $insert_chosen = "INSERT INTO rating(series_id, account_email, chosen) VALUES ('$ID_chosen', '$email', 1);";
    $insert_not_chosen = "INSERT INTO rating(series_id, account_email, chosen) VALUES ('$ID_not_chosen', '$email', 0);";

    mysqli_query($connection, $insert_chosen);
    mysqli_query($connection, $insert_not_chosen);

    header('Location: /php/randomSeries.php');
    exit();

}
?>