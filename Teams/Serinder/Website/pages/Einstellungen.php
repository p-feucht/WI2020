<?php session_start();?>
<!DOCTYPE html>
<html lang="de">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Einstellungen - Serinder</title>

    <link rel="stylesheet" href="../css/style.css">
    <script src="../js/plugins.js"></script>
</head>

<body>
    <?php include("./structure/Header.php"); ?>

    <main>
        <div class="inner">
            <h1>Was möchtest du tun?</h1>
            <div class="row">
                <div class="col-12 col-md-6">
                    <a class="button" onclick="addClass()" href="#">Passwort ändern</a>
                    <div class="changePasswordWrapper">
                        <span class="close" onclick="removeClass()"></span>
                        <form action="/php/changePassword.php" method="POST">
                        <h2>Passwort ändern</h2>
                        <input type="password" placeholder="Altes Passwort" size="40" minlength="6" maxlength="250" name="password_old">
                        <input type="password" placeholder="Neues Passwort" size="40" minlength="6" maxlength="250" name="password1">
                        <input type="password" placeholder="Neues Passwort erneut eingeben" size="40" minlength="6" maxlength="250" name="password2">
                        <button class="button" type="submit">Passwort ändern</button>
                        </form>
                    </div>
                </div>
                <div class="col-12 col-md-6">
                    <a class="button" href="/php/deleteAccount.php">Account löschen</a>
                </div>
            </div>
            
        </div>
        
        <?php include('./structure/LoginForm.html'); ?>
    </main>
    <?php include("./structure/Footer.html"); ?>
    

</body>