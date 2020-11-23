<?php

$servername = "localhost";
$username = "workerbees";
$password = "HKSZ52";
$dbname = "workerbees_db1";

// Create connection
$dconn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($dconn->connect_error) {
    die("Connection failed: " . $dconn->connect_error);
}

$sql = "SELECT ATitel, ABeginndat, AEndedat, ABeschreibung,
PLZ, Ort, Bild, usernameErsteller, Dienstleistung_ID, Preis, BezInBier, Preisart FROM AngebotDienstleistung";
$result = $dconn->query($sql);

if ($result->num_rows > 0) {
    // output data of each row
    while ($row = $result->fetch_assoc()) {

        $beginDat = $row["ABeginndat"];
        $endDat = $row["AEndedat"];
        $orderID = $row["Dienstleistung_ID"];
        $location = $row["Ort"];
        $title = $row["ATitel"];
        $price = $row["Preis"];
        $offeruser = $row["usernameErsteller"];
        $plz = $row["PLZ"];
        $description = $city = $row["ABeschreibung"];
        $bezBier = $row["BezInBier"];
        $image = $row["Bild"];

        $card_ID = "Dcard_" . (string)$orderID;
        $modal_target = "#Dmodal_" . (string)$orderID;
        $modal_ID = "Dmodal_" . (string)$orderID;

        $bier = round($price, 0); // so that beer is counted in whole beers

?>
        <!-- create card for each offer data-target = modal-id-->
        <div class="card" id="<?php echo $card_ID ?>" data-toggle="modal" data-target=<?php echo $modal_target ?>>
            <img src="data:image/jpg;charset=utf8;base64,<?php echo base64_encode($image); ?>" loading="lazy"
            alt="Offer Photo" class="offer-image" onerror="this.onerror=null; this.src='images/Werkzeug.jpg'" />
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
                        <h3 class="modal-offerName"><?php echo $title ?></h3>
                        <p class="modal-namelocation"><?php echo $offeruser ?>
                            <img src="images/place-icon.svg" class="place-icon" alt="location"><?php echo $plz ?> <?php echo $location ?>
                        </p>

                        <div class="modal-content-split">
                            <p class="offer-description">
                                <?php echo $description ?>
                            </p>

                        </div>
                        <div class="modal-content-split">
                            <img src="data:image/jpg;charset=utf8;base64,<?php echo base64_encode($image); ?>" alt="Offer Photo" class="modal-image" onerror="this.onerror=null; this.src='images/Werkzeug.jpg'" />
                        </div>

                        
                         <!--Create booking window -->
                        <form class="modal-booking-window" enctype="multipart/form-data" 
                            action="../submitBooking.php" method = "post">
                            <input type='hidden' name='orderID' value='<?php echo $orderID;?>'/> <!--Pass order ID in hidden element to php -->
                            
                            <h3 class="modal-booking-heading">Nur noch ein Schritt!</h3>

                            <label for="bookingDate">Datum:</label>
                            <input type="date" name="Date" min="<?php echo $beginDat ?>" max="<?php echo $endDat ?>" value="<?php echo htmlspecialchars($date); ?>" required><br>

                            <p class="modal-booking-text">Gesamtbetrag: <?php echo $price ?> €<br></p>

                            <input id="bierInput" type="checkbox" name="bezInBier" value="1" unchecked>
                            <label id="bierLabel" for="bezInBier"> Ich möchte in Bier bezahlen (<?php echo $bier ?> Bier)</label><br>
                            <script defer>
                                if (<?php echo $bezBier ?> != 1) { // only show "pay in beer" if option was selected at offer creation
                                    document.getElementById("<?php echo $modal_ID ?>").querySelector("#bierLabel").style.display = "none";
                                    document.getElementById("<?php echo $modal_ID ?>").querySelector("#bierInput").style.display = "none";
                                }
                            </script>

                            <label for="paymentType">Wähle die Bezahlart:</label>
                            <select name="paymentType" id="paymentType">
                                <option value="inPerson">vor Ort bezahlen</option>
                            </select>

                            <script></script>
                            <button type="submit" class="submitBooking" onclick="<?php $_SESSION['category'] = 'Dienstleistung';?>">Jetzt buchen</button>
                        </form>



                    </div>
                    <div class="modal-footer"></div>
                </div>

            </div>
        </div>

<?php

    }
} else {
    echo "Keine Einträge gefunden.";
}
$dconn->close();
?>