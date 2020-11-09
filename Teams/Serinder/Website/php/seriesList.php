<?php
    include 'db.php';

    
    if(isset($_GET["genreID"]) && $_GET["genreID"] != ""){
        $genreValue = mysqli_real_escape_string($connection, $_GET["genreID"]);
        $statement = $connection->prepare("SELECT ID, Name FROM series WHERE ID IN (SELECT series_id FROM series_genres WHERE genres_id = '$genreValue') ORDER BY Name ASC");
    } else {
        $statement = $connection->prepare("SELECT ID, Name FROM series ORDER BY Name ASC");
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