<!doctype html>
<html lang="de">
<body>
<?php

if (isset($_SESSION['session_user']) and isset($_SESSION['session_pwd'])) {
    echo "<nav class='topnav'>
    <ul class='topnav_link'>
    <li><a href='Meine_Anzeigen.php'>Meine Anzeigen</a></li>
    <li><a href='add_food.php'>Anzeige hinzufügen</a></li>
    <li><a href='messages.php'>Nachrichten</a></li>
    <li><a href='#'>...</a>
    <ul>
    <li><a href='profile.php?user=". $_SESSION['session_username'] ."'>Profil</a></li>
    <li><a href='purchases.php'>Käufe</a></li>   
    <li><a href='sales.php'>Verkäufe</a></li>     
    <li><a href='logout.php'>Logout</a></li>
    </ul>
    </li>
    </ul>


    <div class='topnav_logo'>
        <a href='index.php'>Too Good to Waste</a>
        
    </div>
    <div class='logo_image'>
        <a href='index.php'><img src='Pictures/foodwaste2.png' title='Too Good to Waste' alt='Foodwaste'></a>
    </div>
  </div>
  </nav>";
} else {
    echo "<nav class='topnav'>
    <ul class='topnav_link'>
        <li><a href='login.php'>Login</a></li>
        <li><a href='registrierung.php'>Registrierung</a></li>
    </ul>
   
    <div class='topnav_logo'>
        <a href='index.php'>Too Good to Waste</a>
        
    </div>
    <div class='logo_image'>
        <a href='index.php'><img src='Pictures/foodwaste2.png' title='Too Good to Waste' alt='Foodwaste'></a>
    </div>
  </nav>";
}

?>
</body>

</html>









