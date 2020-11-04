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
    <link href="Metadaten/edit_profile.css" rel="stylesheet">


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

      <form id="contact" action="database/editProfileInformations.php" method="post" enctype="multipart/form-data">

        <h3>Profil bearbeiten</h3>

        <div class="change_profile">
          <div class="change_contact_data">
            <Legend>Kontaktdaten</Legend>
            <fieldset>
              <input placeholder="Nachname" name="nachname" type="text" tabindex="1" value="<?php if(isset($_SESSION['session_lastname'])){echo ($_SESSION['session_lastname']);} else{echo "";} ?>"  required autofocus>
            </fieldset>

            <fieldset>
              <input placeholder="Vorname" name="vorname" type="text" tabindex="1" value="<?php if(isset($_SESSION['session_firstname'])){echo ($_SESSION['session_firstname']);} else{echo "";} ?>"  required autofocus>
            </fieldset>

            <fieldset>
              <input placeholder="Firma" name="company" type="text" tabindex="1" value="<?php if(isset($_SESSION['session_company'])){echo ($_SESSION['session_company']);} else{echo "";} ?>" >
            </fieldset>

            <fieldset>
              <input placeholder="Straße" name="street" type="text" tabindex="1" value="<?php if(isset($_SESSION['session_street'])){echo ($_SESSION['session_street']);} else{echo "";} ?>"  required>
            </fieldset>

            <fieldset>
              <input placeholder="Hausnummer" name="hausnummer" type="text" tabindex="1" value="<?php if(isset($_SESSION['session_housenr'])){echo ($_SESSION['session_housenr']);} else{echo "";} ?>"  required autofocus>
            </fieldset>

            <fieldset>
              <input placeholder="PLZ" name="plz" type="text" tabindex="1" value="<?php if(isset($_SESSION['session_plz'])){echo ($_SESSION['session_plz']);} else{echo "";} ?>"  required autofocus>
            </fieldset>

            <fieldset>
              <input placeholder="Ort" name="ort" type="text" tabindex="1" value="<?php if(isset($_SESSION['session_ort'])){echo ($_SESSION['session_ort']);} else{echo "";} ?>"  required autofocus>
            </fieldset>
            
            <fieldset>
              <input placeholder="Telefonnummer" name="telefon" type="tel" tabindex="1" value="<?php if(isset($_SESSION['session_tel'])){echo ($_SESSION['session_tel']);} else{echo "";} ?>"  required>
            </fieldset>
          </div>

          <div class="change_login_data">
            <Legend>Login Daten</Legend>
            <fieldset>
              <input placeholder="Benutzername" name="username" type="text" tabindex="1" value="<?php if(isset($_SESSION['session_username'])){echo ($_SESSION['session_username']);} else{echo "";} ?>" required autofocus>
            </fieldset>

            <fieldset>
              <input placeholder="E-Mail" name="email" type="email" tabindex="1" value="<?php if(isset($_SESSION['session_user'])){echo ($_SESSION['session_user']);} else{echo "";} ?>" required>
            </fieldset>

            <fieldset>
              <input placeholder="Passwort" name="password" type="password" tabindex="1" value="<?php if(isset($_SESSION['session_pwd'])){echo ($_SESSION['session_pwd']);} else{echo "";} ?>"  required>
            </fieldset>

            <fieldset>
              <input placeholder="Passwort Wiederholung" name="password_re" type="password" tabindex="1" value="<?php if(isset($_SESSION['session_pwd'])){echo ($_SESSION['session_pwd']);} else{echo "";} ?>"  required>
            </fieldset>
          </div>
        </div>

        <form action="database/editProfileInformations.php" method="POST" id="profilePicture" enctype="multipart/form-data">
                      <label for="img">Profilbild ändern:</label>
                      <input type="file" id="profileImage" name="profileImage" accept="image/*"  onchange="loadFile(event)" >
                      <img id="output"/>

                      <fieldset>
                <button name="submit" type="submit" id="submit" tabindex="1" data-submit="...Sending">Speichern</button>
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