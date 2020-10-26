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
    require("Metadaten/chooseHeader.php");
    
  ?>

  <div id="main">
    <div class="container">  

      <form id="contact" action="database/contactToDB.php" method="post" enctype="multipart/form-data">

        <h3>Registrierung</h3>
        <h4>Hier kannst du dich für Too Good to Waste registrieren</h4>

        <Legend>Login Daten</Legend>
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

        <fieldset>
        <input type="checkbox" id="agb" name="agb" required>
        <label for="agb"><a href="AGB.php" target="_blank">AGB</a></label>
        </fieldset>

        <form action="database/contactToDB.php" method="POST" id="profilePicture" enctype="multipart/form-data">
                      <label for="img">Füge ein Profilbild hinzu:</label>
                      <input type="file" id="profileImage" name="profileImage" accept="image/*"  onchange="loadFile(event)" >
                      <img id="output"/>

                      <fieldset>
                <button name="submit" type="submit" id="submit" tabindex="1" data-submit="...Sending">Registrieren</button>
                  </fieldset>
          </form>

        
        <a href="login.php">Anmelden</a>
      </form>
    </div>
  </div>
  
    <?php
    require("Metadaten/footer.php");
    ?>
    
</body>

</html>