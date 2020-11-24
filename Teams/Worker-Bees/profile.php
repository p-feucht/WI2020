<?php session_start(); ?>

<!doctype html>
<html class="no-js" lang="">

<head>
    <meta charset="utf-8">
    <title>Worker Bees</title>
    <meta name="description" content="">
    <link rel="icon" href="images/logoBiene.png" />
    <link href="CSS/profile.css" rel="stylesheet">

</head>

<body>

    <?php include "PHP/header.php"; ?>

    <div class="profile-content">
    <h1>Dein Account</h1>
        Du wirst in der nächsten Version die Möglichkeit haben, dein Profil nach deinen eigenen
        Wünschen bearbeiten zu können.
    </div>

<div class="boxes-part">
        <div class="box1">
        <h3>Deine Profildaten</h3>
            <label>Benutzername</label>
            <p class="box-text" id="username">username</p>
            <button class="cent" type="button">Bearbeiten</button>
            <label>E-Mail-Adresse</label>
            <p class="box-text" id="email">email</p>
            <button class="cent" type="button">Bearbeiten</button>
            <label>Passwort</label>
            <p class="box-text" id="passwort">******</p>
            <button class="cent" type="button">Bearbeiten</button>   
        </div>
        <div class="box">
        <h3>Deine Angebote</h3>
                
        </div>


        <div class="box">
        <h3>Deine Buchungen</h3>
            
        </div>
    </div>

    <?php include "PHP/footer.php"; ?>

</body>

</html>