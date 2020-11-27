<!doctype html>
<html lang="de">

<head>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <link rel="stylesheet" href="../FancyBox/jquery.fancybox.css" type="text/css" media="screen" />
  <script type="text/javascript" src="../FancyBox/jquery.fancybox.pack.js"></script>
  <script type="text/javascript" src="../FancyBox/jquery.mousewheel.pack.js"></script>
  <link rel="stylesheet" href="../FancyBox/jquery.fancybox-buttons.css" type="text/css" media="screen" />
  <script type="text/javascript" src="../FancyBox/jquery.fancybox-buttons.js"></script>


  <script type="text/javascript" src="https://js.api.here.com/v3/3.1/mapsjs-core.js"></script>
  <script type="text/javascript" src="https://js.api.here.com/v3/3.1/mapsjs-service.js"></script>
  <script type="text/javascript" src="https://js.api.here.com/v3/3.1/mapsjs-ui.js"></script>
  <script type="text/javascript" src="https://js.api.here.com/v3/3.1/mapsjs-mapevents.js"></script>
  <script type="text/javascript">
    window.ENV_VARIABLE = 'https://foodsaver.bplaced.net'
  </script>
  <script src='https://developer.here.com/javascript/src/iframeheight.js'></script>

</head>

<body>
  <?php
  //Neue Nachrichten zählen
  $neueNachrichten = 0;
  if (isset($_SESSION['session_username'])) {
    require('database/connectDB.php');
    $user = $_SESSION['session_username'];
    $query = mysqli_query($db_link, "SELECT * FROM `Nachrichten` WHERE Empfänger = '$user' AND neu = 1") or die('Fehler: ' . mysqli_error($db_link));
    $neueNachrichten = mysqli_num_rows($query);
    if ($neueNachrichten > 99) {
      $neueNachrichten = "99+";
    }
  }
  //Header erstellen, Links einfügen
  if (isset($_SESSION['session_user']) and isset($_SESSION['session_pwd'])) {
    //Header für eingeloggten User
    $userEmail = $_SESSION['session_username'];
    $db_res = mysqli_query($db_link, "SELECT * FROM `tbl_contacts` WHERE Benutzername = '$userEmail'") or die('Fehler: ' . mysqli_error($db_link));
    $row = mysqli_fetch_array($db_res);
    $ImageLink = $row['pictureLink'];

    echo "<div id='allNotFooter'><nav class='topnav'>
    <ul class='topnav_link'>
    <li><div id='profileLink'<a href='profile.php?userid=" . $_SESSION['session_username'] . "'><p>" . $_SESSION['session_username'] . "</p><img id='profilePicturePreview' src=" . $ImageLink . "></a></div>
    <ul>
    <li><a href='profile.php?userid=" . $_SESSION['session_username'] . "'>Profil</a></li>
    <li><a href='purchases.php'>Käufe</a></li>   
    <li><a href='sales.php'>Verkäufe</a></li>     
    <li><a href='logout.php'>Logout</a></li>
    </ul>
    </li>
    <li><a href='Meine_Anzeigen.php'>Meine Anzeigen<ion-icon name='add-outline'></ion-icon></a></li>
    <li><a href='add_food.php'>Anzeige hinzufügen</a></li>";
    if ($neueNachrichten != 0) {
      echo "<li><a href='messages.php' class='notification'> <span>Nachrichten</span><span class='badge'>" . $neueNachrichten . "</span></a></li>";
    } else {
      echo "<li><a href='messages.php'>Nachrichten</a></li>";
    }

    echo "
    </ul>
    <div class='logo_image'>
        <a href='index.php'><img src='Pictures/Logo.png' title='Foodsaver - Too Good to Waste' alt='Foodwaste'></a>
    </div>
  </nav>";
  } else {
    //Header für nicht eingeloggten User
    echo "<div id='allNotFooter'><nav class='topnav'>
    <ul class='topnav_link'>
        <li><a href='login.php'>Login</a></li>
        <li><a href='registrierung.php'>Registrierung</a></li>
    </ul>
   

    <div class='logo_image'>
    <a href='index.php'><img src='Pictures/Logo.png' title='Foodsaver - Too Good to Waste' alt='Foodwaste'></a>
    </div>
  </nav>";
  }

  ?>




  <script>
    $(document).ready(function() {
      $(".fancybox").fancybox({
        padding: 2
      });
    });
  </script>

</body>

</html>