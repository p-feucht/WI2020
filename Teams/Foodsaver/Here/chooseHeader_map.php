<!doctype html>
<html lang="de">
<body>
<?php
$neueNachrichten = 0;
if(isset($_SESSION['session_username'])){
  require('../database/connectDB.php');
  $user = $_SESSION['session_username'];
  $query = mysqli_query($db_link, "SELECT * FROM `Nachrichten` WHERE Empfänger = '$user' AND neu = 1") or die('Fehler: ' . mysqli_error());
  $neueNachrichten = mysqli_num_rows($query);
  if($neueNachrichten > 99){
    $neueNachrichten = "99+";
  }
}

if (isset($_SESSION['session_user']) and isset($_SESSION['session_pwd'])) {
  $userEmail = $_SESSION['session_username'];
  $db_res = mysqli_query($db_link, "SELECT * FROM `tbl_contacts` WHERE Benutzername = '$userEmail'") or die('Fehler: ' . mysqli_error());
  $row = mysqli_fetch_array($db_res);
  $ImageLink = $row['pictureLink'];

    echo "<nav class='topnav'>
    <ul class='topnav_link'>
    <li><div id='profileLink'<a href='../profile.php?userid=". $_SESSION['session_username'] ."'><p>".$_SESSION['session_username']."</p><img id='profilePicturePreview' src=". $ImageLink. "></a></div>
    <ul>
    <li><a href='../profile.php?userid=". $_SESSION['session_username'] ."'>Profil</a></li>
    <li><a href='../purchases.php'>Käufe</a></li>   
    <li><a href='../sales.php'>Verkäufe</a></li>     
    <li><a href='../logout.php'>Logout</a></li>
    </ul>
    </li>
    <li><a href='../Meine_Anzeigen.php'>Meine Anzeigen</a></li>
    <li><a href='../add_food.php'>Anzeige hinzufügen</a></li>";
    if($neueNachrichten != 0){
      echo"<li><a href='../messages.php' class='notification'> <span>Nachrichten</span><span class='badge'>".$neueNachrichten."</span></a></li>";
    }else{
      echo"<li><a href='../messages.php'>Nachrichten</a></li>";
    }

echo"
    </ul>


    <div class='logo_image'>
        <a href='../index.php'><img src='../Pictures/Logo.png' title='Too Good to Waste' alt='Foodwaste'></a>
    </div>
  </div>
  </nav>";
} else {
    echo "<nav class='topnav'>
    <ul class='topnav_link'>
        <li><a href='../login.php'>Login</a></li>
        <li><a href='../registrierung.php'>Registrierung</a></li>
    </ul>
   

    <div class='logo_image'>
    <a href='../index.php'><img src='../Pictures/Logo.png' title='Too Good to Waste' alt='Foodwaste'></a>
    </div>
  </nav>";
}

?>
</body>

</html>








