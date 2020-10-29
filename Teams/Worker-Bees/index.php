<!doctype html>
<html class="no-js" lang="">

<head>
    <meta charset="utf-8">
    <link rel="icon" href="images/logoBiene.png" />
    <title>Worker Bees</title>
    <meta name="description" content="">
    <link href="CSS/headerDesign.css" rel="stylesheet">
    <link href="CSS/welcomePageDesign.css" rel="stylesheet">

    <!-- Load icon library -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

</head>

<body>

<?php include "PHP/header.php";?>   
    
    <!-- Beehive banner -->
    <div class="background-container">
        <div class="card-anbieten">
            <h2>Verleihe deine herumstehenden Werkzeuge, vermiete deine leerstehende Werkstatt, mach 
                etwas aus deiner Freizeit.
            </h2>
            <a href="FormularBiete.html"><button class="los-button" ><h4>Los geht's!</h4></button></a>
        </div>
    </div>

    <!-- Category cards -->
    <div class="category-section">
            <div class="category">
                <a href="categories.html#Werkzeug-Ang">
                    <img class="categoryPics" src="images/Werkzeug.jpg" alt="Werkzeug">
                    <p class="categoryText">Brauchst du ein bestimmtes Werkzeug?</p>
                </a>
            </div>
            <div class="category">
                <a href="categories.html#Werkstatt-Ang">
                    <img class="categoryPics" src="images/Flaeche.jpg" alt="Fläche">
                    <p class="categoryText">Brauchst du einen Ort, um dein Hobby auszuleben?</p>
                </a>
            </div>
            <div class="category">
                <a href="categories.html#Dienst-Ang">
                    <img class="categoryPics" src="images/Dienst.jpg" alt="Dienst">
                    <p class="categoryText">Brauchst du jemanden, der dir unter die Arme greift?</p>
                </a>
            </div>
        </div>
        
            

    <div class="yellow-container">Hier kommen noch Beispielangebote hin</div>
    
    <div class="footer">
        <div class="footer_info">
            <img src="images/logoKomplett.png" class="logo" alt="Worker Bees Logo" width="207" height="60">
            <br>
            <br>
            <br>

            <div class="footer_slogan">
                <p> Come to craft</p>
            </div>
            <div id="contact">
                <p>WorkerBees e.V.
                    <br> Musterstraße 25
                    <br> 86712 Musterstadt
                </p>
                <a href="mailto:support@workerbees.com">support@workerbees.com</a>
                <br> +49 172 906 212
            </div>
        </div>
        <div class="footer_end">
            <p>Copyright 2020 | WorkerBees e.V.</p>
        </div>

    </div>

</body>

</html>