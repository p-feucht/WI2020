<?php
$servername = "localhost";
$username = "workerbees";
$password = "HKSZ52";
$dbname = "workerbees_db1";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT Ort, ATitel, PreisProTag FROM AngebotWerkzeug";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // output data of each row
    while ($row = $result->fetch_assoc()) {

        $location = $row["Ort"];
        $title = $row["ATitel"];
        $price = $row["PreisProTag"];

?>

        <div class="card" data-toggle="modal" data-target="#myModal">
            <img src="images/werkstatt.jpg" alt="Denim Jeans" class="offer-image">
            <p class="card-lp"><img src="images/place-icon.svg" alt="location" class="place-icon"> <?php echo $location ?>
                <span class="price"><?php echo $price ?>€ / Tag</span></p>
            <h2><?php echo $title ?></h1>
        </div>

<?php
    }
} else {
    echo "0 results";
}
$conn->close();
?>