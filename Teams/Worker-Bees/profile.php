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
    <?php include "PHP/profileData.php"; ?>

    <div class="profile-content">
        <h1>Dein Account</h1>
        Du wirst in der nächsten Version die Möglichkeit haben, dein Profil nach deinen eigenen
        Wünschen bearbeiten zu können.
    </div>

    <div class="boxes-part">
        <div class="box">
            <h3>Deine Profildaten</h3>
            <div class="box-element">
                <h5>Benutzername</h5>
                <?php echo $username;?>
               
                <button class="cent" type="button">Bearbeiten</button>
            </div>
            <div class="box-element">
                <h5>E-Mail-Adresse</h5>
                <?php echo $email;?>
                
                <button class="cent" type="button">Bearbeiten</button>
            </div>
            <div class="box-element">
                <h5>Passwort</h5>
                <label class="box-text" id="passwort">******</label>
                <button class="cent" type="button">Bearbeiten</button>
            </div>
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

