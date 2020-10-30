<?php


require('database/connectDB.php');


$query = mysqli_query($db_link, "SELECT * FROM `Images` WHERE ArtikelID = 25") or die('Fehler: ' . mysqli_error());

$row2 = mysqli_fetch_array($query);

$row3 = $row2['imageData'];

echo strlen($row3);

var_dump($row3);

while($row = mysqli_fetch_array($query))
                {   
                 
                    
                    $ImageDataString = $row['imageData'];

                    $imageData = base64_encode($ImageDataString->getImageBlob);

                    echo("<img src='data:image/jpeg;base64, $imageData'>");
                    
                }

?>