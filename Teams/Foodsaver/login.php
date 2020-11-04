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
    <link href="Metadaten/login.css" rel="stylesheet">
</head>

<body>

  <?php

    $_SESSION['last_page'] = $_SERVER['HTTP_REFERER'];
    if(($_SESSION['last_page'] == 'http://foodsaver.bplaced.net/registrierung.php') or ($_SESSION['last_page'] == 'http://foodsaver.bplaced.net/login.php')){
      $_SESSION['last_page'] = 'http://foodsaver.bplaced.net/index.php';
    }
    
    require("Metadaten/chooseHeader.php");
    
  ?>

    
    <div id="login_main">
        <div class="login_container">  

            <form id="login" action="database/logindataToDB.php" method="post">

              <h3>Login</h3>
              <h4>Hier kannst du dich bei Foodsaver anmelden</h4>

              <fieldset>
                <input placeholder="Benutzername / E-Mail" name="email" type="text" tabindex="1" required 
                value = '<?php if(isset($_GET['user'])){echo ($_GET['user']);} else{echo "";} ?>'>
              </fieldset>

              <fieldset>
                <input placeholder="Passwort" name="password" type="password" tabindex="1" required>
              </fieldset>

              <fieldset>
                <button name="submit" type="submit" id="submit" tabindex="1" data-submit="...Sending">Login</button>
              </fieldset>
              <a href="registrierung.php">Hier geht es zur Registrierung</a>
            </form>
        </div>
      </div>

  <?php
  require("Metadaten/footer.php");
  ?>
    
</body>

</html>