<?php
session_start();
require('connectDB.php');

// löscht Profil aus Datenbank und meldet aktuellen User ab

$email = $_SESSION['session_user'];
$username = $_SESSION['session_username'];

if (isset($_POST['myBtnDeleteJa'])) {
    $query = mysqli_query($db_link, "DELETE FROM `tbl_contacts` WHERE Email = '$email'");
    $query2 = mysqli_query($db_link, "DELETE FROM `tbl_records` WHERE Email = '$email'");
    echo ("<script>alert('Benutzerkonto wurde gelöscht!')</script>");
    session_start();
    session_unset();
    session_destroy();
    echo ("<script>window.location.href='../index.php';</script>");
} else {
    echo ("<script>window.location.href='../profile.php?userid=" . $username . "';</script>");
}
