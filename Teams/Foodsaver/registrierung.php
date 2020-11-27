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
  <link href="Metadaten/registrierung.css" rel="stylesheet">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

  <script>
    //Preview vom Profilbild
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
  <link rel="icon" href="Pictures/Logo_Bild.png" />
</head>

<body>
  <?php

  //Prüft, ob die letzte Seite (Seite zuvor) Login oder Registrierung ist
  //Wenn ja, wird Session['last_page'] nicht neu gespeichert
  //Wenn nein, wird der Link zur vorherigen Seite gespeichert
  //Dadurch wird der User nach Registrierung zu der Seite zurückgeführt, auf der er vor dem Login oder Registrierung war
  //Wenn er zuvor lange nach einem Record gesucht hat, wird er so nach der Registrierung z.B. nicht zum Login geleitet, sonder kommt wieder zu diesem Record zurück
  if (isset($_SESSION['wrong_email']) or isset($_SESSION['wrong_pwd'])) {
    $user = $_GET['user'];
    $actual_link = "https://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
    if (($actual_link != 'https://foodsaver.bplaced.net/registrierung.php') and ($actual_link != 'https://foodsaver.bplaced.net/registrierung.php?error_user&user=' . $user . '')
      and ($actual_link != 'https://foodsaver.bplaced.net/registrierung.php?error_pwd&user=' . $user . '') and ($actual_link != 'https://foodsaver.bplaced.net/registrierung.php?error=missing_fields')
      and ($actual_link != 'https://foodsaver.bplaced.net/registrierung.php?contactToDB.php' . $user . '') and ($actual_link != 'https://foodsaver.bplaced.net/logindataToDB.php')
      and (!fnmatch('https://foodsaver.bplaced.net/login.php*', $actual_link)) and (!fnmatch('https://foodsaver.bplaced.net/registrierung.php*', $actual_link))
    ) {

      $_SESSION['last_page'] = $_SERVER['HTTP_REFERER'];
    }
  } else {
    if ((!fnmatch('https://foodsaver.bplaced.net/login.php*', $_SERVER['HTTP_REFERER'])) and (!fnmatch('https://foodsaver.bplaced.net/registrierung.php*', $_SERVER['HTTP_REFERER']))) {
      $_SESSION['last_page'] = $_SERVER['HTTP_REFERER'];
    }
  }

  require("Metadaten/chooseHeader.php");
  ?>
  <div id="main">
    <div class="container">
      <!-- Formular zur Registrierung 
           Bei einer Fehler werden die Daten wieder in die Felder geschrieben -->
      <form id="contact" action="database/contactToDB.php" method="POST" enctype="multipart/form-data">

        <h3>Registrierung</h3>

        <div class="profile_data">

          <div class="contact_data">
            <Legend>Kontaktdaten</Legend>

            <fieldset>
              <input placeholder="Nachname" name="nachname" type="text" tabindex="1" required autofocus value="<?php if (isset($_GET['nachname'])) {
                                                                                                                  echo ($_GET['nachname']);
                                                                                                                } else {
                                                                                                                  echo "";
                                                                                                                } ?>">
            </fieldset>

            <fieldset>
              <input placeholder="Vorname" name="vorname" type="text" tabindex="1" required autofocus value="<?php if (isset($_GET['vorname'])) {
                                                                                                                echo ($_GET['vorname']);
                                                                                                              } else {
                                                                                                                echo "";
                                                                                                              } ?>">
            </fieldset>

            <fieldset>
              <input placeholder="Firma (optional)" name="company" type="text" tabindex="1" value="<?php if (isset($_GET['firma'])) {
                                                                                                      echo ($_GET['firma']);
                                                                                                    } else {
                                                                                                      echo "";
                                                                                                    } ?>">
            </fieldset>

            <fieldset>
              <input placeholder="Straße" name="street" type="text" tabindex="1" required value="<?php if (isset($_GET['strasse'])) {
                                                                                                    echo ($_GET['strasse']);
                                                                                                  } else {
                                                                                                    echo "";
                                                                                                  } ?>">
            </fieldset>

            <fieldset>
              <input placeholder="Hausnummer" name="hausnummer" type="text" tabindex="1" required autofocus value="<?php if (isset($_GET['hausnummer'])) {
                                                                                                                      echo ($_GET['hausnummer']);
                                                                                                                    } else {
                                                                                                                      echo "";
                                                                                                                    } ?>">
            </fieldset>

            <fieldset>
              <input placeholder="PLZ" name="plz" type="text" tabindex="1" required autofocus value="<?php if (isset($_GET['plz'])) {
                                                                                                        echo ($_GET['plz']);
                                                                                                      } else {
                                                                                                        echo "";
                                                                                                      } ?>">
            </fieldset>

            <fieldset>
              <input placeholder="Ort" name="ort" type="text" tabindex="1" required autofocus value="<?php if (isset($_GET['ort'])) {
                                                                                                        echo ($_GET['ort']);
                                                                                                      } else {
                                                                                                        echo "";
                                                                                                      } ?>">
            </fieldset>

            <fieldset>
              <input placeholder="Telefonnummer" name="telefon" type="tel" tabindex="1" required value="<?php if (isset($_GET['tel'])) {
                                                                                                          echo ($_GET['tel']);
                                                                                                        } else {
                                                                                                          echo "";
                                                                                                        } ?>">
            </fieldset>
            <fieldset>
              <input type="checkbox" id="agb" name="agb" required <?php if (isset($_GET['ort'])) {
                                                                    echo 'checked';
                                                                  } ?>>
              <label for="agb"><a id="agb_label" href="/AGB.php" target="_blank">AGB</a></label>
            </fieldset>
          </div>

          <div class="login_data">
            <Legend>Logindaten</Legend>
            <fieldset>
              <input placeholder="Benutzername" name="username" type="text" tabindex="1" required pattern="[^\s]+" value="<?php if (isset($_GET['benutzername'])) {
                                                                                                                            echo ($_GET['benutzername']);
                                                                                                                          } else {
                                                                                                                            echo "";
                                                                                                                          } ?>">
            </fieldset>

            <fieldset>
              <input placeholder="E-Mail" name="email" type="email" tabindex="1" required pattern="[^\s]+" value="<?php if (isset($_GET['email'])) {
                                                                                                                    echo ($_GET['email']);
                                                                                                                  } else {
                                                                                                                    echo "";
                                                                                                                  } ?>">
            </fieldset>

            <fieldset>
              <input placeholder="Passwort" name="password" type="password" tabindex="1" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{4,}" required value="">
            </fieldset>

            <fieldset>
              <input placeholder="Passwort bestätigen" name="password_re" type="password" tabindex="1" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{4,}" required value="">
            </fieldset>
            <div id='inputProfile'>

              <label for='img'>Füge ein Profilbild hinzu:</label>
              <input type="file" id="profileImage" name="profileImage" accept="image/*" onchange="loadFile(event)">
              <a class="fancybox" id="fancy" rel="gallery" href=""><img id="output" /></a>
            </div>
          </div>
        </div>
        <fieldset>
          <button name="submit" type="submit" id="submit" tabindex="1" data-submit="...Sending">Registrieren</button>
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
    //Ausgabe der Fehlermeldungen
    $(function() {
      $("input[name=password]")[0].oninvalid = function() {
        this.setCustomValidity("Passwort muss mindestens 4 Zeichen, einen Großbuchstaben und eine Zahl beinhalten!");
      };
    });


    $(function() {
      $("input[name=password]")[0].oninput = function() {
        this.setCustomValidity("");
      };
    });

    $(function() {
      $("input[name=password_re]")[0].oninvalid = function() {
        this.setCustomValidity("Passwort muss mindestens 4 Zeichen, einen Großbuchstaben und eine Zahl beinhalten!");
      };
    });


    $(function() {
      $("input[name=password_re]")[0].oninput = function() {
        this.setCustomValidity("");
      };
    });
  </script>

</body>

</html>