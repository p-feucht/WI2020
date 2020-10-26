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
      <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
      <script src="uploadMultipleImages.js"></script>

    <script>
      
        $(function() {
    // Multiple images preview in browser
    var imagesPreview = function(input, placeToInsertImagePreview) {
      $("div.gallery").html("");
        if (input.files) {
            var filesAmount = input.files.length;

            for (i = 0; i < filesAmount; i++) {
                var reader = new FileReader();

                reader.onload = function(event) {
                    $($.parseHTML('<img id="output">')).attr('src', event.target.result).appendTo(placeToInsertImagePreview);
                }
                id="previewGallery"
                reader.readAsDataURL(input.files[i]);
            }
        }

    };

    $('#image').on('change', function() {
        imagesPreview(this, 'div.gallery');
    });
});

        </script>

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
                    <h4>Hier kannst du dein Essen bei Too Good to Waste hinzufügen</h4>

                    <fieldset>
                        <input placeholder="Lebensmittel/Gericht" name="food" type="text" tabindex="1" required>
                    </fieldset>

                    <textarea id="description" name="description" rows="4" cols="50" placeholder='Beschreibung*' tabindex="1"></textarea>
                    <!--fieldset>
                        <input placeholder="Beschreibung" name="description" type="text" tabindex="1" required>
                    </fieldset-->

                    <fieldset>
                        <input placeholder="Menge" name="amount" type="number" tabindex="1" required>
                    </fieldset>

                    <fieldset>
                        <input placeholder="Preis" name="price" type="number" tabindex="1" required>
                    </fieldset>

                    <fieldset>
                        <input placeholder="Username*" name="username" type="text" tabindex="1">
                    </fieldset>
                    <fieldset>
                        <input placeholder="Nachname*" name="nachname" type="text" tabindex="1">
                    </fieldset>

                    <fieldset>
                      <input placeholder="Vorname*" name="vorname" type="text" tabindex="1" >
                    </fieldset>

                    <fieldset>
                      <input placeholder="Firma*" name="company" type="text" tabindex="1">
                    </fieldset>

                    <fieldset>
                      <input placeholder="Straße*" name="street" type="text" tabindex="1" >
                    </fieldset>

                    <fieldset>
                      <input placeholder="Hausnummer*" name="hausnummer" type="text" tabindex="1" >
                    </fieldset>

                    <fieldset>
                      <input placeholder="PLZ*" name="plz" type="text" tabindex="1" >
                    </fieldset>

                    <fieldset>
                      <input placeholder="Ort*" name="ort" type="text" tabindex="1" >
                    </fieldset> 

                    <fieldset>
                      <input placeholder="Telefonnummer*" name="telefon" type="tel" tabindex="1" >
                    </fieldset>

                    <fieldset>
                      <input placeholder="E-Mail*" name="email" type="email" tabindex="1">
                    </fieldset>

                    <form action="database/addFoodToDB.php" method="POST" id="upload_multiple_images" multiple enctype="multipart/form-data">
                      <label for="img">Füge deine Bilder hinzu:</label>
                      <input type="file" id="image" name="image[]" accept="image/*" multiple >
                      <div class="gallery"></div>

                      <fieldset>
                          </br>
                          <button name="submit" type="submit" id="submit" tabindex="1" data-submit="...Sending">Hinzufügen</button>
                      </fieldset>
                    </form>
                </form>
            </div>

            <p>Felder die mit * gekennzeichnet sind, sind optional.</p>
            <p>Falls Sie diese Felder nicht ausfüllen, werden die Daten aus Ihrem Benutzerkonto übernommen.</p>

        </main>
       

    <?php
    require("Metadaten/footer.php");
    ?>


    </body>

    </html>

