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
</head>

<body>

  <?php

    $_SESSION['last_page'] = $_SERVER['HTTP_REFERER'];
    
    require("Metadaten/chooseHeader.php");
    
  ?>
    
    <div id="main">
        <div class="container">  

            <form id="contact" action="database/logindataToDB.php" method="post">

              <h3>Login</h3>
              <h4>Hier kannst du dich bei Too Good to Waste anmelden</h4>

              <fieldset>
                <input placeholder="Benutzername/E-Mail" name="email" type="text" tabindex="1" required 
                value = '<?php if(isset($_GET['user'])){echo ($_GET['user']);} else{echo "";} ?>'>
              </fieldset>

              <fieldset>
                <input placeholder="Passwort" name="password" type="password" tabindex="1" required>
              </fieldset>

              <fieldset>
                <button name="submit" type="submit" id="submit" tabindex="1" data-submit="...Sending">Login</button>
              </fieldset>
              <a href="registrierung.php">Registrieren</a>
            </form>
        </div>
      </div>

  <?php
  require("Metadaten/footer.php");
  ?>
    
</body>

</html>