<?php
    session_start();
    include 'db.php';

    $statement = $connection->prepare("SELECT s.ID, s.Name, s.Overview, s.Image_Path, ROUND(SUM(r.chosen)/COUNT(r.chosen)*100.0,2) as rated FROM series s LEFT JOIN rating r ON s.ID = r.series_id WHERE s.ID = '$_GET[ID]' GROUP BY s.Name, s.Overview, s.Image_Path;");
    $statement->execute();
    $result = $statement->get_result();


    if ($result->num_rows == 1) {
        $row = $result->fetch_assoc();

        $_SESSION["seriesID"] = $row["ID"];
        $_SESSION["seriesName"] = $row["Name"];
        $_SESSION["seriesImage_Path"] = $row["Image_Path"];
        $_SESSION["seriesOverview"] = $row["Overview"];
        if(is_null($row["rated"])){
          $_SESSION["seriesRating"] = "noch keine Bewertung vorhanden";
        } else {
          $_SESSION["seriesRating"] = $row["rated"]."%";
        }

        header("Location: ../pages/Serienbeschreibung.php");
      } else {
        echo "Ungültige ID";
      }

      
?>