
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
    
    <script src="../js/plugins.js"></script>
    <?php include("./structure/Header.php"); ?>

    <main>
        <div class="inner">
            <h1>Was möchtest du tun?</h1>
            <div class="row">
                <div class="col-12 col-md-6">
                    <a class="button" onclick="addClass()" href="#">Passwort ändern</a>
                    <div class="changePasswordWrapper">
                        <span class="close" onclick="removeClass()"></span>
                        <h2>Passwort ändern</h2>
                        <input type="text" placeholder="Altes Passwort">
                        <input type="text" placeholder="Neues Passwort">
                        <input type="text" placeholder="Neues Passwort erneut eingeben">
                        <a class="button" href="#">Passwort ändern</a>
                    </div>
                </div>
                <div class="col-12 col-md-6">
                    <a class="button" href="#">Account löschen</a>
                </div>
            </div>
            
        </div>
        
        <?php include('./structure/LoginForm.html'); ?>
    </main>
    <?php include("./structure/Footer.php"); ?>
    

</body>