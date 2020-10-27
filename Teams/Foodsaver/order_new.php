<?php
session_start();
?>

<!doctype html>

<html lang="de">
    
    <head>
        <meta charset="UTF-8">
        <title>Too Good to Waste</title>
        <meta name="description" content="Webseite zur Vermeidung von Lebensmittelverschwendung">
        <link href="Metadaten/design.css" rel="stylesheet">
        <link href="order_new.css" rel="stylesheet">
    </head>

    <body>

    <?php
        $_SESSION['last_page'] = $_SERVER['HTTP_REFERER'];

        require("Metadaten/chooseHeader.php");
    ?>

    <!-- Name des Gerichts anfragen und als Überschrift setzten ? -->
    <div id="headline">
            <p>Bestellung</p>
    </div>

    <div class="big_container">
        <!-- Hinzugefügtes Bild -->
        <div id="image_chocolate_cake">
            <img src="test.jpg" alt="Chocolate Cake">
        </div>

        <!-- Beschreibung des Gerichts -->
        <div class="description_food">
            <label for="description_food">Beschreibung des Gerichts: </label>
        </div>

        <!-- Anzeige Kontaktdaten des Verkäufers -->
        <div class="contact_details">
            <label for="contact_details">Kontaktdaten: </label>
            
            <div id="contact_seller_button">
                <button name="contact" type="submit" id="contact_seller" tabindex="1" data-submit="...Sending">Verkäufer kontaktieren</button>
            </div>
        </div>

        <div class="order">
            <div class="container_two_one">
                <label for="input_amount">Bestellmenge: </label>
                <input id="input_amount" placeholder="Menge" name="amount" type="number" tabindex="1" required>
            </div>

            <div class="container_two_two">
                <label for="annotation">Anmerkung: </label>
                <textarea id="annotation" name="annotation" rows="5" cols="50" tabindex="1"></textarea>
            </div>

            <div id="container_two_three">
                <button name="submit" type="submit" id="submit" tabindex="1" data-submit="...Sending">Bestellung aufgeben</button>
            </div>
        </div>
    </div>

    <?php
    require("Metadaten/footer.php");
    ?>

    </body>

    </html>