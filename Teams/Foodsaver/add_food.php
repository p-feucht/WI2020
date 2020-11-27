<?php
session_start();
?>

<!doctype html>

<html lang="de">

<head>
  <meta charset="UTF-8">
  <title>Foodsaver - Too Good to Waste</title>
  <meta name="description" content="Webseite zur Vermeidung von Lebensmittelverschwendung">
  <link href="Metadaten/design.css" rel="stylesheet">
  <link href="Metadaten/add_food.css" rel="stylesheet">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="uploadMultipleImages.js"></script>
  <link rel="icon" href="Pictures/Logo_Bild.png" />
</head>

<body>
  <?php

  $_SESSION['last_page'] = $_SERVER['HTTP_REFERER'];

  require("Metadaten/chooseHeader.php");

  ?>

  <!--div id="headline">
            <p>Hinzufügen von Essen</p>
        </div-->

  <main>

    <div class="food_information">
      <form id="contact" action="database/addFoodToDB.php" method="post" enctype="multipart/form-data">
        <h3>Hinzufügen von Essen</h3>

        <div class="add_food_data">

          <div class="add_food_contact_data">
            <Legend>Kontaktdaten</Legend>

            <fieldset>
              <input placeholder="Nachname" name="nachname" type="text" tabindex="1" value="<?php if (isset($_SESSION['session_lastname'])) {
                                                                                              echo ($_SESSION['session_lastname']);
                                                                                            } else {
                                                                                              echo "";
                                                                                            } ?>" required autofocus>
            </fieldset>

            <fieldset>
              <input placeholder="Vorname" name="vorname" type="text" tabindex="1" value="<?php if (isset($_SESSION['session_firstname'])) {
                                                                                            echo ($_SESSION['session_firstname']);
                                                                                          } else {
                                                                                            echo "";
                                                                                          } ?>" required autofocus>
            </fieldset>

            <fieldset>
              <input placeholder="Firma" name="company" type="text" tabindex="1" value="<?php if (isset($_SESSION['session_company'])) {
                                                                                          echo ($_SESSION['session_company']);
                                                                                        } else {
                                                                                          echo "";
                                                                                        } ?>">
            </fieldset>

            <fieldset>
              <input placeholder="Straße" name="street" type="text" tabindex="1" value="<?php if (isset($_SESSION['session_street'])) {
                                                                                          echo ($_SESSION['session_street']);
                                                                                        } else {
                                                                                          echo "";
                                                                                        } ?>" required>
            </fieldset>

            <fieldset>
              <input placeholder="Hausnummer" name="hausnummer" type="text" tabindex="1" value="<?php if (isset($_SESSION['session_housenr'])) {
                                                                                                  echo ($_SESSION['session_housenr']);
                                                                                                } else {
                                                                                                  echo "";
                                                                                                } ?>" required autofocus>
            </fieldset>

            <fieldset>
              <input placeholder="PLZ" name="plz" type="text" tabindex="1" value="<?php if (isset($_SESSION['session_plz'])) {
                                                                                    echo ($_SESSION['session_plz']);
                                                                                  } else {
                                                                                    echo "";
                                                                                  } ?>" required autofocus>
            </fieldset>

            <fieldset>
              <input placeholder="Ort" name="ort" type="text" tabindex="1" value="<?php if (isset($_SESSION['session_ort'])) {
                                                                                    echo ($_SESSION['session_ort']);
                                                                                  } else {
                                                                                    echo "";
                                                                                  } ?>" required autofocus>
            </fieldset>

            <fieldset>
              <input placeholder="Telefonnummer" name="telefon" type="tel" tabindex="1" value="<?php if (isset($_SESSION['session_tel'])) {
                                                                                                  echo ($_SESSION['session_tel']);
                                                                                                } else {
                                                                                                  echo "";
                                                                                                } ?>" required>
            </fieldset>
          </div>

          <div class="food_data">
            <Legend>Verkaufsdaten</Legend>

            <fieldset>
              <input placeholder="Lebensmittel/Gericht" name="food" type="text" tabindex="1" value="" required>
            </fieldset>

            <textarea id="description" name="description" rows="4" cols="50" placeholder='Beschreibung*' value="" tabindex="1"></textarea>
            <!--fieldset>
                            <input placeholder="Beschreibung" name="description" type="text" tabindex="1" required>
                        </fieldset-->
            <fieldset>
              <select name="categorie" id="categorie">
                <option value="" disabled selected>Kategorie</option>
                <option value="Bäckerei">Bäckerei</option>
                <option value="Imbiss">Imbiss</option>
                <option value="Private_Haushalte">Private Haushalte</option>
                <option value="Restaurant">Restaurant</option>
                <option value="Supermarkt">Supermarkt</option>
                <option value="Sonstige">Sonstige</option>
              </select>
            </fieldset>
            <fieldset>
              <select name="kitchen" id="kitchen">
                <option value="" disabled selected>Küche</option>
                <option value="Chinesisch">Chinesisch</option>
                <option value="Französisch">Französisch</option>
                <option value="Griechisch">Griechisch</option>
                <option value="Italienisch">Italienisch</option>
                <option value="Mexikanisch">Mexikanisch</option>
                <option value="Türkisch">Türkisch</option>
                <option value="Deutsch">Deutsch</option>
                <option value="Sonstige">Sonstige</option>
              </select>
            </fieldset>

            <fieldset>
              <input placeholder="Menge" name="amount" type="number" tabindex="1" value="" step=".1" required>
            </fieldset>

            <fieldset>
              <input placeholder="Preis" name="price" type="number" tabindex="1" value="" step=".01" required>
            </fieldset>
            <div class="gallery"></div>
          </div>
        </div>

        <form action="database/addFoodToDB.php" method="POST" id="upload_multiple_images" multiple enctype="multipart/form-data">
          <label for="img">Füge deine Bilder hinzu:</label>
          <input type="file" id="image" name="image[]" accept="image/*" multiple>


          <fieldset>
            </br>
            <button name="submit" type="submit" id="submit" tabindex="1" data-submit="...Sending">Hinzufügen</button>
          </fieldset>

          <div class="annotation_add_food">
            <p>Felder, die mit * gekennzeichnet sind, sind optional.</p>
            <p>Werden diese nicht ausgefüllt, werden die Daten aus Ihrem Benutzerkonto übernommen.</p>
          </div>
        </form>
      </form>
    </div>

    <!--div class="annotation_add_food">
              <p>Felder die mit * gekennzeichnet sind, sind optional.</p>
              <p>Falls Sie diese Felder nicht ausfüllen, werden die Daten aus Ihrem Benutzerkonto übernommen.</p>
            </div-->
  </main>


  <?php
  require("Metadaten/footer.php");
  if (isset($_SESSION['session_user'])) {
    echo ('<script src="autologout.js" type="text/javascript"></script>');
  }
  ?>

  <script>
    jQuery(document).ready(function() {
      $(".fancybox").fancybox({
        type: 'image'
      });
    });
  </script>

  <script>
    // Preview der Bilder
    $(function() {
      // Multiple images preview in browser
      var imagesPreview = function(input, placeToInsertImagePreview) {
        $("div.gallery").html("");
        if (input.files) {
          var filesAmount = input.files.length;

          for (i = 0; i < filesAmount; i++) {

            var data = URL.createObjectURL(input.files[i]);
            var link = $($.parseHTML('<a class="fancybox" id="fancy" rel="gallery" data-type="image">')).attr('href', data);
            $($.parseHTML('<img id="output"></a>')).attr('src', data).appendTo(link);
            link.appendTo(placeToInsertImagePreview);


          }
        }
        $(".fancybox").fancybox({
          type: 'image'
        });
      };

      $('#image').on('change', function() {
        imagesPreview(this, 'div.gallery');
      });
    });
  </script>



</body>

</html>