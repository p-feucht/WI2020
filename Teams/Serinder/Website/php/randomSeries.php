<?php
    session_start();
    include 'db.php';

    $statement = $connection->prepare("SELECT id, Name, Overview, Image_Path FROM series ORDER BY RAND() LIMIT 2");
    $statement->execute();
    $result = $statement->get_result();
    $counter = 1;

    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            $_SESSION["randomSeriesId".strval($counter)] = $row["id"];
            $_SESSION["randomSeriesName".strval($counter)] = $row["Name"];
            $_SESSION["randomSeriesImage_Path".strval($counter)] = $row["Image_Path"];
            $counter += 1;
        }
        header("Location: ../pages/Startseite.php");
      } else {
        echo "Fehler bei zufälliger Serie.";
      }
?>