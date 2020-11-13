<?php session_start();?>
<!DOCTYPE html>
<html lang="de">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Filterseite - Serinder</title>
    
    <link rel="stylesheet" href="../css/style.css">
    <script src="../js/plugins.js"></script>
</head>

<body>
    <?php include('./structure/Header.php'); ?>
    <main>
        <div class="inner">
            <h1>Liste der Serien</h1>
            <div class="filterWrapper">
                <p>sortieren nach:</p>
                <div class="filterInnerWrapper">
                    <div class="filterbuttonWrapper">
                        <a class="button" href="./Serienliste.php">Alphabetisch</a>
                    </div>
                    <div class="filterSelectWrapper">
                        <div class="selectWrapper">
                                <select name="Genre" id="Genre" onchange="showSelectedGenre()">
                                    <option value="">Alle Genres</option>
                                    <?php include("../php/genresList.php");?>
                                </select>
                        </div>
                    </div>
                    <div class="filterbuttonWrapper">
                        <a class="button" href="#">Bewertung</a>
                    </div>
                </div>
                <div class="filterResults">
                    <ul id="listOfSeries">
                        <?php include("../php/seriesList.php");?>
                    </ul>
                </div>
            </div>
        </div>
        <?php include('./structure/LoginForm.html'); ?>
    </main>
    <?php include('./structure/Footer.html'); ?>
</body>

</html>