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
  <link href="Metadaten/login.css" rel="stylesheet">
  <link rel="icon" href="Pictures/Logo_Bild.png" />
</head>

<body>

  <?php
  //Prüft, ob die letzte Seite (Seite zuvor) Login oder Registrierung ist
  //Wenn ja, wird Session['last_page'] nicht neu gespeichert
  //Wenn nein, wird der Link zur vorherigen Seite gespeichert
  //Dadurch wird der User nach dem Login zu der Seite zurückgeführt, auf der er vor dem Login oder Registrierung war
  //Wenn er zuvor lange nach einem Record gesucht hat, wird er so nach der Anmeldung z.B. nicht zur Registrierung geleitet, sonder kommt wieder zu diesem Record zurück
  if (isset($_SESSION['wrong_email']) or isset($_SESSION['wrong_pwd'])) {
    $user = $_GET['user'];
    $actual_link = "https://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
    if (($actual_link != 'https://foodsaver.bplaced.net/login.php') and ($actual_link != 'https://foodsaver.bplaced.net/login.php?error_user&user=' . $user . '')
      and ($actual_link != 'https://foodsaver.bplaced.net/login.php?error_pwd&user=' . $user . '') and ($actual_link != 'https://foodsaver.bplaced.net/login.php?login=error')
      and ($actual_link != 'https://foodsaver.bplaced.net/logindataToDB.php') and ($actual_link != 'https://foodsaver.bplaced.net/registrierung.php?contactToDB.php' . $user . '')
      and (!fnmatch('https://foodsaver.bplaced.net/registrierung.php*', $actual_link)) and (!fnmatch('https://foodsaver.bplaced.net/login.php*', $actual_link))
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


  <div id="login_main">
    <div class="login_container">

      <form id="login" action="database/logindataToDB.php" method="post">

        <h3>Login</h3>
        <h4>Hier kannst du dich bei Foodsaver anmelden</h4>

        <fieldset>
          <input placeholder="Benutzername / E-Mail" name="email" type="text" tabindex="1" required value='<?php if (isset($_GET['user'])) {
                                                                                                              echo ($_GET['user']);
                                                                                                            } else {
                                                                                                              echo "";
                                                                                                            } ?>'>
        </fieldset>

        <fieldset>
          <input placeholder="Passwort" name="password" type="password" tabindex="1" required>
        </fieldset>

        <fieldset>
          <button name="submit" type="submit" id="submit" tabindex="1" data-submit="...Sending">Login</button>
        </fieldset>
        <p id="text_registrierung">Noch kein Profil?</p>
        <a id="link_registrierung" href="registrierung.php">Hier geht es zur Registrierung</a>
      </form>
    </div>
  </div>

  <?php
  require("Metadaten/footer.php");
  ?>

</body>

</html>