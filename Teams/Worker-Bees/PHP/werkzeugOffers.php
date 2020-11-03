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
PLZ, Ort, Bild, usernameErsteller, Werkzeug_ID, PreisProTag, BezInBier, Erstellzeitpunkt FROM AangebotWerkzeug";
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

        $card_ID = "WZcard_".(string)$orderID;
        $modal_target = "#WZmodal_".(string)$orderID;
        $modal_ID = "WZmodal_".(string)$orderID;

    ?>
        <!-- create card for each offer -->
        <div class="card" id=<?php echo $card_ID ?> data-toggle="modal" data-target=<?php echo $modal_target ?>>
            <img src="images/werkstatt.jpg" alt="Denim Jeans" class="offer-image">
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
                    <img class="headerLogo" src="images/logoKomplett.png">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body">
                    <h3 class="modal-offerName"><?php echo $title ?></h3>
                    <p class="modal-namelocation"><?php echo $offeruser ?>
                        <img src="images/place-icon.svg" class="place-icon" alt="location"><?php echo $plz ?> <?php echo $location ?>
                        <!--has to be the exact location here!-->
                    </p>

                    <div class="modal-content-split">
                        <p class="offer-description">
                            <?php echo $description ?>
                        </p>
                        <!--only for Werkstat!!
                        <ul class="modal-amenities">
                            <li>Standbohrmaschine</li>
                            <li>elektrische Standsägen</li>
                        </ul>
                        -->
                    </div>
                    <div class="modal-content-split">
                        <img src="images/Werkzeug.jpg" class="modal-image" alt="Angebot">
                    </div>

                    <form class="modal-booking-window">
                        <h3 class="modal-booking-heading">Nur noch ein Schritt!</h3>
                        
                            <label for="bookingDate">Datum:</label>
                            <input type="date" id="bookingDate"><br>

                            <p class="modal-booking-text">Gesamtbetrag: 1000 €<br></p>

                            <input type="checkbox" name="bierZahlung">
                            <label for="bierZahlung"> Ich möchte in Bier bezahlen (1000 Bier)</label><br>

                            <label for="paymentType">Wähle die Bezahlart:</label>
                            <select name="paymentType" id="paymentType">
                                <option value="inPerson">vor Ort bezahlen</option>
                            </select>

                        <button type="button" class="submitBooking">Jetzt buchen</button>
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