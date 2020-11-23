<?php session_start();?>
<!DOCTYPE html>
<html lang="de">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Meine Favoriten - Serinder</title>
    
    <link rel="stylesheet" href="../css/style.css">
    <script src="../js/plugins.js"></script>
</head>

<body>
    <?php include('./structure/Header.php'); ?>
    <main>
        <div class="inner">
            <h1>Meine Favoriten</h1>
                <div class="filterResults">
                    <ul id="listOfFavorites">
                        <?php include("../php/myFavorites.php");?>
                    </ul>
                </div>
            </div>
        </div>
        <?php include('./structure/LoginForm.html'); ?>
    </main>
    <?php include('./structure/Footer.html'); ?>
</body>

</html>