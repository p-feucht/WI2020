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
  <link href="Metadaten/edit_profile.css" rel="stylesheet">
  <link rel="icon" href="Pictures/Logo_Bild.png" />

  <script>
    var loadFile = function(event) {
      var output = document.getElementById('output');
      var fancy = document.getElementById('fancy');
      output.src = URL.createObjectURL(event.target.files[0]);
      fancy.href = output.src;
      $(".fancybox").fancybox({
        type: 'image'
      });

    };
  </script>

</head>

<body>
  <?php
  $_SESSION['last_page'] = $_SERVER['HTTP_REFERER'];
  require("Metadaten/chooseHeader.php");

  ?>

  <div id="main">
    <div class="container">
      <!-- Formular um Profil zu bearbeiten, Felder werden mit den Aktuellen Daten belegt -->
      <form id="contact" action="database/editProfileInformations.php" method="post" enctype="multipart/form-data">

        <h3>Profil bearbeiten</h3>

        <div class="change_profile">
          <div class="change_contact_data">
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
            <input type="checkbox" id="changeRecordCheckBox" name="changeRecordCheckBox">
            <label for="horns">Meine Kontaktdaten bei allen bestehenden Anzeigen ändern</label>

          </div>

          <div class="change_login_data">
            <Legend>Login Daten</Legend>
            <fieldset>
              <input placeholder="Benutzername" name="username" type="text" tabindex="1" pattern="[^\s]+" value="<?php if (isset($_SESSION['session_username'])) {
                                                                                                                    echo ($_SESSION['session_username']);
                                                                                                                  } else {
                                                                                                                    echo "";
                                                                                                                  } ?>" required autofocus>
            </fieldset>

            <fieldset>
              <input placeholder="E-Mail" name="email" type="email" tabindex="1" pattern="[^\s]+" value="<?php if (isset($_SESSION['session_user'])) {
                                                                                                            echo ($_SESSION['session_user']);
                                                                                                          } else {
                                                                                                            echo "";
                                                                                                          } ?>" required>
            </fieldset>
            <fieldset>
              <input placeholder="Aktuelles Passwort" name="password" type="password" tabindex="1" required>
            </fieldset>

            <fieldset>
              <input placeholder="Neues Passwort*" name="new_password" type="password" tabindex="1" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{4,}">
            </fieldset>

            <fieldset>
              <input placeholder="Neues Passwort bestätigen*" name="new_password_re" type="password" tabindex="1" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{4,}">
            </fieldset>
            <p>Felder mit * sind optional. Nur bei Passwortwechsel erforderlich!</p>
            <label for="img">Profilbild ändern:</label>
            <input type="file" id="profileImage" name="profileImage" accept="image/*" onchange="loadFile(event)">
            <a class="fancybox" id="fancy" rel="gallery" href="<?php echo ($_SESSION['session_image']); ?>"><img id="output" src="<?php echo ($_SESSION['session_image']); ?>" /></a>
          </div>

        </div>
        <fieldset>
          <button name="submit" type="submit" id="submit" tabindex="1" data-submit="...Sending">Speichern</button>
        </fieldset>
      </form>
    </div>
  </div>

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

  <!-- Ausgabe der Fehlermeldungen -->
  <script>
    $(function() {
      $("input[name=username]")[0].oninvalid = function() {
        this.setCustomValidity("Der Benutzername darf keine Leerzeichen beinhalten!");
      };
    });


    $(function() {
      $("input[name=username]")[0].oninput = function() {
        this.setCustomValidity("");
      };
    });

    $(function() {
      $("input[name=new_password]")[0].oninvalid = function() {
        this.setCustomValidity("Passwort muss mindestens 4 Zeichen, einen Großbuchstaben und eine Zahl beinhalten!");
      };
    });


    $(function() {
      $("input[name=new_password]")[0].oninput = function() {
        this.setCustomValidity("");
      };
    });

    $(function() {
      $("input[name=new_password_re]")[0].oninvalid = function() {
        this.setCustomValidity("Passwort muss mindestens 4 Zeichen, einen Großbuchstaben und eine Zahl beinhalten!");
      };
    });


    $(function() {
      $("input[name=new_password_re]")[0].oninput = function() {
        this.setCustomValidity("");
      };
    });

    $(function() {
      $("input[name=password]")[0].oninvalid = function() {
        this.setCustomValidity("Bitte Passwort angeben, um die Änderungen zu speichern!");
      };
    });


    $(function() {
      $("input[name=password]")[0].oninput = function() {
        this.setCustomValidity("");
      };
    });
  </script>

</body>

</html>