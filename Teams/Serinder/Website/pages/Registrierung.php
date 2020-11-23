<?php session_start();?>
<!DOCTYPE html>
<html lang="de">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Startseite - Serinder</title>

    <link rel="stylesheet" href="../css/style.css">
    <script src="../js/plugins.js"></script>
</head>

<body>
    <?php include("./structure/Header.php"); ?>
    <main>
        <div class="inner">
            <h1>Registrierung</h1>
            <div class="row">
                <form action="../php/register.php" method="post">
                    E-Mail:<br>
                    <input type="email" size="40" maxlength="100" name="email" required><br><br>

                    Username:<br>
                    <input type="text" size="40" minlength="3" maxlength="50" name="username" required><br><br>

                    Dein Passwort:<br>
                    <input type="password" size="40" minlength="6" maxlength="250" name="password1" required><br>

                    Passwort wiederholen:<br>
                    <input type="password" size="40" minlength="6" maxlength="250" name="password2" required><br><br>

                    <p>Durch das Erstellen eines Accounts stimmen Sie unseren <a href="/pages/datenschutz.php"> Bedingungen</a> zu.</p>

                    <div class="buttonWrapper">
                        <input class="button" type="submit" name="submit" value="Abschicken">
                    </div>

                </form>
            </div>

        </div>
        <?php include('./structure/LoginForm.html'); ?>
    </main>
    <?php include("./structure/Footer.html"); ?>



</body>

</html>