<?php
$username = "barkeeper_dbuser";
$password = "JcNgS55uY2jQJK4a";
$dbname = "barkeeper_cocktails";

// Create connection
$conn = mysqli_connect($servername, $username, $password, $dbname);

// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
else {
    echo "Connected successfully";
    echo "<br>";
    echo("We have received your data");
    echo "<br>";
    $name = $conn->real_escape_string($_POST["CocktailName"]);
    $beschreibung = $conn->real_escape_string($_POST["Beschreibung"]);
    $alkohol1 = $conn->real_escape_string($_POST["Alkohol1"]);
    $alkohol2 = $conn->real_escape_string($_POST["Alkohol2"]);
    $saft1 = $conn->real_escape_string($_POST["Saft1"]);
    $saft2 = $conn->real_escape_string($_POST["Saft2"]);
    $grünzeug1 = $conn->real_escape_string($_POST["Grünzeug1"]);
    $grünzeug2 = $conn->real_escape_string($_POST["Grünzeug2"]);
//---------------------------Create cocktail entry----------------------------------------------------
    $sql = "INSERT INTO cocktails_t (Name, Beschreibung)
    VALUES ('$name', '$beschreibung')";
    
    echo $sql;
    echo "<br>";

    if ($conn->query($sql) === TRUE) {
        echo "Cocktail sucessfully created";
        echo "<br>";
        echo "Entries written:";
        echo $name;
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    //---------------------------Create receipt for Alkohol1----------------------------------------------------
    $menge = $conn->real_escape_string($_POST["Alkohol1Menge"]);
    $sql = "INSERT INTO Rezept_RT (cocktails_id, menge, zutat)
	VALUES((SELECT MAX(cocktails_id) FROM cocktails_t),
           '$menge','$alkohol1');";
    
    echo $sql;
    echo "<br>";

    if ($conn->query($sql) === TRUE) {
        echo "Receipt sucessfully created";
        echo "<br>";
        echo "Entries written:";
        echo $name;
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

     //---------------------------Create receipt for Alkohol2----------------------------------------------------
     $menge = $conn->real_escape_string($_POST["Alkohol2Menge"]);
     $sql = "INSERT INTO Rezept_RT (cocktails_id, menge, zutat)
     VALUES((SELECT MAX(cocktails_id) FROM cocktails_t),
            '$menge','$alkohol2');";
     
     echo $sql;
     echo "<br>";
 
     if ($conn->query($sql) === TRUE) {
         echo "Receipt sucessfully created";
         echo "<br>";
         echo "Entries written:";
         echo $name;
     } else {
         echo "Error: " . $sql . "<br>" . $conn->error;
     }
 
     //---------------------------Create receipt for Saft1----------------------------------------------------
     $menge = $conn->real_escape_string($_POST["Saft1Menge"]);
     $sql = "INSERT INTO Rezept_RT (cocktails_id, menge, zutat)
     VALUES((SELECT MAX(cocktails_id) FROM cocktails_t),
            '$menge','$saft1');";
     
     echo $sql;
     echo "<br>";
 
     if ($conn->query($sql) === TRUE) {
         echo "Receipt sucessfully created";
         echo "<br>";
         echo "Entries written:";
         echo $name;
     } else {
         echo "Error: " . $sql . "<br>" . $conn->error;
     }

      //---------------------------Create receipt for Saft2----------------------------------------------------
    $menge = $conn->real_escape_string($_POST["Saft2Menge"]);
    $sql = "INSERT INTO Rezept_RT (cocktails_id, menge, zutat)
	VALUES((SELECT MAX(cocktails_id) FROM cocktails_t),
           '$menge','$saft2');";
    
    echo $sql;
    echo "<br>";

    if ($conn->query($sql) === TRUE) {
        echo "Receipt sucessfully created";
        echo "<br>";
        echo "Entries written:";
        echo $name;
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

  //---------------------------Create receipt for Grünzeug1----------------------------------------------------
  $menge = $conn->real_escape_string($_POST["Grünzeug1Menge"]);
  $sql = "INSERT INTO Rezept_RT (cocktails_id, menge, zutat)
  VALUES((SELECT MAX(cocktails_id) FROM cocktails_t),
         '$menge','$grünzeug1');";
  
  echo $sql;
  echo "<br>";

  if ($conn->query($sql) === TRUE) {
      echo "Receipt sucessfully created";
      echo "<br>";
      echo "Entries written:";
      echo $name;
  } else {
      echo "Error: " . $sql . "<br>" . $conn->error;
  }


   //---------------------------Create receipt for Grünzeug2----------------------------------------------------
   $menge = $conn->real_escape_string($_POST["Grünzeug2Menge"]);
   $sql = "INSERT INTO Rezept_RT (cocktails_id, menge, zutat)
   VALUES((SELECT MAX(cocktails_id) FROM cocktails_t),
          '$menge','$grünzeug2');";
   
   echo $sql;
   echo "<br>";

   if ($conn->query($sql) === TRUE) {
       echo "Receipt sucessfully created";
       echo "<br>";
       echo "Entries written:";
       echo $name;
   } else {
       echo "Error: " . $sql . "<br>" . $conn->error;
   }


    $conn->close();    
}
?>