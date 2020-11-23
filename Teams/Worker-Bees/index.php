<?php session_start(); ?>
<!doctype html>
<html class="no-js" lang="">


<head>
    <meta name="description" content="">
    <link href="CSS/index.css" rel="stylesheet">

</head>

<body>

    <?php include "PHP/header.php"; ?>

    <!-- Beehive banner -->
    <div class="background-container">
        <div class="card-anbieten">
            <h2>Verleihe deine herumstehenden Werkzeuge, vermiete deine leerstehende Werkstatt, mach
                etwas aus deiner Freizeit.
            </h2>
            <a href="FormularBiete.php"><button class="los-button">
                    <h4>Los geht's!</h4>
                </button></a>
        </div>
    </div>

    <!-- Category cards -->
    <div class="category-section">
        <div class="category">
            <a href="werkzeugPage.php">
                <img class="categoryPics" src="images/Werkzeug.jpg" alt="Werkzeug">
                <p class="categoryText">Brauchst du ein bestimmtes Werkzeug?</p>
            </a>
        </div>
        <div class="category">
            <a href="werkstattPage.php">
                <img class="categoryPics" src="images/Flaeche.jpg" alt="Fläche">
                <p class="categoryText">Brauchst du einen Ort, um dein Hobby auszuleben?</p>
            </a>
        </div>
        <div class="category">
            <a href="dienstleistungPage.php">
                <img class="categoryPics" src="images/Dienst.jpg" alt="Dienst">
                <p class="categoryText">Brauchst du jemanden, der dir unter die Arme greift?</p>
            </a>
        </div>
    </div>


    <?php include "PHP/footer.php"; ?>

</body>

</html>