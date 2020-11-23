<?php
    include 'db.php';

    
    if(isset($_GET["genreID"]) && $_GET["genreID"] != ""){
        $genreValue = mysqli_real_escape_string($connection, $_GET["genreID"]);
        if(isset($_GET["orderBy"]) && $_GET["orderBy"] == "rating"){
          $statement = $connection->prepare("SELECT s.ID, s.Name, ROUND(SUM(r.chosen)/COUNT(r.chosen)*100.0,2) as rated FROM series s LEFT JOIN rating r ON s.ID = r.series_id 
                  WHERE s.ID IN (SELECT sg.series_id FROM series_genres sg WHERE sg.genres_id = '$genreValue') GROUP BY s.ID, s.Name ORDER BY rated DESC");
        } else {
          $statement = $connection->prepare("SELECT s.ID, s.Name FROM series s WHERE ID IN (SELECT series_id FROM series_genres WHERE genres_id = '$genreValue') ORDER BY Name ASC");
        }
    } else {
      if(isset($_GET["orderBy"]) && $_GET["orderBy"] == "rating"){
        $statement = $connection->prepare("SELECT s.ID, s.Name, ROUND(SUM(r.chosen)/COUNT(r.chosen)*100.0,2) as rated FROM series s LEFT JOIN rating r ON s.ID = r.series_id 
                GROUP BY s.ID, s.Name ORDER BY rated DESC");
      } else {
        $statement = $connection->prepare("SELECT s.ID, s.Name FROM series s ORDER BY Name ASC");
      }
    }
    
    $statement->execute();
    $result = $statement->get_result();

    if ($result->num_rows > 0) {

        // output data of each row
        while($row = $result->fetch_assoc()) {
          echo "<li><a href='../php/SeriesDescription.php?ID=".$row["ID"]."'>".$row["Name"]."</a></li>";
        }

      } else {
        echo "Keine Serie vorhanden.";
      }
?>