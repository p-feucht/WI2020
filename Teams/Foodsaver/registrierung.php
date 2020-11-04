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
    <link href="Metadaten/registrierung.css" rel="stylesheet">

    <script>
    var loadFile = function(event) {
      var output = document.getElementById('output');
      output.src = URL.createObjectURL(event.target.files[0]);
      output.onload = function() {
        URL.revokeObjectURL(output.src) // free memory
      }
    };
    </script>
</head>

<body>
  <?php
  $_SESSION['last_page'] = $_SERVER['HTTP_REFERER'];
  if(($_SESSION['last_page'] == 'http://foodsaver.bplaced.net/registrierung.php') or ($_SESSION['last_page'] == 'http://foodsaver.bplaced.net/login.php')){
    $_SESSION['last_page'] = 'http://foodsaver.bplaced.net/index.php';
  }
    require("Metadaten/chooseHeader.php");
  ?>

  <div id="main">
    <div class="container"> 

      <form id="contact" action="database/contactToDB.php" method="post" enctype="multipart/form-data">

        <h3>Registrierung</h3>
        <h4>Hier kannst du dich für Foodsaver registrieren</h4>

        <div class="profile_data">

          <div class="contact_data">
            <Legend>Kontaktdaten</Legend>

            <fieldset>
              <input placeholder="Nachname" name="nachname" type="text" tabindex="1" required autofocus>
            </fieldset>

            <fieldset>
              <input placeholder="Vorname" name="vorname" type="text" tabindex="1" required autofocus>
            </fieldset>

            <fieldset>
              <input placeholder="Firma (optional)" name="company" type="text" tabindex="1">
            </fieldset>

            <fieldset>
              <input placeholder="Straße" name="street" type="text" tabindex="1" required>
            </fieldset>

            <fieldset>
              <input placeholder="Hausnummer" name="hausnummer" type="text" tabindex="1" required autofocus>
            </fieldset>

            <fieldset>
              <input placeholder="PLZ" name="plz" type="text" tabindex="1" required autofocus>
            </fieldset>

            <fieldset>
              <input placeholder="Ort" name="ort" type="text" tabindex="1" required autofocus>
            </fieldset>
            
            <fieldset>
              <input placeholder="Telefonnummer" name="telefon" type="tel" tabindex="1" required>
            </fieldset>
          </div>

          <div class="login_data">
            <Legend>Logindaten</Legend>
            <fieldset>
              <input placeholder="Benutzername" name="username" type="text" tabindex="1" required autofocus>
            </fieldset>

            <fieldset>
              <input placeholder="E-Mail" name="email" type="email" tabindex="1" required>
            </fieldset>

            <fieldset>
              <input placeholder="Passwort" name="password" type="password" tabindex="1" required>
            </fieldset>

            <fieldset>
              <input placeholder="Passwort Wiederholung" name="password_re" type="password" tabindex="1" required>
            </fieldset>
            <img id="output"/>
          </div>
        </div>

        <fieldset>
          <input type="checkbox" id="agb" name="agb" required>
          <label for="agb"><a id="agb_label" href="AGB.php" target="_blank">AGB</a></label>
        </fieldset>
    <div id="inputProfile">
        <form action="database/contactToDB.php" method="POST" id="profilePicture" enctype="multipart/form-data">
          <label for="img">Füge ein Profilbild hinzu:</label>
          <input type="file" id="profileImage" name="profileImage" accept="image/*"  onchange="loadFile(event)" >
          <fieldset>
  </div>
            <button name="submit" type="submit" id="submit" tabindex="1" data-submit="...Sending">Registrieren</button>
          </fieldset>
        </form>
      </form>
    </div>
  </div>
  
    <?php
    require("Metadaten/footer.php");
    ?>
    
</body>

</html>