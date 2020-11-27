<?php

    include 'db.php';
    
    $email = mysqli_real_escape_string($connection, $_SESSION["session_email"]);
    $statement = $connection->prepare("SELECT s.ID, s.Name, c.comment, c.ID as commentID FROM series s INNER JOIN comments c ON s.ID = c.series_id WHERE account_email = '$email';");
    
    $statement->execute();
    $result = $statement->get_result();

    if ($result->num_rows > 0) {

      // output data of each row
      while($row = $result->fetch_assoc()) {
          $commentDeleteString = "<a href='../php/removeComment.php?ID=".$row["commentID"]."'> [entfernen]</a>";
          echo "<li><a href='../php/seriesDescription.php?ID=".$row["ID"]."'>".$row["Name"]."</a><p>".$row["comment"].$commentDeleteString."</p><br></li>";
        }

      } else {
        echo "Keine Kommentare vorhanden.";
      }

?>