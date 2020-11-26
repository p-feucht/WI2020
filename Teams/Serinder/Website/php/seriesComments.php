<?php

    include 'db.php';

    
    if(isset($_SESSION["seriesID"]) && $_SESSION["seriesID"] != ""){
        $seriesID = mysqli_real_escape_string($connection, $_SESSION["seriesID"]);
        $statement = $connection->prepare("SELECT comment, Username FROM comments c INNER JOIN accounts a ON c.account_email = a.Email WHERE series_id = '$seriesID';");
    } 

    $statement->execute();
    $result = $statement->get_result();

    if ($result->num_rows > 0) {

        // output data of each row
        while($row = $result->fetch_assoc()) {
          echo "<li><b>".$row["Username"].": </b>".$row["comment"]."</li>";
        }

      } else {
        echo "Noch keine Kommentare vorhanden.";
      }
?>