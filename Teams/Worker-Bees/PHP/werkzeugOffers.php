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

$sql = "SELECT ATitel, AZeitraum, ABeschreibung, Vorname, Nachname, Strasse, Hausnummer, 
PLZ, Ort, Bild, usernameErsteller, Werkzeug_ID, PreisProTag, BezInBier, Erstellzeitpunkt FROM AngebotWerkzeug";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // output data of each row
    while ($row = $result->fetch_assoc()) {

        $orderID = $row["Werkzeug_ID"];
        $location = $row["Ort"];
        $title = $row["ATitel"];
        $price = $row["PreisProTag"];
        $offeruser = $row["usernameErsteller"];
        $plz = $row["PLZ"];
        $description = $city = $row["ABeschreibung"];
        $bezBier = $row["BezInBier"];
        $image = $row["Bild"];

        $card_ID = "WZcard_".(string)$orderID;
        $modal_target = "#WZmodal_".(string)$orderID;
        $modal_ID = "WZmodal_".(string)$orderID;

        $bier = round($price,0);

        $pricename = "WZprice_".(string)$orderID;
        $datename = "WZdate_".(string)$orderID;
        $titlename = "WZtitel_".(string)$orderID;
        $bezinbier = "WZbib_".(string)$orderID;

    ?>
        <!-- create card for each offer -->
        <div class="card" name="cardID" value="<?php echo $orderID ?>" id="<?php echo $card_ID ?>" 
                data-toggle="modal" data-target=<?php echo $modal_target ?>>
            <img src="data:image/jpg;charset=utf8;base64,<?php echo base64_encode($image); ?>" 
            alt="Offer Photo" class="offer-image" onerror="this.onerror=null; this.src='images/Werkzeug.jpg'"/>
            <p class="card-lp"><img src="images/place-icon.svg" alt="location" class="place-icon"> <?php echo $location ?>
                <span class="price"><?php echo $price ?>€ / Tag</span></p>
            <h2><?php echo $title ?></h2>
        </div>

        <!-- create modal for each card -->
        <div id=<?php echo $modal_ID ?> class="modal fade" role="dialog">
        <div class="modal-dialog modal-lg">

            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <img class="headerLogo" src="images/logoKomplett.png" alt="Logo">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body">
                    <h3 class="modal-offerName" name="<?php echo htmlspecialchars($titlename);?>"><?php echo $title ?></h3>
                    <p class="modal-namelocation"><?php echo $offeruser ?>
                        <img src="images/place-icon.svg" class="place-icon" alt="location"><?php echo $plz ?> <?php echo $location ?>
                        <!--has to be the exact location here!-->
                    </p>

                    <div class="modal-content-split">
                        <p class="offer-description">
                            <?php echo $description ?>
                        </p>

                    </div>
                    <div class="modal-content-split">
                        <img src="data:image/jpg;charset=utf8;base64,<?php echo base64_encode($image); ?>" 
                            alt="Offer Photo" class="modal-image" onerror="this.onerror=null; this.src='images/Werkzeug.jpg'"/>
                    </div>

                    <?php include ("./PHP/submitBooking.php"); ?>

                    <form class="modal-booking-window" enctype="multipart/form-data" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post">
                        <h3 class="modal-booking-heading">Nur noch ein Schritt!</h3>
                        
                            <label for="bookingDate">Datum:</label>
                            <input type="date" id="bookingDate" name = "<?php echo htmlspecialchars($datename);?>" value="<?php echo htmlspecialchars($date);?>" required><br>

                            <p class="modal-booking-text">Gesamtbetrag: <em name="<?php echo htmlspecialchars($pricename);?>"><?php echo $price ?></em> €<br></p>

                            <input id="bierInput" type="checkbox" name="<?php echo htmlspecialchars($bezinbier);?>">
                            <label id="bierLabel" for="<?php echo htmlspecialchars($bezinbier);?>"> Ich möchte in Bier bezahlen (<?php echo $bier ?> Bier)</label><br>
                                <script>
                                    if(<?php echo $bezBier ?> != 1) {
                                        document.getElementById("<?php echo $modal_ID ?>").querySelector("#bierLabel").style.display = "none";
                                        document.getElementById("<?php echo $modal_ID ?>").querySelector("#bierInput").style.display = "none";
                                    }
                                </script>

                            <label for="paymentType">Wähle die Bezahlart:</label>
                            <select name="paymentType" id="paymentType">
                                <option value="inPerson">vor Ort bezahlen</option>
                            </select>

                        <button type="submit" class="submitBooking">Jetzt buchen</button>
                    </form>



                </div>
                <div class="modal-footer"></div>
            </div>

        </div>
    </div>

<?php

    }
} else {
    echo "0 results";
}
$conn->close();
?>