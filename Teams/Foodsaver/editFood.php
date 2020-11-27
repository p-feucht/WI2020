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
  <link href="Metadaten/add_food.css" rel="stylesheet">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="uploadMultipleImages.js"></script>
  <link rel="icon" href="Pictures/Logo_Bild.png" />

</head>

<body>
  <?php

  $_SESSION['last_page'] = $_SERVER['HTTP_REFERER'];

  require("Metadaten/chooseHeader.php");
  require('database/connectDB.php');

  ?>

  <main>

    <div class="food_information">
      <!-- Formular um eine Anzeige zu berarbeiten. Felder werden schon im vorraus gesetzt  -->
      <form id="contact" action="database/editFoodInfo.php?id=<?php echo ($_GET['id']); ?>" method="POST" multiple enctype="multipart/form-data">
        <h3>Anzeige bearbeiten</h3>

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
            <?php
            $id2 = $_GET['id'];
            $SELECT = mysqli_query($db_link, "SELECT * From `tbl_records` WHERE ID = '$id2'");
            $row = mysqli_fetch_array($SELECT);
            $nameGericht = $row['Artikel'];
            $Beschreibung = $row['Beschreibung'];
            $Menge = $row['Menge'];
            $Preis2 = $row['Preis'];
            if ($row['Kategorie'] == 'Private_Haushalte') {
              $Kategorie = 'Private Haushalte';
            } else {
              $Kategorie = $row['Kategorie'];
            }
            echo ("<fieldset>
                            <input placeholder='Lebensmittel/Gericht' name='food' type='text' tabindex='1' value='" . $nameGericht . "' required>
                        </fieldset>
                        <textarea id='description' name='description' rows='4' cols='50' placeholder='Beschreibung*' tabindex='1'>$Beschreibung</textarea>");


            echo '
                <fieldset>
                <select name="categorie" id="categorie">
                  <option value="' . $Kategorie . '" selected>' . $Kategorie . '</option>
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
                  <option value="' . $row['LänderKüche'] . '" selected>' . $row['LänderKüche'] . '</option>
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
                    <input placeholder="Menge" name="amount" type="number" pattern="^(?!0*(\.0+)?$)(\d+|\d*\.\d+)$" tabindex="1" step=".01" value=' . ($Menge == 0 ? "1" : "$Menge") . ' required>
                </fieldset>

                <fieldset>
                    <input placeholder="Preis" name="price" type="number" tabindex="1" step=".01" value=' . $Preis2 . ' required>
                </fieldset>';
            ?>
            <div class="gallery"></div>
          </div>
        </div>

        <form action="database/addFoodToDB.php" method="POST" id="upload_multiple_images" multiple enctype="multipart/form-data">
          <label for="img">Füge deine Bilder hinzu:</label>
          <input type="file" id="image" name="image[]" accept="image/*" multiple>


          <fieldset>
            </br>
            <button name="Record_change" type="submit" id="submit" tabindex="1" data-submit="...Sending">Speichern</button>
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


  $record_id = $_GET['id'];
  $SELECTIMG = mysqli_query($db_link, "SELECT * From `Images` WHERE ArtikelID = $record_id AND Thumbnail = 0");
  $row_count = mysqli_num_rows($SELECTIMG);
  $img_array = array();
  while ($row_img = mysqli_fetch_array($SELECTIMG)) {
    array_push($img_array, $row_img['imageLink']);
  }
  $_SESSION['editFood_imgArray'] = $img_array;

  #require("Metadaten/footer.php");
  if (isset($_SESSION['session_user'])) {
    echo ('<script src="autologout.js" type="text/javascript"></script>');
  }
  ?>


  <script>
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

    function showCurrentPictures() {
      $("div.gallery").html("");
      let placeToInsertImagePreview = "div.gallery";
      php_array = <?php echo json_encode($_SESSION['editFood_imgArray']); ?>;
      let arrayLength = php_array.length;
      if (arrayLength > 0) {
        for (i = 0; i < arrayLength; i++) {
          var data = php_array[i];
          var link = $('<a class="fancybox" id="fancy" rel="gallery" data-type="image">').attr('href', data);
          $('<img id="output"></a>').attr('src', data).appendTo(link);
          link.appendTo(placeToInsertImagePreview);

        }

      }

      $(".fancybox").fancybox({
        type: 'image'
      });
    }

    window.addEventListener("load", function() {
      showCurrentPictures();
    });
  </script>






</body>

</html>