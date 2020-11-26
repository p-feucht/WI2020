<?php

    include 'db.php';
    
    $statement = $connection->prepare("SELECT id, name FROM genres ORDER BY Name ASC");
    $statement->execute();
    $result = $statement->get_result();

    if ($result->num_rows > 0) {

        // output data of each row
        while($row = $result->fetch_assoc()) {
            echo "<option value=".$row["id"].">".$row["name"]."</option>";
        }

      } else {
        echo "0 results";
      }
?>