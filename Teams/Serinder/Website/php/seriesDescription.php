<?php
    session_start();
    include 'db.php';

    $statement = $connection->prepare("SELECT Name, Overview, Image_Path FROM series WHERE ID = '$_GET[ID]'");
    $statement->execute();
    $result = $statement->get_result();


    if ($result->num_rows == 1) {
        $row = $result->fetch_assoc();

        $_SESSION["seriesName"] = $row["Name"];
        $_SESSION["seriesImage_Path"] = $row["Image_Path"];
        $_SESSION["seriesOverview"] = $row["Overview"];

        header("Location: ../pages/Serienbeschreibung.php");
      } else {
        echo "Ungültige ID";
      }
?>