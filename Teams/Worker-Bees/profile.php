<?php session_start(); 
if (!isset($_SESSION ["loggedin"]) || $_SESSION["loggedin"] != true) {
    header("location: login.php");
}?>

<!doctype html>
<html class="no-js" lang="">

<head>
    <meta charset="utf-8">
    <title>Worker Bees</title>
    <meta name="description" content="">
    <link rel="icon" href="images/logoBiene.png" />
    <link href="CSS/profile.css" rel="stylesheet">
    <script  src="JavaScript/profile.js"></script>

</head>

<body>

    <?php include "PHP/header.php"; ?>
    <?php include "PHP/profileUserData.php"; ?>

   

    <div class="boxes-part">
        <div class="box" id="profildaten">
            <h3>Deine Profildaten</h3>
            <div class="box-element">
                <h4>Benutzername</h4>
                <?php echo $username;?>
               
                <button class="cent" type="button" onclick="bearbeitenClick()">Bearbeiten</button>
            </div>
            <div class="box-element">
                <h4>E-Mail-Adresse</h4>
                <?php echo $email;?>
                
                <button class="cent" type="button" onclick="bearbeitenClick()">Bearbeiten</button>
            </div>
            <div class="box-element">
                <h4>Passwort</h4>
                <label class="box-text" id="passwort">******</label>
                <button class="cent" type="button" onclick="bearbeitenClick()">Bearbeiten</button>
            </div>
        </div>
        <div class="box">
            <h3>Deine Angebote</h3>
            <div class="Werkstatt-Angebote">
                <h4>Werkstatt Angebote</h4>
                <?php include "PHP/profileWSData.php"; ?>
            </div>

            <div class="Werkzeug-Angebote">
                <h4>Werkzeug Angebote</h4>
                <?php include "PHP/profileWZData.php"; ?>
                
            </div>

            <div class="Dienstleistung-Angebote">
                <h4>Dienstleistung Angebote</h4>
                <?php include "PHP/profileDLData.php"; ?>
                
            </div>
        </div>

        </div>


        <div class="box">
            <h3>Deine Buchungen</h3>

        </div>
    </div>

    <?php include "PHP/footer.php"; ?>

</body>

</html>

