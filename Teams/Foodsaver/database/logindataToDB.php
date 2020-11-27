<?php
session_start();

// Wird geladen, wenn User versucht, sich anzumelden

if (isset($_POST['submit']) or isset($_SESSION['wrong_email']) or isset($_SESSION['wrong_pwd'])) {

  require("connectDB.php");
  // eingegebene Email und Passwort speichern
  $user = $_POST['email'];
  $password = $_POST['password'];
  $date = date("Y-m-d H:i:s");

  // Email oder Username abfragen
  $sql = "SELECT * FROM tbl_contacts WHERE Email = '$user' OR Benutzername = '$user'";
  $result = mysqli_query($db_link, $sql);
  $resultCheck = mysqli_num_rows($result);
  // Kein User zu Eingabe gefunden
  if ($resultCheck < 1) {
    $_SESSION['wrong_email'] = $user;
    echo "<script>alert('Benutzername oder Email ist falsch');
        window.location.href='../login.php?error_user&user=" . $user . "';
        </script>";
    exit();
  } else {
    // User gefunden
    if ($row = mysqli_fetch_assoc($result)) {
      // Passwort prüfen 
      $dbpasswort = $row['Passwort'];
      if (!password_verify($password, $dbpasswort)) {
        $_SESSION['wrong_pwd'] = $password;
        echo "<script>alert('Passwort ist falsch!');
              window.location.href='../login.php?error_pwd&user=" . $user . "';
        </script>";
        exit();
      } elseif (password_verify($password, $dbpasswort)) {
        // Benutzer anmelden
        $_SESSION['session_id'] = $row['ID'];
        $_SESSION['session_user'] = $row['Email'];
        $_SESSION['session_username'] = $row['Benutzername'];
        $_SESSION['session_pwd'] = $row['Passwort'];
        $_SESSION['session_company'] = $row['Firma'];
        $_SESSION['session_lastname'] = $row['Nachname'];
        $_SESSION['session_firstname'] = $row['Vorname'];
        $_SESSION['session_street'] = $row['Straße'];
        $_SESSION['session_housenr'] = $row['Hausnummer'];
        $_SESSION['session_plz'] = $row['PLZ'];
        $_SESSION['session_ort'] = $row['Ort'];
        $_SESSION['session_tel'] = $row['Telefonnummer'];
        $_SESSION['session_image'] = $row['pictureLink'];
        $_SESSION['session_country'] = 'de';
        $_SESSION['last_login_timestamp'] = time();

        $ip = $_SERVER['REMOTE_ADDR'];
        $details = json_decode(file_get_contents("http://ipinfo.io/{$ip}/json"));
        $_SESSION['ip'] = $details->ip;
        $_SESSION['ip_loc'] = $details->loc;
        $_SESSION['ip_city'] = $details->city;
        $_SESSION['ip_country'] = $details->country;
        $_SESSION['ip_plz'] = $details->postal;

        $update = "UPDATE tbl_contacts SET letzterLogin ='$date' WHERE Email = '$user'";
        mysqli_query($db_link, $update);


        if (isset($_SESSION['last_page'])) {
          header('Location: ' . $_SESSION['last_page']);
        } else {

          header('Location: ../index.php');
        }
      }
    }
  }
  exit();
} else {
  header("Location: ../login.php?login=error");
  exit();
}
