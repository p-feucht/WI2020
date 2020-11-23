<?php
    include 'db.php';

    $email = mysqli_real_escape_string($connection, $_SESSION["session_email"]);
    $statement = $connection->prepare("SELECT ID, Name FROM series WHERE ID IN (SELECT series_id FROM favorites WHERE account_email = '$email');");
    
    $statement->execute();
    $result = $statement->get_result();

    if ($result->num_rows > 0) {

        // output data of each row
        while($row = $result->fetch_assoc()) {
          echo "<li><a href='../php/SeriesDescription.php?ID=".$row["ID"]."'>".$row["Name"]."</a></li>";
        }

      } else {
        echo "Keine Favoriten vorhanden.";
      }
?>